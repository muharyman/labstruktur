<template>
  <div class="root">
    <div class="content">
      <b-table striped hover responsive :items="list_user" :fields="Koloms" bordered borderless>
        <template v-slot:cell(nama_asli)="row">
          <b-form-input v-model="row.item.nama_asli" placeholder="nama asli" class="input-border"/>
        </template>
        <template v-slot:cell(username)="row">
          <b-form-input v-model="row.item.username" placeholder="username" class="input-border"/>
        </template>
        <template v-slot:cell(jabatan)="row">
          <b-form-select v-model="row.item.jabatan" :options="jabatans" class="input-border"></b-form-select>
        </template>
        <template v-slot:cell(status)="row">
          <button id="status" v-bind:style="{background : row.item.background }" v-on:click="change_status(row.item.no)" > {{ row.item.status_text }} </button>
          <div class="button-1" @click="hapus(row.item.no)"> HAPUS </div>
        </template>
      </b-table>
      <!-- {{ list_item_pengujian }} -->
      <!-- {{ length }} -->
      <div class="button-container">
        <div class="button" @click="tambahuser()">
          <p>Tambah User</p>
        </div>
        <div class="button" @click="save()" >
          <p>Save</p>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data(){
    return{
      index:4,
      Koloms: ["Nama_Asli","Username","Jabatan","Status"],
      list_user: [
      ],
      jabatans:[
      ],
      error:''
    }
  },
  methods: {
    hapus(no){
      const token = window.localStorage.getItem('token');
      for( var i = 0; i < this.list_user.length; i++){ 
        if ( this.list_user[i].no === no) {
          if(this.list_user[i].isHapus === true){
            this.list_user.splice(i,1);
          } else {
            this.axios
              .delete("/user/delete/"+this.list_user[i].id_user,{
                  headers: { 
                    "Authorization": `Bearer ${token}`
                  }
                })
              .then(() => {
                alert('delete success');
                this.list_user.splice(i,1);
              }).catch(e =>{
                this.error = e,
                alert('gagal menghapus/ user terkait tidak boleh di hapus');
              });
          }
          break;
        }
      }
    },
    getJabatan(){
      const token = window.localStorage.getItem('token');
      this.axios
        .get("/jabatan/index",{
          headers: { 
            "Authorization": `Bearer ${token}`
          }
        })
        .then(respone => {
          this.jabatans = [];
          if( respone.data.data.length > 0){
            for(let i = 0; i< respone.data.data.length; i++){
              let jabatan={
                text: "",
                value:i
              }
              jabatan.text = respone.data.data[i].jabatan;
              jabatan.value = respone.data.data[i].idjabatan;
              this.jabatans.push(jabatan);
            }
          }
          this.getTable();
        });
    },
    getTable(){
      const token = window.localStorage.getItem('token');
      this.axios
        .get("user/index",{
          headers: { 
            "Authorization": `Bearer ${token}`
          }
        })
        .then(respone => {
          let i = 0;
          this.list_user = [];
          respone.data.data.forEach(element => {
            let row ={
              no: i,
              id_user:'',
              nama_asli:'',
              username:'',
              jabatan:'',
              status: null,
              background: null,
              status_text:"",
              isHapus:false
            }
            row.id_user = element.iduser;
            row.nama_asli = element.nama_user;
            row.username = element.nama_login;
            row.jabatan = element.idjabatan;
            row.status = element.status_user;
            if( row.status){
              row.status_text= "AKTIF";
              row.background = "#24D39B";
            }else{
              row.status_text= "TIDAK AKTIF";
              row.background = "#C80000";
            }
            i++;
            this.list_user.push(row);
            this.index = i+1;
          })
        })
        .catch(e => {
            alert(e.message);
        });
    },
    tambahuser(){
      // alert("TESS")
      window.location.href = `/tambahuser`;
      // window.location.href = `/editpengujian/${event.target.parentNode.parentNode.parentNode.firstChild.firstChild.innerHTML}`;
      // window.location.href= "/listpengujian";
    },
    save(){
      let formData = new FormData();
      const token = window.localStorage.getItem('token');
      let i = 0;
      this.list_user.forEach(element => {
        formData.append('data['+i+"][iduser]",element.id_user);
        formData.append('data['+i+"][nama_user]", element.nama_asli);
        formData.append('data['+i+"][nama_login]", element.username);
        formData.append('data['+i+"][idjabatan]", element.jabatan);
        formData.append('data['+i+"][status_user]", element.status);
        i++;
      })
      this.axios
        .post("user/update/multiple",
          formData,{
          headers: { 
            "Authorization": `Bearer ${token}`,
            'content-type': 'multipart/form-data'
          }
        })
        .then(respone => {
          if (respone.data.length === i){
            this.list_user.forEach(element => {
              element.isHapus = false;
            })
            alert("Daftar User Berhasil Diperbaharui");
          }
        })
        .catch(e=>{
          this.error = e;
          alert(JSON.stringify(e.response));
          alert("gagal memperbaharui list user");
        });
    },
    change_status(no){
      for( var i = 0; i < this.list_user.length; i++){ 
        if ( this.list_user[i].no === no) {
          if (this.list_user[i].status === 1){
            this.list_user[i].status = 0;
            this.list_user[i].background = "#C80000";
            this.list_user[i].status_text = "TIDAK AKTIF";
          } else{
            this.list_user[i].status = 1;
            this.list_user[i].background = "#24D39B";
            this.list_user[i].status_text = "AKTIF";
          }
        }
      }
    }
  },
  mounted(){
    this.getJabatan();
  }
}
</script>
<style scoped>
.root{
  padding: 0;
  margin: 0;
  background: #e9f5ec;
  z-index: -1;
  min-height: 100vh;
  overflow-x: hidden;
}
.content{
  height: fit-content;
  background: white;
  border-radius: 4px;
  margin: 3vh 25px;
  padding: 20px;

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
.button-1{
  margin: 5px 0;
  width: 100%;
  text-align: center;
  background: #C80000;
  border: 1px solid #C80000;
  color: white;
  font-family: "Raleway", sans-serif;
  font-size: 20px;
  font-weight: 700;
  display: inline-block;
  cursor: pointer;
  transition: 0.4s;
  padding: 5px 12px;
}
.button-1:hover{
  background: #ff8080;
  border-color: #ff8080;
}
#status{
  width: 100%;
  background: #24D39B;
  padding: 5px 12px;
  font-family: "Raleway", sans-serif;
  font-size: 20px;
  font-weight: 700;
  text-align: center;
  color: white;
  margin:auto;
  display: inline-block;
  border: none;
  text-decoration: none;
}
.aktif{
  width: 100%;
  background: #24D39B;
  padding: 5px 12px;
  font-family: "Raleway", sans-serif;
  font-size: 20px;
  font-weight: 700;
  text-align: center;
  color: white;
  margin:auto;
  display: inline-block;
  border: none;
  text-decoration: none;
}

.notaktif{
  width: 100%;
  background: red;
  padding: 5px 12px;
  font-family: "Raleway", sans-serif;
  font-size: 20px;
  font-weight: 700;
  text-align: center;
  color: white;
  margin:auto;
  display: inline-block;
  border: none;
  text-decoration: none;
}

</style>