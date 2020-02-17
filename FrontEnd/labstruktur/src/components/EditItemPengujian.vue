<template>
  <div class="root">
    <b-table striped hover responsive :items="list_item_pengujian" :fields="Koloms" bordered borderless>
      <template v-slot:cell(item_pengujian)="row">
        <b-form-select v-model="row.item.id_item" :options="list_item" class="input-border"></b-form-select>
        <b-form-input v-model="row.item.keterangan" placeholder="keterangan" class="input-border"/>
      </template>
      <template v-slot:cell(Jumlah)="row">
        <b-form-input v-model="row.item.jumlah_item" class="input-border"/>
      </template>
      <template v-slot:cell(biaya_per_pengujian)="row">
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
      <div class="button" @click="save()" >
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
      Koloms: ["Item_Pengujian","Jumlah","Biaya_Per_Pengujian","Hapus" ],
      list_item_pengujian: [
      ],
      list_item:[
        { value: '1', text: 'This is First option'},
        { value: '2', text: 'This is sakondo option'}
      ],
      error:''
    }
  },
  methods: {
    hapus(id){
      for( var i = 0; i < this.list_item_pengujian.length; i++){ 
        if ( this.list_item_pengujian[i].id_row === id) {
          if(this.list_item_pengujian[i].isHapus === true){
            this.list_item_pengujian.splice(i,1);
          } else {
            this.axios
              .delete("/itempengujian/delete/"+this.list_item_pengujian[i].id_pengujian)
              .then(() => {
                alert('delete success');
                this.list_item_pengujian.splice(i,1);
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
        id_pengujian: null,
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
    },
    getItem(){
      this.axios
        .get("/kategoripengujian/index")
        .then(respone => {
          this.list_item = []
          respone.data.data.forEach(element_1 => {
            let item = {
              value: 0,
              text: ''
            };
            element_1.jenis_pengujian.forEach(element_2 => {
              item.value = element_2.idjenis_pengujian;
              item.text = element_2.nama_pengujian
              if (element_1.nama_lain) item.text += "("+ element_1.nama_lain ?? ""+")";
              this.list_item.push(item);
            });
          });
        })
        .catch(e =>{
          this.error = e,
          alert(e.message);
        });
    },
    getTable(){
      this.axios
        .get("itempengujian/getbypengujian",{
          params:{
            id : this.$route.params.id
          }
        })
        .then(respone => {
          let i = 0;
          this.list_item_pengujian = []
          respone.data.data.forEach(element => {
            let row ={
              id_row:i,
              id_item: '',
              id_pengujian: '',
              keterangan:null, 
              jumlah_item:0, 
              biaya:0, 
              isHapus:false
            }
            row.id_item = element.idjenis_pengujian;
            row.id_pengujian = element.iditem_pengujian;
            row.keterangan = element.keterangan;
            row.jumlah_item = element.jumlah_item;
            row.biaya = element.biaya_per_pengujian;
            i++;
            this.list_item_pengujian.push(row);
            this.index = i+1;
          })
        })
        .catch(e => {
            alert(e.message);
        });
    },
    save(){
      let formData = new FormData();
      let i = 0;
      this.list_item_pengujian.forEach(element => {
        if (element.id_pengujian) formData.append('data['+i+"][iditem_pengujian]",element.id_pengujian);
        formData.append('data['+i+"][idpengujian]", this.$route.params.id);
        formData.append('data['+i+"][idjenis_pengujian]", element.id_item);
        formData.append('data['+i+"][jumlah_item]", element.jumlah_item);
        formData.append('data['+i+"][biaya_per_pengujian]", element.biaya);
        formData.append('data['+i+"][keterangan]", element.keterangan);
        i++;
      })
      this.axios
        .post("itempengujian/update/multiple",
          formData,
          {
            Headers:{
              'content-type': 'multipart/form-data'
            }
        })
        .then(respone => {
          if (respone.data.length === i){
            this.list_pembayaran.forEach(element => {
              element.isHapus = false;
            })
            alert("Item Pengujian Berhasil Diperbaharui");
          }
        })
        .catch(e=>{
          this.error = e;
          alert(e);
          alert("gagal memperbaharui item pengujian");
        });
    }
  },
  mounted(){
    this.getTable();
    this.getItem();    
    // this.initIndex();
  }
}
</script>
