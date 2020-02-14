<template>
  <div class="root">
    <b-table striped hover responsive :items="list_pembayaran" :fields="Koloms" bordered borderless>
      <template v-slot:cell(tanggal_pembayaran)="row">
        <b-form-input v-model="row.item.tanggal_pembayaran" placeholder="13-january-2020" class="input-border"/>
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
        <b-button @click="hapus(row.item.id_row)" class="button-kui">Kuitansi</b-button>
      </template>
    </b-table>
    <div class="button-container">
      <div class="button" @click="addRow()">
        <p>Tambah</p>
      </div>
      <div class="button" >
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
      list_pembayaran: [
        { id_row:0, tanggal:null , jumlah_pembayaran:null, metode_pembayaran:1, isHapus:false},
        { id_row:1, tanggal:null , jumlah_pembayaran:null, metode_pembayaran:1, isHapus:true}
      ],
      list_metode_pembayaran:[
        { value: null, text: 'pilih metode pembayaran'},
        { value: '1', text: 'cash'},
        { value: '2', text: 'transfer'},
        { value: '3', text: 'ngutang'}
      ]
    }
  },
  methods: {
    hapus(id){
      for( var i = 0; i < this.list_pembayaran.length; i++){ 
        if ( this.list_pembayaran[i].id_row === id) {
          if(this.list_pembayaran[i].isHapus === true){
            this.list_pembayaran.splice(i,1);
            break;
          }
        }
      }
    },
    addRow(){
      var id = this.index;
      const obj = {
        id_row: id,
        tanggal: null,
        jumlah_pembayaran: null,
        metode_pembayaran: null,
        isHapus:true
      };
      this.list_pembayaran.push(obj);
      this.index++;
    },
    initIndex(){
      this.index = this.list_pembayaran.length;
    }
  },
  mounted(){
    this.initIndex();
  }
}
</script>
