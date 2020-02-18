<template>
  <div class="root">
    <div id="content" class="row">
      <div class="col-sm-6">
        <div class="photo-container">
          <div class="photo">
            <div class="slideshow-container">
              <a class="prev" v-on:click="go_prev()" >&#10094;</a>
              <div class="mySlides1">
                <img v-bind:src="curent_src">
              </div>
              <a class="next" v-on:click="go_next()" >&#10095;</a>
              <div class="delete-container">
                <div class="button3" @click="openDeleteDialog()"> Delete Photo </div>
              </div>
              <b-modal ref="hapus-modal" hide-footer title="Peringatan">
                <div class="d-block text-center">
                  <h3>Apakah anda yakin ingin menghapus foto?</h3>
                  <p>*Note : Foto yang dihapus tidak dapat dikembalikan!</p>
                </div>
                <b-button class="mt-3" variant="outline-danger" block @click="hideModal">HAPUS</b-button>
              </b-modal>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="editinventaris-container">
          <div id="editinventaris-header">
            <p>Edit Inventaris</p>
          </div>
          <p class="text">Nama Barang</p>
          <input class="text-input" type="text" placeholder="nama barang"/>
          <p class="text">Jumlah Barang</p>
          <input class="text-input" type="text" placeholder="Jumlah Barang"/>
          <p class="text">Deskripsi Barang</p>
          <textarea class="text-input-deskripsi" type="text" placeholder="deskripsi"></textarea>  
          <p class="text">Upload foto</p>
          <label for="foto-upload" class="upload-foto-container" >
            <div id="row" class="row">
              <div id="kolom1" class="col-sm-8">
                <div class="upload-foto" >
                  <p>{{ foto_status }}</p>
                </div>
              </div>
              <div id="kolom2" class="col-sm-4">
                <div class="button" >
                  <p>Open File</p>
                </div>
              </div>
            </div>
          </label>
          <input id="foto-upload" ref="foto_upload" type="file" accept="image/png, image/jpeg" multiple @change="update_status()" />
          <div class="button2" >
            <a href="#none">SIMPAN</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
#content{
  margin-top: 8%;
}

.photo-container{
  text-align: center;
  height: 100%;
}
.photo{
  display: inline-block;
  margin-right: 12.5px;
  margin-left: 25px;
  width: inherit;
  height: 100%;
  background: white;
  border-radius: 2px;
  padding: 10px 20px;
}
img {
  vertical-align: center;
  object-fit: cover;
  width: 100%;
  height: 55vh;
}
.slideshow-container {
  text-align: left;
  position: relative;
  margin: auto;
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

/* On hover, add a grey background color */

.root{
  padding: 0;
  margin: 0;
  background: #e9f5ec;
  z-index: -1;
  min-height: 100vh;
  overflow-x: hidden;
}
.editinventaris-container{
  margin-left: 12.5px;
  margin-right: 25px;
  border-radius: 4px;
  background: white;
  padding: 10px 25px;
  height: 100%;
}
#editinventaris-header{
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
  height: 8%;
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
  height: 20%;
  font-size: 17px;
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
  height: inherit;
  width:inherit;
  border-radius: 4px;
  display: inline-block;
}
.button:hover{
  background: #1A53FF;
  color: white;
}

.button2{
  border: 2px solid #24D39B;
  margin-top: 18px;
  margin-bottom: 12px;
  height: fit-content;
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
.delete-container{
  margin-top: 12px;
  width: inherit;
  height: fit-content;
  text-align: center;
}
.button3{
  border: 2px solid red;
  padding: 2px 8px;
  font-size: 17px;
  color: red;
  text-align: center;
  margin-bottom: 8px;
  height: 100%;
  width:inherit;
  border-radius: 4px;
  display: inline-block;
  cursor: pointer;
}
.button3:hover{
  background: red;
  color: white;
}
.button3:active{
  border: 2px solid #FF635E;
  background: #FF635E;
}
#kolom1{
  height: 5vh;
  
}
#kolom2{
  height: 5vh;
}
.upload-foto{
  border: 2px solid #24D39B;
  padding: 3px 8px;
  font-size: 17px;
  margin-bottom: 8px;
  height: inherit;
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

@media screen and (max-width: 1000px){
  #editinventaris-header{
    font-family: "Raleway", sans-serif;
    font-size: 18px;
    font-weight: 300;
  }
  .button{
    font-size: 10px;
  }
}
@media screen and (max-width: 600px){
  img {
    vertical-align: center;
    object-fit: cover;
    width: 100%;
    height: inherit;
  }
  .button{
    font-size: 17px;
  }
  .photo{
    display: inline-block; 
    margin-right: 25px;
    margin-left: 25px;
    width: inherit;
    height: 250px;
    background: white;
    border-radius: 2px;
    padding: 20px;
  }
  #content{
    margin-top: 5vh;
  }
  .editinventaris-container{
    margin: 20px 25px;
    border-radius: 4px;
    background: white;
    padding: 15px 25px;
    height: 100%;
  }
  #editinventaris-header{
    font-family: "Raleway", sans-serif;
    font-size: 20px;
    font-weight: 300;
  }
  .text-input-deskripsi{
    border: 2px solid #24D39B;
    padding: 5px 8px;
    height: 24%;
    font-size: 12px;
    margin-bottom: 8px;
    width: 100%;
    border-radius: 4px;
  }
}
</style>
<script>
export default {
  name:'editinventaris',
  data(){
    return{
      curent_index: 0,
      curent_src: 'https://lh3.googleusercontent.com/proxy/TMRAAiyt5teC6SWplqVdWBcn46c2eeMgfdd3QLovIA02SqB8vBCwVHFblnhI3VZ0id6iP-VJfiXbnT8MMA3VG8ixp2DtPCQaAoHf6EU',
      photos: [
        'https://wallpaperaccess.com/full/30100.jpg',
        'https://wallpaperplay.com/walls/full/0/9/2/78869.jpg',
        'https://1.bp.blogspot.com/-BJbw1zlvYvk/VVG1bVS_2sI/AAAAAAAAMHA/XucxZWn_uR8/s1600/cv00.png'
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
        this.curent_src = 'https://lh3.googleusercontent.com/proxy/TMRAAiyt5teC6SWplqVdWBcn46c2eeMgfdd3QLovIA02SqB8vBCwVHFblnhI3VZ0id6iP-VJfiXbnT8MMA3VG8ixp2DtPCQaAoHf6EU';
      }
    },
    openDeleteDialog(){
      this.$refs['hapus-modal'].show()
    }
  },
  mounted(){
    this.check_photos();
  }
}
</script>