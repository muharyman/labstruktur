<template>
  <div>
    <h2>Pengujian</h2>

    <div class="row">
      <div class="col-sm-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Total Pengujian Hari Ini</h5>
            <h1 class="card-text text-center">
              35
            </h1>
            <a href="#" class="btn btn-primary">Go somewhere</a>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Pengujian Disetujui</h5>
            <h1 class="card-text text-center">
              60
            </h1>
            <a href="#" class="btn btn-primary">Go somewhere</a>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Pengujian Belum Disetujui</h5>
            <h1 class="card-text text-center">
              70
            </h1>
            <a href="#" class="btn btn-primary">Go somewhere</a>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-6">
        <h3>Grafik Pengujian</h3>
        <LineChart />
      </div>
      <div class="col-sm-6">
        <h3>Grafik Pengujian</h3>
        <LineChart />
      </div>
    </div>
    <hr>
    <h4>Download Laporan Bulanan</h4>
    <button>a</button>
  </div>
</template>

<style scoped>
hr{
    margin-left: 10px;
  margin-right: 10px;
}
.row {
  margin-left: 10px;
  margin-right: 10px;
}

h2 {
  margin-left: 10px;
  margin-right: 10px;
}
</style>

<script>
import LineChart from "../components/LineChart.vue";
export default {
  name: "dashboard",
  components: {
    LineChart
  }
};
</script>
