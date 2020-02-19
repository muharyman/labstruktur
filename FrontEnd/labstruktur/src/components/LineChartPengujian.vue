<script>
import { Line } from "vue-chartjs";

export default {
  data() {
    return {
      items: [],
      bulan: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
    };
  },
  extends: Line,
  mounted() {
    this.axios
      .get("/pengujian/index/")
      .then(respone => {
        this.items = respone.data.data;
        for (var i = 0; i < this.items.length; i++) {
          if (this.items[i]["status_persetujuan"] == true) {
            this.bulan[new Date(this.items[i]["created_at"]).getMonth()]++;
          }
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
                label: "Pengujian",
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
              text: "Grafik Pengujian"
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
