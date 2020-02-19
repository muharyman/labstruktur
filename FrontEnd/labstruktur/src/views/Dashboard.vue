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
      <div class="col" id="container">
        <h4 class="title-1">Download Laporan Bulanan</h4>
      </div>
      <div class="col">
        <div class="button-2">
          <a href="#">Download</a>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
#container {
  display: inline;
}
#dl-lap-con {
  margin: 0;
  padding: 0;
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
  margin: 5vh 3vw;
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
.title-1 {
  margin: 25px 25px;
  font-family: "Montserrat ALternates", sans-serif;
  font-size: 25px;
  font-weight: 400;
  color: white;
  display: inline;
  text-align: center;
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
.button-2 {
  width: 100%;
  background: transparent;
}
.button-2 a {
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
}
.button-2 a:hover {
  background: white;
  color: black;
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
      belum_disetujui: 0
    };
  },
  mounted() {
    var dt = new Date().toISOString().slice(0, 10);
    this.axios
      .get("/pengujian/index/")
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
