<template>
  <div class="root">
    <div class="edit-pengujian">
      <div id="first-row" class="row">
        <div class="col-sm-12">
          <p id="edit-pengujian">Edit Pengujian</p>
          <div id="second-row" class="row">
            <div class="col-sm-7">
              <p class="text">Tanggal Terima</p>
              <input class="input-text" type="text" v-model="tanggal_terima" placeholder="2020-01-31"/>
              <p class="text">Tanggal Pengujian</p>
              <input class="input-text" type="text" v-model="tanggal_pengujian" placeholder="2020-01-31"/>
              <p class="text">Pembuka</p>
              <div class="select-style">
                <select v-model="pembuka_selected" name="pembuka">
                  <option v-for="pembuka in pembukas" v-bind:value="pembuka.value" :key="pembuka">{{ pembuka.text }}</option>
                </select>
              </div>
              <p class="text">Teknisi</p>
              <div class="select-style">
                <select v-model="teknisi_selected" name="teknisi">
                  <option v-for="teknisi in teknisis" v-bind:value="teknisi.value" :key="teknisi">{{ teknisi.text }}</option>
                </select>
              </div>          
              <p class="text">Engineer</p>  
              <div class="select-style">
                <select v-model="engineer_selected" name="engineer">
                  <option v-for="engineer in engineers" v-bind:value="engineer.value" :key="engineer">{{ engineer.text }}</option>
                </select>
              </div>
              <p class="text">Pemberi Tugas</p>
              <input class="input-text" type="text" v-model="pemberi_tugas" placeholder="e.g PT.Bumi Perkasa"/>
              <p class="text">NPWP</p>
              <input class="input-text" type="number" v-model="npwp" placeholder="677503456445001"/>
              <p class="text">Email</p>
              <input class="input-text" type="text" v-model="email" placeholder="name@email.com"/>
            </div>
            <div class="col-sm-5">
              <p class="text">Proyek</p>
              <input class="input-text" type="text" v-model="proyek" placeholder="e.g. Toko Buku Jaya"/>
              <p class="text">Status Pembayaran</p>
              <button id="status_pembayaran" v-bind:style="{background: status_pembayaran_color }" v-on:click="change_status_pembayaran()"> {{ status_pembayaran }} </button>
              <p class="text">Status Pengujian</p>
              <button id="status_pengujian" v-bind:style="{background: status_pengujian_color }" v-on:click="change_status_pengujian()" > {{ status_pengujian }} </button>
              <p class="text">Status Persetujuan</p>
              <button id="status_persetujuan" v-bind:style="{background: status_persetujuan_color }" v-on:click="change_status_persetujuan()" > {{ status_persetujuan }} </button>
              <p class="text">Status Pengambilan</p>
              <button id="status_pengambilan" v-bind:style="{background: status_pengambilan_color }" v-on:click="change_status_pengambilan()" > {{ status_pengambilan }} </button>
              <!-- <input class="input-text" type="text" v-model="status_pengambilan" placeholder="Belum diambil"/> -->
              <p class="text">Nomor Laporan</p>
              <input class="input-text" type="text" v-model="nomor_laporan" placeholder="108/L.BT/Test/2020"/>
              <p class="text">Upload Laporan</p>
              <input class="input-text" type="text" v-model="nama_dokumen" placeholder="nothing selected" readonly/>
              <div id="third-row" class="row">
                <div class="col-sm-6">
                  <label for="laporan-upload" class="container">
                    <div class="button">
                      <a>Pilih File</a>
                    </div>
                  </label>
                </div>
                <div class="col-sm-6">
                  <div class="button2" v-on:click="hapus_laporan()">
                    <a>Hapus File</a>
                  </div>
                </div>
              </div>
              <input id="laporan-upload" ref="laporan_upload" type="file" accept="application/pdf" @change="update_laporan()" />
              <div class="button">
                <a @click="updatePengujian()">Update</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="edit-item-pengujian">
      <p id="edit-item-pengujian">Edit Item Pengujian</p>
      <EditItemPengujian></EditItemPengujian>
    </div>
    <div class="edit-pembayaran">
      <p id="edit-pembayaran">Edit Pembayaran</p>
      <EditPembayaran></EditPembayaran>
    </div>
  </div>
