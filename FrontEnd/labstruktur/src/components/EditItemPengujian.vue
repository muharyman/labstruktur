<template>
  <div class="root">
    <b-table striped hover :items="list_item_pengujian" :fields="Koloms">
      <template v-slot:cell(item_pengujian)="row">
        <b-form-select v-model="row.item.id_item" :options="list_item"></b-form-select>
        <b-form-input v-model="row.item.keterangan"/>
      </template>
      <template v-slot:cell(jumlah)="row">
        <b-form-input v-model="row.item.jumlah_item"/>
      </template>
      <template v-slot:cell(biaya)="row">
        <b-form-input v-model="row.item.biaya"/>
      </template>
      <template v-slot:cell(hapus)="row">
        <b-button @click="hapus(row.id_item)">HAPUS</b-button>
      </template>
    </b-table>
    {{ list_item_pengujian }}
  </div>
</template>
<style scoped>

</style>
<script>
export default {
  name='edititempengujian',
  data(){
    return{
      Koloms: { item_pengujian: "Item Pengujian", jumlah: "Jumlah Item", biaya: "Biaya Per Pengujian", hapus: "Hapus" },
      list_item_pengujian: [
        { id_item: "1", keterangan:"", jumlah_item:10, biaya:100000},
        { id_item: "2", keterangan:"hiyahiyahiya", jumlah_item:1, biaya:100000}
      ],
      list_item:[
        { value: '1', text: 'This is First option'},
        { value: '2', text: 'This is sakondo option'}
      ]
    }
  },
  methods: {
    hapus(id){
      this.list_item_pengujian = this.list_item_pengujian.filter(function( obj ){
        return obj.id_item !== id;
      }) 
    }
  }
}
</script>
