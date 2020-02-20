<template>
  <div class="root">  
    <div class="header">
      <h1>Detail Inventaris</h1>
    </div>
    <div id="content" class="row">
      <div class="col-sm-6">
        <div class="photo-container">
          <div class="photo">
            <div class="slideshow-container">
              <div class="mySlides1">
                <img v-bind:src="curent_src">
              </div>
              <a class="prev" v-on:click="go_prev()" >&#10094;</a>
              <a class="next" v-on:click="go_next()" >&#10095;</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="tambahinventaris-container">
          <div class="row">
            <div class="col-sm-8">
              <div id="tambahinventaris-header">
                <p>Detail Inventaris</p>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="button-4" >
                <a @click="edit()">Edit</a>
              </div>
              <div class="button-4" >
                <a @click="downloadCatatan()">Download Catatan</a>
              </div>
            </div>
          </div>
          <p class="text">Nama Barang</p>
          <input class="text-input" type="text" placeholder="nama barang" v-model="nama_barang" readonly/>
          <p class="text">Jumlah Barang</p>
          <input class="text-input" type="text" placeholder="Jumlah Barang" v-model="jumlah" readonly/>
          <p class="text">Deskripsi Barang</p>
          <textarea class="text-input-deskripsi" type="text" placeholder="deskripsi" v-model="deskripsi" readonly></textarea>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name:'tambahinventaris',
  data(){
    return{
      nama_barang:'',
      jumlah:'',
      deskripsi:'',
      file_url: "ga ada",
      curent_index: 0,
      curent_src: this.axios.defaults.baseURL + "/getfile?filepath=public%2Fnotfound.png",
      photos: [
      ]
    }
  },
  methods:{
    go_prev(){
      if(this.photos.length > 0){
        if(this.curent_index !== 0){
          this.curent_index--;
          this.curent_src = this.photos[this.curent_index];        
        }
      }      
    },
    go_next(){
      if(this.photos.length > 0){
        if(this.curent_index < this.photos.length-1){
          this.curent_index++;
          this.curent_src = this.photos[this.curent_index];        
        }
      }
    },
    check_photos(){
      if(this.photos.length > 0){
        this.curent_src = this.photos[this.curent_index];
      }else{
        this.curent_src = this.axios.defaults.baseURL + "/getfile?filepath=public%2Fnotfound.png";
      }
    },
    getDetailInventaris(){
      const token = window.localStorage.getItem('token');
      this.axios
        .get("/inventaris/show/"+ this.$route.params.id,
        {
          headers: { 
            "Authorization": `Bearer ${token}`
          }
        }
        )
        .then(respone =>{
          this.nama_barang = respone.data.data.nama;
          this.jumlah = respone.data.data.jumlah;
          this.deskripsi = respone.data.data.deskripsi;
          this.photos = [];
          respone.data.data.photos.forEach(element => {
            this.photos.push(element.foto_url);
          });
          this.file_url = respone.data.data.file_url;
          this.check_photos();
        })
    },
    edit(){
      window.location.href = "/editinventaris/" + this.$route.params.id;
    },
    downloadCatatan(){
      if (this.file_url !== "ga ada"){
        window.location.href = this.file_url;
      }else{
        alert("maaf inventaris ini tidak memiliki file catatan");
      }
    }
  },
  mounted(){
    this.check_photos();
    this.getDetailInventaris();
  }
}
</script>

<style scoped>
#content{
  margin-top: 15vh;
}
.header{
  margin-top: 10vh;
  width: 100%;
  text-align: center;
  font-family: 'Raleway', sans-serif;
}

.photo-container{
  text-align: center;
  height: 100%;
}
.photo{
  display: inline-block; 
  margin-right: 12.5px;
  margin-left: 25px;
  width: 100%;
  height: 60vh;
  background: white;
  border-radius: 2px;
  padding: 10px 20px;
  box-shadow: 2px 2px 5px #878788;
}
.mySlides1{
  width: 100%;
  height: 100%;
}
img {
  vertical-align: center;
  object-fit: containx;
  width: 100%;
  height: 100%;
}
.slideshow-container {
  text-align: left;
  position: relative;
  margin: auto;
  width: 100%;
  height: 100%;
}
.prev, .next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  padding: 16px;
  margin-top: -22px;
  font-weight: bold;
  font-size: 18px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
  user-select: none;
  background-color: #f1f1f1;
  color: black;
}

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

