<template>
  <div class="root">
    <b-table striped hover responsive :items="list_item_pengujian" :fields="Koloms" bordered borderless>
      <template v-slot:cell(item)="row">
        <b-form-select v-model="row.item.id_item" :options="list_item" class="input-border"></b-form-select>
        <b-form-input v-model="row.item.keterangan" placeholder="keterangan" class="input-border"/>
      </template>
      <template v-slot:cell(Jumlah)="row">
        <b-form-input v-model="row.item.jumlah_item" class="input-border"/>
      </template>
      <template v-slot:cell(BiayaPengujian)="row">
        <b-form-input v-model="row.item.biaya" class="input-border"/>
      </template>
      <template v-slot:cell(Hapus)="row" class="button-del">
        <b-button @click="hapus(row.item.id_row)">HAPUS</b-button>
      </template>
    </b-table>
    <!-- {{ list_item_pengujian }} -->
    <!-- {{ length }} -->
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
  overflow: hidden;
}
.button-container{
  width: inherit;
  height: 5vh;
  text-align: center;
  margin: 10px 0;
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
.table{
  height: fit-content;
}
.button p{
  margin: auto;
}
.button:hover{
  background: blue;
  color: white;
}.button-del{
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
</style>
<script>
export default {
  data(){
    return{
      index:0,
      Koloms: ["Item","Jumlah","BiayaPengujian","Hapus" ],
      list_item_pengujian: [
        { id_row:0, id_item: "1", keterangan:null, jumlah_item:10, biaya:100000, isHapus:false},
        { id_row:1, id_item: "1", keterangan:"hiyahiyahiya", jumlah_item:1, biaya:100000, isHapus:true}
      ],
      list_item:[
        { value: '1', text: 'This is First option'},
        { value: '2', text: 'This is sakondo option'}
      ]
    }
  },
  methods: {
    hapus(id){
      // console.log("hiyahiyahiya");
      for( var i = 0; i < this.list_item_pengujian.length; i++){ 
        if ( this.list_item_pengujian[i].id_row === id) {
          if(this.list_item_pengujian[i].isHapus === true){
            this.list_item_pengujian.splice(i,1);
            break;
          }
        }
      }
    },
    addRow(){
      var id = this.index;
      const obj = {
        id_row: id,
        id_item: "1",
        keterangan: null,
        jumlah_item:0,
        biaya: 0,
        isHapus:true
      };
      this.list_item_pengujian.push(obj);
      this.index++;
    },
    initIndex(){
      this.index = this.list_item_pengujian.length;
    }
  },
  mounted(){
    this.initIndex();
  }
}
</script>
