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
              <b-modal id="hapus-modal" ref="hapus-modal" hide-footer title="Peringatan">
                <div class="d-block text-center">
                  <h3>Apakah anda yakin ingin menghapus foto?</h3>
                  <p>*Note : Foto yang dihapus tidak dapat dikembalikan!</p>
                </div>
                <b-button class="mt-3" variant="outline-danger" block @click="benerHapus()">HAPUS</b-button>
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
          <input class="text-input" type="text" v-model="nama_barang" placeholder="nama barang"/>
          <p class="text">Jumlah Barang</p>
          <input class="text-input" type="text" v-model="jumlah_barang" placeholder="Jumlah Barang"/>
          <p class="text">Deskripsi Barang</p>
          <textarea class="text-input-deskripsi" type="text" v-model="deskripsi_barang" placeholder="deskripsi"></textarea>
          <p class="text">Upload File Inventaris</p>
          <label for="file-upload" class="upload-foto-container" >
            <div id="row" class="row">
              <div id="kolom1" class="col-sm-4">
                <div class="upload-file" >
                  <p>{{ file_status }}</p>
                </div>
              </div>
              <div id="kolom2" class="col-sm-4">
                <div class="button" >
                  <p>Open File</p>
                </div>
              </div>
              <div id="kolom3" class="col-sm-4">
                <div class="button3" >
                  <p>Delete File</p>
                </div>
              </div>
            </div>
          </label>
          <input id="file-upload" ref="file_upload" type="file" @change="fileStatus()" />
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
            <a @click="kirim()">SIMPAN</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name:'editinventaris',
  data(){
    return{
      nama_barang : "",
      jumlah_barang: 0,
      deskripsi_barang: "",
      catatan_barang: "",
      foto_status: "Tidak ada foto yang dipilih",
      file_status: "Tidak ada file yang dipilih",
      file_url: "ga ada",
      curent_index: 0,
      curent_src: this.axios.defaults.baseURL + "/getfile?filepath=public%2Fnotfound.png",
      photos: [],
      id_photos:[],
      files: [],
      dokumen: '',
      r: {},
      error: {}
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
    openDeleteDialog(){
      this.$refs['hapus-modal'].show()
    },
    fileStatus(){
      if(this.$refs.file_upload.files.length > 0){
        this.file_status="";
        this.file_status = this.$refs.file_upload.files.item(0).name;
        this.dokumen = this.$refs.file_upload.files.item(0);
      } else{
        this.file_status = "Tidak ada file yang dipilih";
      }
    },
    update_status(){
      if(this.$refs.foto_upload.files.length > 0){
        this.foto_status="";
        for( var i = 0; i< this.$refs.foto_upload.files.length; i++){
          this.foto_status = this.foto_status + this.$refs.foto_upload.files.item(i).name + "; ";
        }
        this.files = this.$refs.foto_upload.files;
      } else{
        this.foto_status = "Tidak ada foto yang dipilih";
      }
    },
    kirim() {
      let formData = new FormData();
      formData.append('nama',this.nama_barang);
      formData.append('jumlah',this.jumlah_barang);
      formData.append('deskripsi',this.deskripsi_barang);
      formData.append('catatan',this.catatan_barang);
      for( var i = 0; i < this.files.length; i++ ){
          let file = this.files[i];
          formData.append('foto[' + i + ']', file);
        }
      formData.append('file', this.dokumen);
      this.axios
        .post("/inventaris/update/"+ this.$route.params.id,
          formData,{
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        })
        .then(respone => {
          this.r = respone.data;
          alert("Inventaris berhasil diperbaharui");
        })
        .catch(e => {
          this.error = e;
          this.showAlert = true;
        })
    },
    getDetailInventaris(){
      this.axios
        .get("/inventaris/show/"+ this.$route.params.id)
        .then(respone =>{
          this.nama_barang = respone.data.data.nama;
          this.jumlah_barang = respone.data.data.jumlah;
          this.deskripsi_barang = respone.data.data.deskripsi;
          this.photos = [];
          respone.data.data.photos.forEach(element => {
            this.photos.push(element.foto_url);
          });
          this.id_photos = [];
          respone.data.data.photos.forEach(element => {
            this.id_photos.push(element.idfoto);
          });
          this.file_url = respone.data.data.file_url;
          if( this.file_url !== "ga ada"){
            this.file_status = "sudah ada file di server";
          }
          this.check_photos();
        })
    },
    benerHapus(){
      this.axios
        .delete("/fotoinventaris/delete/"+this.id_photos[this.curent_index])
        .then(respone =>{
          this.r = respone.data;
          this.getDetailInventaris();
          alert("berhasil menghapus foto")
        })
        .catch(e =>{
          alert(e.response.data);
        })
      this.$bvModal.hide('hapus-modal');
    }
  },
  mounted(){
    this.check_photos();
    this.getDetailInventaris();
  }
}
</script>

<style scoped>
#file-upload{
  display: none;
}
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
  width: 100%;
  height: 73vh;
  background: white;
  border-radius: 2px;
  padding: 10px 20px;
  box-shadow: 2px 2px 5px #878788;
}
.mySlides1{
  width: 100%;
  height: 88%;
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
  box-shadow: 2px 2px 5px #878788;
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
  height: 5vh;
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
  height: 15%;
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
.upload-file{
  border: 2px solid #24D39B;
  padding: 3px 8px;
  font-size: 12px;
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
  font-size: 12px;
}
#kolom2{
  height: 5vh;
}
#kolom3{
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
  margin-top: 10px;
  margin-bottom: 25px;
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
