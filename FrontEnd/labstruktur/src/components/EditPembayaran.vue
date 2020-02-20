<template>
  <div class="root">
    <b-table striped hover responsive :items="list_pembayaran" :fields="Koloms" bordered borderless>
      <template v-slot:cell(tanggal_pembayaran)="row">
        <b-form-input v-model="row.item.tanggal_pembayaran" placeholder="2020-01-31" class="input-border"/>
      </template>
      <template v-slot:cell(jumlah_pembayaran)="row">
        <b-form-input v-model="row.item.jumlah_pembayaran" placeholder="855000" class="input-border"/>
      </template>
      <template v-slot:cell(metode_pembayaran)="row">
        <b-form-select v-model="row.item.metode_pembayaran" :options="list_metode_pembayaran" class="input-border"></b-form-select>
      </template>
      <template v-slot:cell(Hapus)="row">
        <b-button @click="hapus(row.item.id_row)" class="button-del">HAPUS</b-button>
      </template>
      <template v-slot:cell(kuitansi)="row">
        <b-button @click="kuitansi(row.item.id_pembayaran)" class="button-kui">Kuitansi</b-button>
      </template>
    </b-table>
    <div class="button-container">
      <div class="button" @click="addRow()">
        <p>Tambah</p>
      </div>
      <div class="button" @click="save()">
        <p>Save</p>
      </div>
    </div>
  </div>
</template>
<style scoped>
.root{
  height: fit-content;
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
.button-container{
  width: inherit;
  height: 5vh;
  text-align: center;
  margin: 10px 0;
}
.table{
  height: fit-content;
}
.button{
  margin: 0 8px;
  height: fit-content;
  min-width: 8vw;
  width: fit-content;
  background: white;
  border: 1px solid blue;
  border-radius: 4px;
  color: blue;
  font-family: "Raleway", sans-serif;
  font-size: 17px;
  display: inline-block;
  padding: 4px 15px;
  cursor: pointer;
}
.button p{
  margin: auto;
}
.button:hover{
  background: blue;
  color: white;
}
.button-del{
  margin: 0 8px;
  height: fit-content;
  min-width: 8vw;
  width: fit-content;
  background: white;
  border: 1px solid red;
  border-radius: 4px;
  color: red;
  font-family: "Raleway", sans-serif;
  font-size: 17px;
  display: inline-block;
  padding: 4px 15px;
  cursor: pointer;
  transition: 0.4s;
}
.button-del:hover{
  background: red;
  border-color: red;
  color: white;
}
.button-kui{
  margin: 0 8px;
  height: fit-content;
  min-width: 8vw;
  width: fit-content;
  background: white;
  border: 1px solid darkgrey;
  border-radius: 4px;
  color: darkgrey;
  font-family: "Raleway", sans-serif;
  font-size: 17px;
  display: inline-block;
  padding: 4px 15px;
  cursor: pointer;
  transition: 0.4s;
}
.button-kui:hover{
  background: darkgrey;
  border-color: darkgray;
  color: white;
}
</style>
<script>
export default {
  data(){
    return{
      index:0,
      Koloms: ["Tanggal_Pembayaran","Jumlah_Pembayaran","Metode_Pembayaran","Hapus", "Kuitansi"],
      list_pembayaran: [],
      list_metode_pembayaran:[
        { value: null, text: 'pilih metode pembayaran'},
        { value: 'CASH', text: 'cash'},
        { value: 'TRANSFER', text: 'transfer'}
      ],
      user_jabatan:''
    }
  },
  methods: {
    hapus(id){
      const token = window.localStorage.getItem('token');
      for( var i = 0; i < this.list_pembayaran.length; i++){ 
        if ( this.list_pembayaran[i].id_row === id) {
          if(this.list_pembayaran[i].isHapus === true){
            this.list_pembayaran.splice(i,1);
          } else {
            this.axios
              .delete("/pembayaran/delete/"+this.list_pembayaran[i].id_pembayaran,{
                  headers: { 
                    "Authorization": `Bearer ${token}`
                  }
                })
              .then(() => {
                alert('delete success');
                this.list_pembayaran.splice(i,1);
              }).catch(e =>{
                this.error = e,
                alert(e.message);
              });
          }
          break;
        }
      }
    },
    addRow(){
      var id = this.index;
      const obj = {
        id_row: id,
        tanggal_pembayaran: null,
        jumlah_pembayaran: null,
        metode_pembayaran: null,
        isHapus:true
      };
      this.list_pembayaran.push(obj);
      this.index++;
    },
    initIndex(){
      this.index = this.list_pembayaran.length;
    },
    getTable(){
      if(this.user_jabatan != 5){
        const token = window.localStorage.getItem('token');
        this.axios
          .get("pembayaran/getbypengujian",{
            params:{
              id : this.$route.params.id
            },headers: { 
              "Authorization": `Bearer ${token}`
            }
          })
          .then(respone => {
            let i = 0;
            this.list_pembayaran = []
            respone.data.data.forEach(element => {
              let row ={
                id_row: i,
                id_pembayaran: null,
                tanggal_pembayaran: null,
                jumlah_pembayaran: null,
                metode_pembayaran: null,
                isHapus:false,
              }
              row.id_pembayaran = element.idpembayaran;
              row.tanggal_pembayaran = element.tanggal_pembayaran;
              row.jumlah_pembayaran = element.jumlah_pembayaran;
              row.metode_pembayaran = element.metode_pembayaran;
              i++;
              this.list_pembayaran.push(row);
              this.index = i+1;
            })
          })
          .catch(e => {
              alert(e.message);
          });
      }
    },
    save(){
      let formData = new FormData();
      const token = window.localStorage.getItem('token');
      let i = 0;
      this.list_pembayaran.forEach(element => {
        if (element.id_pembayaran) formData.append('data['+i+"][idpembayaran]",element.id_pembayaran);
        formData.append('data['+i+"][idpengujian]", this.$route.params.id);
        formData.append('data['+i+"][tanggal_pembayaran]", element.tanggal_pembayaran);
        formData.append('data['+i+"][metode_pembayaran]", element.metode_pembayaran);
        formData.append('data['+i+"][jumlah_pembayaran]", element.jumlah_pembayaran);
        i++;
      })
      this.axios
        .post("pembayaran/update/multiple",
          formData,
          {
          headers: { 
            "Authorization": `Bearer ${token}`,
            'content-type': 'multipart/form-data'
          }
        })
        .then(respone => {
          let i = 0;
          this.list_pembayaran = []
          respone.data.forEach(element => {
            let row ={
              id_row: i,
              id_pembayaran: null,
              tanggal_pembayaran: null,
              jumlah_pembayaran: null,
              metode_pembayaran: null,
              isHapus:false,
            }
            row.id_pembayaran = element.idpembayaran;
            row.tanggal_pembayaran = element.tanggal_pembayaran;
            row.jumlah_pembayaran = element.jumlah_pembayaran;
            row.metode_pembayaran = element.metode_pembayaran;
            i++;
            this.list_pembayaran.push(row);
            this.index = i+1;
          })
          alert("pembayaran Berhasil Diperbaharui");
        })
        .catch(e=>{
          this.error = e;
          alert(e);
          alert("gagal memperbaharui pembayaran");
        });
    },
    kuitansi(id_pembayaran){
      window.location.href = this.axios.defaults.baseURL + '/pembayaran/kuitansi/' + id_pembayaran;
    }
  },
  mounted(){
    this.user_jabatan = window.localStorage.getItem('jabatan');
    this.getTable();
    // this.initIndex();
  }
}
</script>