.root{
  padding: 0;
  margin: 0;
  background: #e9f5ec;
  z-index: -1;
  min-height: 100vh;
  overflow-x: hidden;
}
.tambahinventaris-container{
  margin-left: 12.5px;
  margin-right: 25px;
  border-radius: 4px;
  background: white;
  padding: 15px 25px;
  height: 100%;
  box-shadow: 2px 2px 5px #878788;
}
#tambahinventaris-header{
  font-family: "Raleway", sans-serif;
  font-size: 32px;
  font-weight: 300;
}
.text{
  font-family: "Montserrat Alternates", sans-serif;
  font-size: 17px;
  color: #636363;
  line-height: 12px;
  margin: 0;
  margin-bottom: 8px;
}

.text-input{
  border: 2px solid #24D39B;
  padding: 5px 8px;
  font-size: 17px;
  margin-bottom: 12px;
  height: 12%;
  width: 100%;
  border-radius: 4px;
}

.text-input:focus{
  border: 2px solid #1A53FF;
  border-radius: 4px;
}
.text-input-deskripsi{
  border: 2px solid #24D39B;
  padding: 5px 8px;
  height: 25%;
  font-size: 12px;
  margin-bottom: 8px;
  width: 100%;
  border-radius: 4px;
  resize: none;
}
.text-input-deskripsi:focus{
  border: 2px solid #1A53FF;
  border-radius: 4px;
}
.upload-foto{
  border: 2px solid #24D39B;
  padding: 3px 8px;
  font-size: 17px;
  margin:auto;
  height: 100%;
  width:inherit;
  border-radius: 4px;
  display: inline-block;
}
.upload-foto:hover{
  border: 2px solid #1A53FF;
}
#foto-upload{
  display: none;
}
.upload-foto-container{
  display: block;
  cursor: pointer;
}
#kolom1{
  height: 5vh;
  
}
#kolom2{
  height: 5vh;
}
.button{
  border: 2px solid #1A53FF;
  padding: 2px 8px;
  font-size: 17px;
  color: #1A53FF;
  text-align: center;
  margin-bottom: 8px;
  height: 100%;
  width:inherit;
  border-radius: 4px;
  display: inline-block;
}
.button:hover{
  background: #1A53FF;
  color: white;
}
.button-4{
  width: inherit;
  margin-top: 10px;
  cursor: pointer;
}
.button-4 a:hover{
  background: green;
  color: white;
  border-color: green;
  text-decoration: none;
}
.button-4 a{
  display: block;
  font-family: 'Raleway', sans-serif;
  padding: 5px 10px;
  margin:auto;
  text-align: center;
  text-decoration: none;
  font-size: 17px;
  color: #24D39B;
  font-weight: 400;
  background: white;
  transition: 0.5s;
  border:1px solid#24D39B;
  border-radius: 4px;
}
.button2{
  border: 2px solid #24D39B;
  margin-top: 12px;
  margin-bottom: 12px;
  height: 100%;
  border-radius: 4px;
  text-align: center;
}

.button2 a{
  text-decoration: none;
  color: #24D39B;
  display: block; 
  font-size: 20px;
  font-display: "Raleway", sans-serif;
  font-weight: 500;
}
.button2 a:hover{
  color: white;
  background: #24D39B;
  transition: 0.6s;
}
@media screen and (max-width: 1000px){
  #tambahinventaris-header{
    font-family: "Raleway", sans-serif;
    font-size: 18px;
    font-weight: 300;
  }
}
@media screen and (max-width: 600px){
  .button-4{
    margin-bottom: 10px;
  }
  img {
    vertical-align: center;
    max-height: 100%;
    max-width: 100%;
  }
  .photo{
    display: inline-block; 
    margin-right: 25px;
    margin-left: 25px;
    width: inherit;
    height: 200px;
    background: white;
    border-radius: 2px;
    padding: 20px;
    position: relative;
  }
  #content{
    margin-top: 5vh;
  }
  .tambahinventaris-container{
    margin: 20px 25px;
    border-radius: 4px;
    background: white;
    padding: 15px 25px;
    height: 130%;
  }
  #tambahinventaris-header{
    font-family: "Raleway", sans-serif;
    font-size: 20px;
    font-weight: 300;
  }
  .text-input{
    border: 2px solid #24D39B;
    padding: 5px 8px;
    font-size: 15px;
    margin-bottom: 12px;
    height: 8%;
    width: 100%;
    border-radius: 4px;
  }
  .text-input-deskripsi{
    border: 2px solid #24D39B;
    padding: 5px 8px;
    height: 38%;
    font-size: 12px;
    margin-bottom: 8px;
    width: 100%;
    border-radius: 4px;
  }
}
</style>
