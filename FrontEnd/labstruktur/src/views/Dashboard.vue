<template>
  <div class="root">
    <div class="status">
      <h2 class="title" id="text-pengujian">Pengujian</h2>
      <div class="row">
        <div class="col-sm-4">
          <div class="card addborder">
            <div class="card-body" id="bg-1">
              <h5 class="card-title text-title">Total Pengujian Hari Ini</h5>
              <h1 class="card-text text-center number">
                {{ jumlah_pengujian }}
              </h1>
              <div class="button-1">
                <a href="/listpengujian">Detail</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="card addborder">
            <div class="card-body" id="bg-2">
              <h5 class="card-title text-title">Pengujian Disetujui</h5>
              <h1 class="card-text text-center number">
                {{ disetujui }}
              </h1>
              <div class="button-1">
                <a href="/listpengujian">Detail</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="card addborder">
            <div class="card-body" id="bg-3">
              <h5 class="card-title text-title">Pengujian Belum Disetujui</h5>
              <h1 class="card-text text-center number">
                {{ belum_disetujui }}
              </h1>
              <div class="button-1">
                <a href="/listpengujian">Detail</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-6">
        <div class="block">
          <h3 class="title" id="gp-title">Grafik Pengujian</h3>
          <LineChartPengujian />
        </div>
      </div>
      <div class="col-sm-6">
        <div class="block">
          <h3 class="title" id="gp-title">Grafik Pendapatan</h3>
          <LineChartPendapatan />
        </div>
      </div>
    </div>
    <hr />
    <div class="row" id="dl-lap-con">
      <div class="col container1">
        <div class="title-1">Download Laporan Bulanan</div>
      </div>
      <div class="col container1">
        <div class="button-2" @click="openDownloadDialog()">Download</div>
      </div>
    </div>
    <b-modal id="download-modal" ref="download-modal" hide-footer title="Download">
      <div class="d-block">
        <p class="text">Tanggal</p>
        <b-form-input v-model="tanggal" placeholder="2020-01-31" class="input-border"/>
        <b-form-select v-model="rutin_selected" :options="rutins" class="input-border"></b-form-select>
      </div>
      <b-button class="mt-3" variant="primary" block @click="download()">Download</b-button>
    </b-modal>
  </div>
</template>

<style scoped>
.text{
  font-family: "Montserrat Alternates", sans-serif;
  font-size: 17px;
  color: #636363;
  line-height: 12px;
  margin: 0;
  margin-bottom: 8px;
}
.container1 {
  width: 100%;
  height: 100%;
}
#dl-lap-con {
  margin: 0;
  padding: 0;
  height: 60px;
  border: 2px solid #040029;
  background: #040029;
  border-radius: 4px 4px 0px 0px;
}
.root {
  padding: 0;
  margin: 0;
  background: #e9f5ec;
  z-index: 0;
  min-height: 100vh;
  overflow-x: hidden;
}
hr {
  margin-left: 10px;
  margin-right: 10px;
}
.addborder {
  border: 2px solid #1b3060;
  border-radius: 6px;
}
.row {
  margin-left: 10px;
  margin-right: 10px;
}
.status {
  margin: 13vh 3vw;
  border: 2px solid #1b3060;
  padding: 14px;
  border-radius: 4px;
  background: #1b3060;
  box-shadow: 2px 2px 5px #878788;
}
.title {
  margin: 25px 25px;
  font-family: "Montserrat ALternates", sans-serif;
  font-size: 45px;
  font-weight: 400;
}

