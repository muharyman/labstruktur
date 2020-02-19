<script>
import { Line } from "vue-chartjs";

export default {
  extends: Line,
  data() {
    return {
      items: [],
      bulan: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
    };
  },
  mounted() {
    this.axios
      .get("/pembayaran/index/")
      .then(respone => {
        this.items = respone.data.data;
        for (var i = 0; i < this.items.length; i++) {
          this.bulan[
            new Date(this.items[i]["tanggal_pembayaran"]).getMonth()
          ] += this.items[i]["jumlah_pembayaran"];
        }
        this.renderChart(
          {
            labels: [
              "January",
              "February",
              "March",
              "April",
              "May",
              "June",
              "July",
              "August",
              "September",
              "October",
              "November",
              "December"
            ],
            datasets: [
              {
                label: "Pendapatan",
                data: this.bulan,
                backgroundColor: "transparent",
                borderColor: "rgba(1, 116, 188, 0.50)",
                pointBackgroundColor: "rgba(171, 71, 188, 1)"
              }
            ]
          },
          {
            responsive: true,
            maintainAspectRatio: false,
            title: {
              display: true,
              text: "Grafik Pendapatan"
            }
          }
        );
        // // eslint-disable-next-line no-console
        // console.log(this.bulan[1]);
      })
      .catch(e => {
        this.error = e;
        this.showAlert = true;
      });
  }
};
</script>