</template>
<script>
import EditItemPengujian from "@/components/EditItemPengujian.vue";
import EditPembayaran from "@/components/EditPembayaran.vue";
export default {
  name: "tambapengujian",
  components:{
    EditItemPengujian,
    EditPembayaran
  },
  data(){
    return{
      is_pembayaran : 0,
      status_pembayaran_color : '#C80000',
      status_pembayaran : "Belum Lunas",
      is_pengujian : 1,
      status_pengujian_color : '#24D39B',
      status_pengujian : "Buka",
      is_persetujuan : 0,
      status_persetujuan_color : '#C80000',
      status_persetujuan : "Belum Disteujui",
      is_pengambilan : 0,
      status_pengambilan_color : '#C80000',
      status_pengambilan : "Belum Diambil",
      teknisi_selected: 0,
      pembuka_selected: 0,
      engineer_selected: 0,
      teknisis: [
      ],
      pembukas:[
      ],
      engineers:[
      ],
      nama_dokumen: '',
      file_laporan: '',
      pengujian:"",
      tanggal_terima: "",
      tanggal_pengujian: "",
      pemberi_tugas: "",
      npwp: "",
      proyek:"",
      nomor_laporan: "",
      email:"",
      error:"",
      res:""
    }
  },
  methods: {
    update_laporan(){
      if(this.$refs.laporan_upload.files.length > 0){
        this.nama_dokumen = this.$refs.laporan_upload.files.item(0).name;
        this.file_laporan = this.$refs.laporan_upload.files.item(0);        
      }
    },
    hapus_laporan(){
      this.axios
        .delete("/pengujian/deletelaporan/" + this.$route.params.id)
        .then(respone => {
          this.res = respone;
          alert('laporan dengan nama '+ this.nama_dokumen+ ' berhasil di hapus');
        });
      this.file_laporan = [];
      this.nama_dokumen = "Tidak ada File";
    },
    set_status_pembayaran(){
      if (this.is_pembayaran === 1){
        this.is_pembayaran = 1;
        this.status_pembayaran_color = '#24D39B';
        this.status_pembayaran = 'Lunas';
      } else if (this.is_pembayaran === 0){
        this.is_pembayaran = 0;
        this.status_pembayaran_color = '#C80000';
        this.status_pembayaran = 'Belum Lunas';
      } else{
        this.is_pembayaran = 0;
        this.status_pembayaran_color = '#C80000';
        this.status_pembayaran = 'Belum Lunas';
      }
    },
    set_status_pengujian(){
      if (this.is_pengujian === 1){
        this.is_pengujian = 1;
        this.status_pengujian_color = '#24D39B';
        this.status_pengujian = 'Buka';
      } else{
        this.is_pengujian = 0;
        this.status_pengujian_color = '#C80000';
        this.status_pengujian = 'Tutup';
      }
    },
    set_status_persetujuan(){
      if (this.is_persetujuan === 1){
        this.is_persetujuan = 1;
        this.status_persetujuan_color = '#24D39B';
        this.status_persetujuan = 'Disetujui';
      } else{
        this.is_persetujuan = 0;
        this.status_persetujuan_color = '#C80000';
        this.status_persetujuan = 'Belum Disetujui';
      }
    },
    set_status_pengambilan(){
      if (this.is_pengambilan === 1){
        this.is_pengambilan = 1;
        this.status_pengambilan_color = '#24D39B';
        this.status_pengambilan = 'Sudah Diambil';
      } else{
        this.is_pengambilan = 0;
        this.status_pengambilan_color = '#C80000';
        this.status_pengambilan = 'Belum Diambil';
      }
    },
    change_status_pembayaran(){
      if (this.is_pembayaran === 1){
        this.is_pembayaran = 0;
        this.status_pembayaran_color = '#C80000';
        this.status_pembayaran = 'Belum Lunas';
      } else{
        this.is_pembayaran = 1;
        this.status_pembayaran_color = '#24D39B';
        this.status_pembayaran = 'Lunas';
      }
    },
    change_status_pengujian(){
      if (this.is_pengujian === 1){
        this.is_pengujian = 0;
        this.status_pengujian_color = '#C80000';
        this.status_pengujian = 'Tutup';
      } else{
        this.is_pengujian = 1;
        this.status_pengujian_color = '#24D39B';
        this.status_pengujian = 'Buka';
      }
    },
    change_status_persetujuan(){
      if (this.is_persetujuan === 1){
        this.is_persetujuan = 0;
        this.status_persetujuan_color = '#C80000';
        this.status_persetujuan = 'Belum Disetujui';
      } else{
        this.is_persetujuan = 1;
        this.status_persetujuan_color = '#24D39B';
        this.status_persetujuan = 'Disetujui';
      }
    },
    change_status_pengambilan(){
      if (this.is_pengambilan === 1){
        this.is_pengambilan = 0;
        this.status_pengambilan_color = '#C80000';
        this.status_pengambilan = 'Belum Diambil';
      } else{
        this.is_pengambilan = 1;
        this.status_pengambilan_color = '#24D39B';
        this.status_pengambilan = 'Sudah Diambil';
      }
    },
    refreshPengujian(){
      this.getPengujian();
      this.getPembuka();
      this.getTeknisi();
      this.getEngineers();
      this.set_status_pembayaran();
      this.set_status_pengujian();
      this.set_status_persetujuan();
      this.set_status_pengambilan();
    },
    getPembuka(){
      let pembuka = {
        text: "",
        value: 0
      }
      const user = JSON.parse(window.localStorage.getItem('user'));
      pembuka.text = user.nama_user;
      pembuka.value = user.iduser;
      this.pembukas = [];
      this.pembukas.push(pembuka);
    },
    getTeknisi(){
      this.axios
        .get("/user/index/role", {
          params:{
            roles: 4,
          }
        })
        .then(respone => {
          if( respone.data.data.length > 0){
            for(let i = 0; i< respone.data.data.length; i++){
              let teknisi={
                text: "",
                value:i
              }
              teknisi.text = respone.data.data[i].nama_user;
              teknisi.value = respone.data.data[i].iduser;
              this.teknisis.push(teknisi);
            }
          }
        });
    },
    getEngineers(){
      this.axios
        .get("/user/index/role",{
          params:{
            roles: 3,
          }
        })
        .then(respone => {
          if( respone.data.data.length > 0){
            for(let i = 0; i< respone.data.data.length; i++){
              let engineer={
                text: "",
                value:i
              }
              engineer.text = respone.data.data[i].nama_user;
              engineer.value = respone.data.data[i].iduser;
              this.engineers.push(engineer);
            }
          }
        });
    },
    getPengujian(){
      this.axios
        .get("/pengujian/show/"+this.$route.params.id)
        .then(respone => {
          this.pengujian = respone.data.data;
          this.is_pembayaran = this.pengujian.status_pembayaran;
          this.is_pengujian = this.pengujian.status_pengujian;
          this.is_pengambilan = this.pengujian.status_pengambilan;
          this.is_persetujuan = this.pengujian.status_persetujuan;
          this.tanggal_terima = this.pengujian.tanggal_terima;
          this.tanggal_pengujian = this.pengujian.tanggal_terima;
          this.pembuka_selected = this.pengujian.iduser_pembuka;
          this.teknisi_selected = this.pengujian.idteknisi;
          this.engineer_selected = this.pengujian.idengineer;
          this.pemberi_tugas = this.pengujian.pemberi_tugas;
          this.npwp = this.pengujian.npwp;
          this.proyek = this.pengujian.proyek;
          this.nomor_laporan = this.pengujian.nomor_laporan;
          this.nama_dokumen = this.pengujian.nama_laporan;
          this.email = this.pengujian.email;
        });
    },
    updatePengujian(){
      const token = window.localStorage.getItem('token');
      let formData = new FormData();
      formData.append('email',this.email);
      formData.append('idteknisi',this.teknisi_selected);
      formData.append('idengineer',this.engineer_selected);
      formData.append('pemberi_tugas',this.pemberi_tugas);
      formData.append('npwp',this.npwp);
      formData.append('proyek', this.proyek);
      formData.append('nomor_laporan', this.nomor_laporan);
      formData.append('tanggal_terima', this.tanggal_terima);
      formData.append('tanggal_pengujian', this.tanggal_pengujian);
      formData.append('status_persetujuan', this.is_persetujuan);
      formData.append('status_pengujian', this.is_persetujuan);
      formData.append('status_pengambilan', this.is_pengambilan);
      formData.append('status_pembayaran', this.is_pembayaran);
      formData.append('laporan', this.file_laporan);
      this.axios
        .post("/pengujian/update/"+this.$route.params.id,
          formData
        ,{
          headers: { 
            "Authorization": `Bearer ${token}`,
            'content-type': 'multipart/form-data'
          },
        }
        )
        .then(respone =>{
          alert(JSON.stringify(respone.data.success));
          let obj = respone.data;
          alert("Pengujian berhasil di update dengan id " + obj.idpengujian);
        })
        .catch(e =>{
          this.error = e,
          alert(e.message);
        });
    }
  },
  mounted() {
    this.refreshPengujian();
  }
}
</script>
<style scoped>
.root{
  padding: 0;
  margin: 0;
  background: #e9f5ec;
  z-index: 0;
  min-height: 100vh;
  overflow-x: hidden;
}
.edit-pengujian{
  margin-top:3%;
  padding: 24px 25px;
}
.edit-item-pengujian{
  margin-top:1%;
  margin:10px 68px;
  padding: 24px 25px;
  border-radius:4px;
  background: white; 
}
.edit-pembayaran{
  margin-top:1%;
  margin:10px 68px;
  padding: 24px 25px;
  border-radius:4px;
  background: white; 
}
#first-row{
  background: white;
  border-radius: 4px;
  margin: 0 45px;
  padding: 25px;
}
#second-row{
  background: white;
  width: inherit;
  margin: auto;
}
#edit-pengujian{
  font-size: 32px;
  margin-left: 10px;
  font-family: "Raleway", sans-serif;
  font-weight: 400;
}
#edit-item-pengujian{
  font-size: 32px;
  margin-left: 10px;
  font-family: "Raleway", sans-serif;
  font-weight: 400;
}
#edit-pembayaran{
  font-size: 32px;
  margin-left: 10px;
  font-family: "Raleway", sans-serif;
  font-weight: 400;
}
.col-sm-12{
  margin:auto;
  padding: 0;
}
.text{
  font-family: "Montserrat Alternates", sans-serif;
  font-weight: 400;
  font-size: 25;
  color: #636363;
  margin-bottom: 0;
}
.input-text{
  width:inherit;
  box-sizing: border-box;
  border:2px solid #24D39B;
  border-radius: 4px;
  margin-top: 0px;
  font-family: 'Montserrat Alternates', sans-serif;
  font-size: 12px;
  color:#000;
  padding: 8px 12px;
}
.input-text:focus{
  border-radius: 4px;
  border: 2px solid #0066ff;
  outline: 0;
}
.select-style {
    border: 2px solid #24D39B;
    width: inherit;
    border-radius: 4px;
    overflow: hidden;
    font-family: "Montserrat Alternates", sans-serif;
    font-size: 12px;
    color: #707070;
    padding: 8px 12px;
}

