<template>
  <div class="root">
    <div class="edit-pengujian">
      <div id="first-row" class="row">
        <div class="col-sm-12">
          <p id="edit-pengujian">Edit Pengujian</p>
          <div id="second-row" class="row">
            <div class="col-sm-7">
              <p class="text">Tanggal Terima</p>
              <input class="input-text" type="text" placeholder="31-January-2020"/>
              <p class="text">Tanggal Pengujian</p>
              <input class="input-text" type="text" placeholder="31-January-2020"/>
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
              <input class="input-text" type="text" placeholder="e.g PT.Bumi Perkasa"/>
              <p class="text">NPWP</p>
              <input class="input-text" type="number" placeholder="677503456445001"/>
            </div>
            <div class="col-sm-5">
              <p class="text">Proyek</p>
              <input class="input-text" type="text" placeholder="e.g. Toko Buku Jaya"/>
              <p class="text">Status Pembayaran</p>
              <button id="status_pembayaran" v-bind:style="{background: status_pembayaran_color }" v-on:click="change_status_pembayaran()" > {{ status_pembayaran }} </button>
              <p class="text">Status Pengujian</p>
              <button id="status_pengujian" v-bind:style="{background: status_pengujian_color }" v-on:click="change_status_pengujian()" > {{ status_pengujian }} </button>
              <p class="text">Status Persetujuan</p>
              <button id="status_persetujuan" v-bind:style="{background: status_persetujuan_color }" v-on:click="change_status_persetujuan()" > {{ status_persetujuan }} </button>
              <p class="text">Status Pengambilan</p>
              <input class="input-text" type="text" placeholder="Belum diambil"/>
              <p class="text">Nomor Laporan</p>
              <input class="input-text" type="text" placeholder="108/L.BT/Test/2020"/>
              <p class="text">Upload Laporan</p>
              <input class="input-text" type="text" ref="file_laporan" placeholder="nothing selected" readonly/>
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
                <a href="#none">Update</a>
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
<style scoped>
.root{
  padding: 0;
  margin: 0;
  background: #e9f5ec;
  z-index: 0;
  min-height: 83vh;
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
      teknisi_selected: 0,
      pembuka_selected: 0,
      engineer_selected: 0,
      teknisis: [
        {text: "saya", value:0},
        {text: "sayang", value:1},
        {text: "kamu", value:2}
      ],
      pembukas:[
        {text: "saya", value:0},
        {text: "sayang", value:1},
        {text: "kamu", value:2}
      ],
      engineers:[
        {text: "saya", value:0},
        {text: "sayang", value:1},
        {text: "kamu", value:2}
      ],
      nama_laporan: "Nothing selected",
      file_laporan: []
    }
  },
  methods: {
    update_laporan(){
      if(this.$refs.laporan_upload.files.length > 0){
        this.nama_laporan = this.$refs.laporan_upload.files.item(0).name;
        this.files = this.$refs.laporan_upload.files;        
      }
      this.$refs.file_laporan.value = this.nama_laporan;
    },
    hapus_laporan(){
      this.file_laporan = [];
      this.nama_laporan = "Nothing selected";
      this.$refs.file_laporan.value = this.nama_laporan;
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
    }
  },
  mounted() {
    this.update_laporan()
  }
}
</script>