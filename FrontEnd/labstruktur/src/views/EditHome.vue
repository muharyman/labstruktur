<template>
  <div class="root">
    <div class="header">
      <h1>Edit Home</h1>
    </div>
    <div class="edit-kegiatan">
      <p class="text">Upload foto 1</p>
      <label for="foto-upload-1" class="upload-foto-container" >
        <div id="row" class="row">
          <div id="kolom1" class="col-sm-10">
            <div class="upload-foto" >
              <p>{{ status_1 }}</p>
            </div>
          </div>
          <div id="kolom2" class="col-sm-2">
            <div class="button" >
              <p>Open File</p>
            </div>
          </div>
        </div>
      </label>
      <input id="foto-upload-1" ref="foto_upload_1" type="file" accept="image/png, image/jpeg" multiple @change="update_status_foto_1()" />
      <p class="text">Deskripsi foto 1</p>
      <textarea class="text-input-deskripsi" v-model="deskripsi_1" type="text" placeholder="caption"></textarea>
      <p class="text">Upload foto 2</p>
      <label for="foto-upload-2" class="upload-foto-container" >
        <div id="row" class="row">
          <div id="kolom1" class="col-sm-10">
            <div class="upload-foto" >
              <p>{{ status_2 }}</p>
            </div>
          </div>
          <div id="kolom2" class="col-sm-2">
            <div class="button" >
              <p>Open File</p>
            </div>
          </div>
        </div>
      </label>
      <input id="foto-upload-2" ref="foto_upload_2" type="file" accept="image/png, image/jpeg" multiple @change="update_status_foto_2()" />
      <p class="text">Deskripsi foto 2</p>
      <textarea class="text-input-deskripsi" v-model="deskripsi_2" type="text" placeholder="caption"></textarea>
      <p class="text">Upload foto 3</p>
      <label for="foto-upload-3" class="upload-foto-container" >
        <div id="row" class="row">
          <div id="kolom1" class="col-sm-10">
            <div class="upload-foto" >
              <p>{{ status_3 }}</p>
            </div>
          </div>
          <div id="kolom2" class="col-sm-2">
            <div class="button" >
              <p>Open File</p>
            </div>
          </div>
        </div>
      </label>
      <input id="foto-upload-3" ref="foto_upload_3" type="file" accept="image/png, image/jpeg" multiple @change="update_status_foto_3()" />
      <p class="text">Deskripsi foto 3</p>
      <textarea class="text-input-deskripsi" v-model="deskripsi_3" type="text" placeholder="caption"></textarea>
      <br/><br/><br/>
      <div id="text-header">
        edit Profile
      </div>
      <p class="text">Upload foto Profile</p>
      <label for="foto-upload-4" class="upload-foto-container" >
        <div id="row" class="row">
          <div id="kolom1" class="col-sm-10">
            <div class="upload-foto" >
              <p>{{ foto_profil_status }}</p>
            </div>
          </div>
          <div id="kolom2" class="col-sm-2">
            <div class="button" >
              <p>Open File</p>
            </div>
          </div>
        </div>
      </label>
      <input id="foto-upload-4" ref="foto_upload_profil" type="file" accept="image/png, image/jpeg" multiple @change="update_status_foto_profil()" />
      <p class="text">Deskripsi Profile</p>
      <textarea class="text-input-deskripsi" v-model="profil" type="text" placeholder="caption"></textarea>
      <br/><br/><br/>
      <div id="text-header">
        edit Kontak
      </div>
      <p class="text">Nama</p>
      <input class="text-input" v-model="nama_kontak" type="text" placeholder="nama"/>
      <p class="text">Alamat</p>
      <input class="text-input" v-model="alamat" type="text" placeholder="alamat"/>
      <p class="text">Email</p>
      <input class="text-input" v-model="email" type="text" placeholder="email"/>
      <p class="text">No. Telp</p>
      <input class="text-input" v-model="kontak" type="text" placeholder="telp"/>
      <div class="button2" >
        <a @click="upload()">Update</a>
      </div>
    </div>
  </div> 
</template>
<style scoped>
.root{
  padding: 0;
  margin: 0;
  background: #e9f5ec;
  z-index: -1;
  min-height: 100vh;
  overflow-x: hidden;
}
.header{
  margin-top: 10vh;
  width: 100%;
  text-align: center;
  font-family: 'Raleway', sans-serif;
}
.edit-kegiatan{
  margin: 10vh 5vw;
  border-radius: 4px;
  background: white;
  padding: 10px 45px;
  box-shadow: 2px 2px 5px #878788;
}
#content{
  padding: 0;
  margin-top: 8%;
  overflow-y: hidden;
}

#tambahinventaris-header{
  font-family: "Raleway", sans-serif;
  font-size: 32px;
  font-weight: 300;
}
#text-header{
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
  height: 28%;
  width: 100%;
  border-radius: 4px;
}

.text-input:focus{
  border: 2px solid #1A53FF;
  border-radius: 4px;
}
.text-input-catatan{
  border: 2px solid #24D39B;
  padding: 5px 8px;
  height: 75%;
  font-size: 17px;
  margin-bottom: 8px;
  width: 100%;
  border-radius: 4px;
  resize: none;
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
#file-upload{
  display: none;
}
#excel-upload{
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
  margin:auto;
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
  margin-top: 12px;
  margin-bottom: 12px;
  height: 100%;
  border-radius: 4px;
  text-align: center;
  cursor: pointer;
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
.text-input-deskripsi{
  border: 2px solid #24D39B;
  padding: 5px 8px;
  height: 15vh;
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
#foto-upload-1, #foto-upload-2, #foto-upload-3, #foto-upload-4{
  display: none;
} 
</style>

