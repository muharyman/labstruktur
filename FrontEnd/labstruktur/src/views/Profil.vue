<template>
  <div class="root">
    <b-alert
      variant="danger"
      dismissible
      fade
      :show="showAlert"
      @dismissed="showAlert = false"
    >
      {{error}}
    </b-alert>
    <b-alert
      variant="success"
      dismissible
      fade
      :show="showSuccess"
      @dismissed="showSuccess = false"
    >
      profil berhasil di update
    </b-alert>
    <div class="row" id="container">
      <div class="col-sm-5">
        <div class="profile">
          <p id="profile-1">Profil</p>
          <p id="namaasli">{{nama_user_fix}}</p>
          <p id="pangkat">{{jabatan_text_fix}}</p>
          <p id="username">{{nama_login_fix}}</p>
        </div>
      </div>
      <div class="col-sm-7">
        <div class="ubah-profile">
          <p id="ubah-profile-1">Ubah Profil</p>
          <div class="row">
            <div class="col">
              <p class="text-4">nama asli</p>
              <input v-model="nama_user" class="input-text" type="text" placeholder="nama asli"/>
              <p class="text-4">username</p>
              <input v-model="nama_login" class="input-text" type="text" placeholder="user name"/>
              <p class="text-4">jabatan</p>              
              <div class="select-style">
                <select v-model="jabatan_selected" name="teknisi">
                  <option v-for="jabatan in jabatans" v-bind:value="jabatan.value" :key="jabatan">{{ jabatan.text }}</option>
                </select>
              </div>
            </div>
            <div class="garis-batas-vertical"></div>
            <div class="col">
              <p class="text-4">password</p>
              <input v-model="password" class="input-text" type="password" placeholder=""/>
              <p class="text-4">re-password</p>
              <input v-model="password_confirmation" class="input-text" type="password" placeholder=""/>
              <p class="text-4">status</p>
              <button id="status" v-bind:style="{background: status_color }" v-on:click="change_status()" > {{ status }} </button>
              <div class="button-4">
                <a @click="save()">UPDATE PROFILE</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<style scoped>
.root{
  padding: 0;
  margin: 0;
  background: #e9f5ec;
  z-index: -1;
  height: 100vh;
  overflow: hidden;
}
#container{
  margin-top:8%;
  padding: 0;
}
.col-sm-5{
  padding: 0 45px;
  margin:0 !important;
}
.col-sm-7{
  padding: 0 45px;
  margin: 0 !important;
}

.profile{
  margin-left: 45px;
  width: 30vw;
  height: 40vh;
  border-radius: 4px;
  background: white;
  padding : 25px 25px;
  box-shadow: 2px 2px 5px #878788;
}
.ubah-profile{
  float:right;
  margin-right: 45px;
  width: 55vw;
  height: 55vh;
  border-radius: 4px;
  background: white;
  padding: 25px 25px;
  box-shadow: 2px 2px 5px #878788;
}
.text-4{
  font-family: "Montserrat Alternates", sans-serif;
  font-weight: 400;
  font-size: 25;
  color: #636363;
  margin-bottom: 0;
}
.input-text{
  width:inherit;
  box-sizing: border-box;
  border:2px solid #24D39B;
  border-radius: 4px;
  margin-top: 0px;
  font-family: 'Montserrat Alternates', sans-serif;
  font-size: 12px;
  color:#000;
  padding: 8px 12px;
}
.input-text:focus{
  border-radius: 4px;
  border: 2px solid #0066ff;
  outline: 0;
}
.garis-batas-vertical{
  height: 37vh;
  width: 1px;
  background: #707070;
}
.select-style {
    border: 2px solid #24D39B;
    width: inherit;
    border-radius: 4px;
    overflow: hidden;
    font-family: "Montserrat Alternates", sans-serif;
    font-size: 12px;
    color: #707070;
    padding: 8px 12px;
}

.select-style select {
    width: 100%;
    border: none;
    box-shadow: none;
    background: transparent;
    background-image: none;
    -webkit-appearance: none;
}

