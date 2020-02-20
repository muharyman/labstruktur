<template>
  <div class="root">
    <div id="content" class="row">
      <div class="col-sm-12">
        <div class="tambahinventaris-container">
          <div id="tambahinventaris-header">
            <p>Tambah Inventaris</p>
          </div>
          <div class="row">
            <div class="col">
              <p class="text">Nama Barang</p>
              <input class="text-input" v-model="nama_barang" type="text" placeholder="nama barang"/>
              <p class="text">Jumlah Barang</p>
              <input class="text-input" v-model="jumlah_barang" type="text" placeholder="Jumlah Barang"/>
            </div>
            <div class="col">
              <p class="text">Deskripsi Barang</p>
              <textarea class="text-input-deskripsi" v-model="deskripsi_barang" type="text" placeholder="deskripsi"></textarea>
            </div>
          </div>
          <p class="text">Catatan</p>
          <textarea class="text-input-catatan" v-model="catatan_barang" type="text" placeholder="catatan"></textarea>
          <p class="text">Upload foto</p>
          <label for="foto-upload" class="upload-foto-container" >
            <div id="row" class="row">
              <div id="kolom1" class="col-sm-10">
                <div class="upload-foto" >
                  <p>{{ foto_status }}</p>
                </div>
              </div>
              <div id="kolom2" class="col-sm-2">
                <div class="button" >
                  <p>Open File</p>
                </div>
              </div>
            </div>
          </label>
          <p class="text">Upload File Inventaris</p>
          <label for="file-upload" class="upload-foto-container" >
            <div id="row" class="row">
              <div id="kolom1" class="col-sm-10">
                <div class="upload-foto" >
                  <p>{{ file_status }}</p>
                </div>
              </div>
              <div id="kolom2" class="col-sm-2">
                <div class="button" >
                  <p>Open File</p>
                </div>
              </div>
            </div>
          </label>
          <input id="file-upload" ref="file_upload" type="file" @change="fileStatus()" />
          <input id="foto-upload" ref="foto_upload" type="file" accept="image/png, image/jpeg" multiple @change="update_status()" />
          <div class="button2" >
            <a @click="kirim()">SIMPAN</a>
          </div>
        </div>
      </div>
    </div>
    <div class="tambahinventarisbyfile">
      <div id="tambahinventaris-header">
        <p>Tambah Inventaris</p>
      </div>
      <p class="text">Upload File Excel Inventaris</p>
      <label for="excel-upload" class="upload-foto-container" >
        <div id="row" class="row">
          <div id="kolom1" class="col-sm-10">
            <div class="upload-foto" >
              <p>{{ excel_status }}</p>
            </div>
          </div>
          <div id="kolom2" class="col-sm-2">
            <div class="button" >
              <p>Open File</p>
            </div>
          </div>
        </div>
      </label>
      <input id="excel-upload" ref="excel_upload" type="file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" @change="excelStatus()" />
      <div class="button2" >
        <a @click="upload()">Upload</a>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name:'tambahinventaris',
  data(){
    return{
      nama_barang : "",
      jumlah_barang: 0,
      deskripsi_barang: "",
      catatan_barang: "",
      foto_status: "Tidak ada foto yang dipilih",
      file_status: "Tidak ada file yang dipilih",
      excel_status: "Tidak ada file yang dipilih",
      files: [],
      dokumen: '',
      excel:'',
      r: {},
      error: {}
    }
  },
  methods:{
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
    fileStatus(){
      if(this.$refs.file_upload.files.length > 0){
        this.file_status="";
        this.file_status = this.$refs.file_upload.files.item(0).name;
        this.dokumen = this.$refs.file_upload.files.item(0);
      } else{
        this.file_status = "Tidak ada file yang dipilih";
      }
    },
    excelStatus(){
      if(this.$refs.excel_upload.files.length > 0){
        this.excel_status="";
        this.excel_status = this.$refs.excel_upload.files.item(0).name;
        this.excel = this.$refs.excel_upload.files.item(0);
      } else{
        this.excel_status = "Tidak ada file yang dipilih";
      }
    },
    upload(){
      let formData = new FormData();
      const token = window.localStorage.getItem('token');
      formData.append('excel', this.excel);
      this.axios
        .post("/inventaris/import",
          formData,{
          headers: { 
            "Authorization": `Bearer ${token}`,
            'content-type': 'multipart/form-data'
          }
        })
        .then(respone => {
          this.r = respone.data;
          alert("Inventaris berhasil ditambahkan");
        })
        .catch(e => {
          this.error = e;
          this.showAlert = true;
        })
        .finally(() => {
          (this.excel_status = "Tidak ada file yang dipilih"),
          (this.excel = '');
        });
    },
    kirim() {
      let formData = new FormData();
      const token = window.localStorage.getItem('token');
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
        .post("/inventaris/create/",
          formData,{
          headers: { 
            "Authorization": `Bearer ${token}`,
            'content-type': 'multipart/form-data'
          }
        })
        .then(respone => {
          this.r = respone.data;
          alert("Inventaris berhasil ditambahkan");
        })
        .catch(e => {
          this.error = e;
          this.showAlert = true;
        })
        .finally(() => {
          (this.nama_barang = ""),
          (this.jumlah_barang = ""),
          (this.deskripsi_barang = ""),
          (this.catatan_barang= ""),
          (this.files = []),
          (this.dokumen = ''),
          (this.file_status ="Tidak ada file yang dipilih"),
          (this.foto_status ="Tidak ada foto yang dipilih");
        });
      }
    },
    mounted(){
      if(window.localStorage.getItem('jabatan') == 5){
        alert("maaf, anda tidak memiliki wewenang untuk menuju ke tautan tersebut");
        window.location.href= "/dashboard";
      }
    }
}
</script>
<style scoped>
.root{
  padding: 0;
  margin: 0;
  background: #e9f5ec;
  z-index: -1;
  min-height: 100vh;
  overflow-x: hidden;
}

#content{
  padding: 0;
  margin-top: 8%;
  overflow-y: hidden;
}
.tambahinventarisbyfile{
  margin: 25px 5vw;
  border-radius: 4px;
  background: white;
  padding: 5px 25px;
  box-shadow: 2px 2px 5px #878788;
}
.tambahinventaris-container{
  margin: 10px 5vw;
  border-radius: 4px;
  background: white;
  padding: 5px 25px;
  box-shadow: 2px 2px 5px #878788;
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
  width: inherit;
  border-radius: 4px;
}

.text-input:focus{
  border: 2px solid #1A53FF;
  border-radius: 4px;
}
.text-input-deskripsi{
  border: 2px solid #24D39B;
  padding: 5px 8px;
  height: 80%;
  font-size: 17px;
  margin-bottom: 8px;
  width: inherit;
  border-radius: 4px;
  resize: none;
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
.text-input-deskripsi:focus{
  border: 2px solid #1A53FF;
  border-radius: 4px;
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

</style>