<script>
export default {
    name:"edithome",
  data(){
    return{
      profil: "",
      foto_profil: null,
      foto_profil_status: "tidak ada foto yang dipilih",
      status_1: "tidak ada foto yang dipilih",
      status_2: "tidak ada foto yang dipilih",
      status_3: "tidak ada foto yang dipilih",
      foto_1: null,
      foto_2: null,
      foto_3: null,
      deskripsi_1: "",
      deskripsi_2: "",
      deskripsi_3: "",
      alamat: "",
      email: "",
      kontak: "",
      nama_kontak: "",
      photos: [
      ],
      visi_misi:"",
      fungsi:"",
      error: ''
    }
  },
  methods:{
    get(){
      this.axios
        .get("/landingpage/get")
        .then(respone => {
          this.profil = respone.data.profil;
          this.visi_misi = respone.data.visi_misi;
          this.fungsi = respone.data.fungsi;
          this.email = respone.data.email;
          this.kontak = respone.data.kontak;
          this.nama_kontak = respone.data.nama_kontak;
          this.alamat = respone.data.alamat;
          for (let i=0; i<respone.data.photos.length && i<3; i++){
            this.photos.push(respone.data.photos[i].idfoto);
          }
          this.deskripsi_1 = respone.data.photos[0].deskripsi;
          this.deskripsi_2 = respone.data.photos[1].deskripsi;
          this.deskripsi_3 = respone.data.photos[2].deskripsi;
        });
    },
    update_status_foto_1(){
      if(this.$refs.foto_upload_1.files.length > 0){
        this.status_1 = this.$refs.foto_upload_1.files.item(0).name;
        this.foto_1 = this.$refs.foto_upload_1.files.item(0);
      } else{
        this.status_1 = "tidak ada foto yang dipilih";
        this.foto_1 = null;
      }
    },
    update_status_foto_2(){
      if(this.$refs.foto_upload_2.files.length > 0){
        this.status_2 = this.$refs.foto_upload_2.files.item(0).name;
        this.foto_2 = this.$refs.foto_upload_2.files.item(0);
      } else{
        this.status_2 = "tidak ada foto yang dipilih";
        this.foto_2 = null;
      }
    },
    update_status_foto_3(){
      if(this.$refs.foto_upload_3.files.length > 0){
        this.status_3 = this.$refs.foto_upload_3.files.item(0).name;
        this.foto_3 = this.$refs.foto_upload_3.files.item(0);
      } else{
        this.status_3 = "tidak ada foto yang dipilih";
        this.foto_3 = null;
      }
    },
    update_status_foto_profil(){
      if(this.$refs.foto_upload_profil.files.length > 0){
        this.foto_profil = this.$refs.foto_upload_profil.files.item(0).name;
        this.foto_profil_status = this.$refs.foto_upload_profil.files.item(0);
      } else{
        this.foto_profil_status = "tidak ada foto yang dipilih";
        this.foto_profil = null;
      }
    },
    upload(){
      //  profil: "",
      // foto_profil: null,
      // foto_profil_status: "tidak ada foto yang dipilih",
      // status_1: "tidak ada foto yang dipilih",
      // status_2: "tidak ada foto yang dipilih",
      // status_3: "tidak ada foto yang dipilih",
      // foto_1: null,
      // foto_2: null,
      // foto_3: null,
      // deskripsi_1: "",
      // deskripsi_2: "",
      // deskripsi_3: "",
      // alamat: "",
      // email: "",
      // kontak: "",
      // nama_kontak: "",
      // photos: [
      // ],
      // visi_misi:"",
      // fungsi:"",
      let formData = new FormData();
      const token = window.localStorage.getItem('token');
      formData.append('profil', this.profil);
      formData.append('alamat', this.alamat);
      formData.append('email', this.email);
      formData.append('kontak', this.kontak);
      formData.append('nama_kontak', this.nama_kontak);
      formData.append('visi_misi', this.visi_misi);
      formData.append('fungsi', this.fungsi);
      if (this.foto_profil) formData.append('foto_profil', this.foto_profil);
      formData.append('photos[0][deskripsi]', this.deskripsi_1);
      formData.append('photos[0][idfoto]', this.photos[0]);
      if (this.foto_1) formData.append('photos[0][foto]', this.foto_1);
      formData.append('photos[1][deskripsi]', this.deskripsi_2);
      formData.append('photos[1][idfoto]', this.photos[1]);
      if (this.foto_2) formData.append('photos[1][foto]', this.foto_2);
      formData.append('photos[2][deskripsi]', this.deskripsi_3);
      formData.append('photos[2][idfoto]', this.photos[2]);
      if (this.foto_2) formData.append('photos[2][foto]', this.foto_3);
      this.axios
        .post("/landingpage/edit",
        formData,{
          headers: { 
            "Authorization": `Bearer ${token}`,
            'content-type': 'multipart/form-data'
          }
        })
        .then(() => {
          alert('landing page berhasil di edit');
        })
        .catch(e =>{
          this.error = e;
          alert('gagal mengedit landing page');
        });
    }
  },
  mounted(){
    if(window.localStorage.getItem('jabatan') == 5){
      alert("maaf, anda tidak memiliki wewenang untuk menuju ke tautan tersebut");
      window.location.href= "/dashboard";
    }else{
      this.get();
    }
  }
}
</script>>