.select-style select:focus {
  outline: 0;
}
.button-4{
  width: inherit;
  margin-top: 15px;
  cursor: pointer;
}
.button-4 a:hover{
  background: green;
  color: white;
  border-color: green;
  text-decoration: none;
}
.button-4 a{
  display: block;
  font-family: 'Raleway', sans-serif;
  padding: 5px 10px;
  margin:auto;
  text-align: center;
  text-decoration: none;
  font-size: 17px;
  color: #24D39B;
  font-weight: 400;
  background: white;
  transition: 0.5s;
  border:1px solid#24D39B;
  border-radius: 4px;
}
#status{
  width: 100%;
  background: #24D39B;
  padding: 5px 12px;
  font-family: "Raleway", sans-serif;
  font-size: 20;
  font-weight: 700;
  text-align: center;
  color: white;
  margin:auto;
  display: inline-block;
  border: none;
  text-decoration: none;
}

#status:focus{
  border: 1px solid #0066ff;

}
#ubah-profile-1{
  font-family: "Raleway", sans-serif;
  font-size: 45px;
  font-weight: 300;
}
#profile-1{
  font-family: "Raleway", sans-serif;
  font-size: 45px;
  font-weight: 300;
}
#namaasli{
  font-family: "Raleway", sans-serif;
  font-weight: 600;
  color: black;
  font-size: 45px;
  line-height: 25px;
}
#pangkat{
  font-family: "Raleway", sans-serif;
  font-weight: 600;
  color: black;
  font-size: 25px;
}
#username{
  font-family: "Raleway", sans-serif;
  font-weight: 400;
  color: black;
  font-size: 25px;
}

@media screen and (max-width: 600px){
  .root{
    height: fit-content;
  }
  .profile{
    margin: auto;
    width: 80vw;
    height: 100%;
  }
  .ubah-profile{
    float: none;
    margin: auto;
    width: 80vw;
    height: 100%;
  }
  .button-4 a{
    font-size: 13px; 
  }
  #status{
    font-size: 17px;
  }
}
</style>
<script>
export default {
  name:'profile',
  data(){
    return{
      id_user : 0,
      nama_user_fix : "",
      nama_login_fix : "",
      jabatan_text_fix : "",
      nama_user : "",
      nama_login : "",
      password : "",
      password_confirmation : "",
      status_user : 1,
      status_color : '#24D39B',
      status : "AKTIF",
      jabatan_selected: null,
      jabatan_text : "",
      showAlert : false,
      showSuccess: false,
      error : '',
      jabatans: [
      ],
    }
  },
  computed:{
    status_changed: function(){
      return this.status_color;
    },
  },
  methods: {
    change_status(){
      if (this.status_user === 1){
        this.status_user = 0;
        this.status_color = '#C80000';
        this.status = 'TIDAK AKTIF';
      } else{
        this.status_user = 1;
        this.status_color = '#24D39B';
        this.status = 'AKTIF';
      }
    },
    set_status(new_status){
      if (new_status === 1){
        this.status_user = 1;
        this.status_color = '#24D39B';
        this.status = 'AKTIF';
      } else{
        this.status_user = 0;
        this.status_color = '#C80000';
        this.status = 'TIDAK AKTIF';
      }
    },
    getJabatan(){
      this.axios
        .get("/jabatan/index")
        .then(respone => {
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
          this.getProfil();
        });
    },
    getProfil(){
      const user = JSON.parse(window.localStorage.getItem('user'));
      this.id_user = user.iduser;
      this.nama_user = user.nama_user;
      this.nama_login = user.nama_login;
      this.jabatan_selected = user.idjabatan;
      this.setJabatanText();
      this.nama_user_fix = this.nama_user,
      this.nama_login_fix = this.nama_login,
      this.jabatan_text_fix = this.jabatan_text,
      this.set_status(user.status_user);
    },
    setJabatanText(){
      for(let i=0; i < this.jabatans.length; i++){
        if(this.jabatans[i].value === 1){
          this.jabatan_text = this.jabatans[i].text;
          break;
        }
      }
    },
    save(){
      var body = {
          'nama_user' : this.nama_user,
          'nama_login' : this.nama_login,
          'idjabatan' : this.jabatan_selected,
          'status_user': this.status_user,
        };
      if (this.password){
        body['password'] = this.password;
        body['password_confirmation'] = this.password_confirmation;
      }
      this.axios
        .put("/user/update/" + this.id_user,body)
        .then(respone => {
          this.showSuccess = true;
          window.localStorage.setItem('user', JSON.stringify(respone.data));
          this.getProfil();
          this.password = "";
          this.password_confirmation = "";
        })
        .catch(e => {
          this.error = e.response.data;
          this.showAlert = true;
        });
      }
  },
  mounted(){
    this.getJabatan();
  }
}

</script>