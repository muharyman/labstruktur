<script>
export default {
  name: "Data",
  data() {
    return {
      rows: []
    };
  },
  mounted() {
    const token = window.localStorage.getItem('token');
    this.axios
      .get("/pengujian/filter/",{
          headers: { 
            "Authorization": `Bearer ${token}`
          }
        })
      .then(respone => {
        this.rows = respone.data.data;
        // eslint-disable-next-line no-console
        console.log(this.rows);
      })
      .bind(this)
      .catch(e => {
        this.error = e;
        this.showAlert = true;
      });
  }
};
</script>
>