.block {
  background: white;
  border: 2px solid white;
  border-radius: 6px;
  box-shadow: 2px 2px 5px #878788;
}
#text-pengujian {
  color: white;
}
#gp-title {
  margin: 25px 0;
  text-align: center;
}
.input-border{
  border: 2px solid #24D39B;
  border-radius: 4px;
}
.input-border:focus{
  border-color: blue;
}
.input-border:hover{
  border-color: blue;
}
#bg-1 {
  background: linear-gradient(to right, #3333cc, #0080ff);
  border-radius: 2px;
}
#bg-2 {
  background-image: linear-gradient(
    to right,
    rgba(59, 253, 38, 1),
    rgba(38, 253, 174, 1)
  );
  border-radius: 2px;
}
#bg-3 {
  background-image: linear-gradient(to right, #ff3300, #ff9980);
  border-radius: 2px;
}
.button-1 {
  width: 35%;
  height: fit-content;
}
.button-1 a:hover {
  background: none;
  color: white;
}
.button-1 a {
  display: block;
  font-family: "Montserrat Alternates", sans-serif;
  padding: 10px 10px;
  margin: auto;
  text-align: center;
  text-decoration: none;
  font-size: 14px;
  color: black;
  font-weight: 700;
  background: white;
  transition: 0.8s;
  cursor: pointer;
  /* border: 2px solid #1A53FF; */
  border-radius: 4px;
}
.title-1 {
  margin: auto;
  padding: 10px 10px;
  font-family: "Montserrat ALternates", sans-serif;
  font-size: 25px;
  font-weight: 400;
  color: white;   
}
.button-2 {
  width: 100%;
  height: 100%;
  background: transparent;
}
.button-2 {
  display: block;
  font-family: "Montserrat Alternates", sans-serif;
  margin: auto;
  text-align: center;
  text-decoration: none;
  color: white;
  font-size: 24px;
  font-weight: 500;
  background: transparent;
  transition: 0.8s;
  cursor: pointer;
  border-radius: 4px;
  width: 100%;
  height: 100%;
  padding: 10px;
}
.button-2:hover {
  background: white;
  color: black;
}
.download{
  width: fit-content;
  height: fit-content;
  margin: auto;
  margin-top: 10px;
}
/* .button-2 a{
  display: block;
  font-family: 'Montserrat Alternates', sans-serif;
  padding: 10px 10px;
  margin:auto;
  text-align: center;
  text-decoration: none;
  font-size: 14px;
  color: black;
  font-weight: 700;
  background: white;
  transition: 0.8s;
  cursor: pointer;
  border: 2px solid #1A53FF;
  border-radius: 4px;
} */
.text-title {
  font-family: "Raleway", sans-serif;
  font-size: 22px;
  font-weight: 700;
}
.number {
  font-size: 50px;
  font-family: "Montserrat Alternates", sans-serif;
  font-weight: 700;
  color: black;
}
</style>

<script>
import LineChartPengujian from "../components/LineChartPengujian.vue";
import LineChartPendapatan from "../components/LineChartPendapatan.vue";
export default {
  name: "dashboard",
  components: {
    LineChartPengujian,
    LineChartPendapatan
  },
  data() {
    return {
      items: [],
      jumlah_pengujian: 0,
      disetujui: 0,
      belum_disetujui: 0,
      rutins:[
        {value:1, text:"rutin"},
        {value:0, text:"non rutin"}
      ],
      tanggal:null,
      rutin_selected:1,
      user_jabatan:''
    };
  },
  methods:{    
    openDownloadDialog(){
      if(this.user_jabatan != 5){
        this.$refs['download-modal'].show();
      }else{
        alert("maaf, anda tidak memiliki wewenang untuk menuju ke tautan tersebut");
      }
      
    },
    download(){
      if (this.tanggal !== null){
        const token = window.localStorage.getItem('token');
        this.axios
          .get("/pembayaran/laporanbulanan/",{
            params:{
              'date':this.tanggal,
              'rutin':this.rutin_selected
            },
            headers: { 
            "Authorization": `Bearer ${token}`
            }
          })
      }else{
        alert("tolong masukan tanggal");
      }
    }
  },
  mounted() {
    this.user_jabatan = window.localStorage.getItem('jabatan');
    var dt = new Date().toISOString().slice(0, 10);
    const token = window.localStorage.getItem('token');
    this.axios
      .get("/pengujian/index/",{
        headers: { 
          "Authorization": `Bearer ${token}`
        }
      })
      .then(respone => {
        this.items = respone.data.data;
        for (var i = 0; i < this.items.length; i++) {
          if (
            this.items[i]["created_at"].includes(dt) &&
            this.items[i]["status_persetujuan"] == false
          ) {
            this.belum_disetujui = this.belum_disetujui + 1;
          }
          if (
            this.items[i]["created_at"].includes(dt) &&
            this.items[i]["status_persetujuan"] == true
          ) {
            this.disetujui = this.disetujui + 1;
          }
          if (this.items[i]["created_at"].includes(dt)) {
            this.jumlah_pengujian = this.jumlah_pengujian + 1;
          }
        }
      })
      .catch(e => {
        this.error = e;
        this.showAlert = true;
      });
  }
};
</script>