.select-style select {
    width: 100%;
    border: none;
    box-shadow: none;
    background: transparent;
    background-image: none;
    -webkit-appearance: none;
}

.select-style select:focus {
  outline: 0;
}
.container{
  width: 100%;
  height: 100%;
  padding: 0;
  cursor: pointer;
}

.button{
  width: 100%;
  margin-top: 15px;
}
.button a:hover{
  background: green;
  color: white;
  border-color: green;
  text-decoration: none;
}
.button a{
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
  width: 100%;
  margin-top: 15px;
  cursor: pointer;
}
.button2 a:hover{
  background: red;
  color: white;
  border-color: red;
  text-decoration: none;
}
.button2 a{
  display: block;
  font-family: 'Raleway', sans-serif;
  padding: 5px 10px;
  margin:auto;
  text-align: center;
  text-decoration: none;
  font-size: 17px;
  color: red;
  font-weight: 400;
  background: white;
  transition: 0.5s;
  border:1px solid red;
  border-radius: 4px;
}

#status_pembayaran{
  width: 100%;
  background: #24D39B;
  padding: 5px 12px;
  font-family: "Raleway", sans-serif;
  font-size: 20;
  font-weight: 700;
  text-align: center;
  color: white;
  margin: 5px 0;
  display: inline-block;
  border: none;
  text-decoration: none;
}

#status_pengujian{
  width: 100%;
  background: #24D39B;
  padding: 5px 12px;
  font-family: "Raleway", sans-serif;
  font-size: 20;
  font-weight: 700;
  text-align: center;
  color: white;
  margin:auto;
  display: inline-block;
  border: none;
  text-decoration: none;
}

#status_persetujuan{
  width: 100%;
  background: #24D39B;
  padding: 5px 12px;
  font-family: "Raleway", sans-serif;
  font-size: 20;
  font-weight: 700;
  text-align: center;
  color: white;
  margin:auto;
  display: inline-block;
  border: none;
  text-decoration: none;
}
#status_pengambilan{
  width: 100%;
  background: #24D39B;
  padding: 5px 12px;
  font-family: "Raleway", sans-serif;
  font-size: 20;
  font-weight: 700;
  text-align: center;
  color: white;
  margin:auto;
  display: inline-block;
  border: none;
  text-decoration: none;
}
#laporan-upload{
  display: none;
}
#hapus-laporan{
  display: none;
}
@media screen and (max-width: 600px){
  .root{
    height: fit-content;
  }
  .button a{
    font-size: 13px; 
  }
  #status{
    font-size: 17px;
  }
}
</style>

