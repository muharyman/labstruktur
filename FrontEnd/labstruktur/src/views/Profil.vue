<template>
  <div class="root">
    <div class="row">
      <div class="col-sm-5">
        <div class="profile">
          <p id="profile-1">Profil</p>
          <p id="namaasli">Nama Asli</p>
          <p id="pangkat">Kepala Lab</p>
          <p id="username">username</p>
        </div>
      </div>
      <div class="col-sm-7">
        <div class="ubah-profile">
          <p id="ubah-profile-1">Ubah Profil</p>
          <div class="row">
            <div class="col">
              <p class="text-4">nama asli</p>
              <input class="input-text" type="text" placeholder="nama asli"/>
              <p class="text-4">username</p>
              <input class="input-text" type="text" placeholder="user name"/>
              <p class="text-4">jabatan</p>              
              <div class="select-style">
                <select name="jabatan">
                <option  value="0">kepala lab</option>
                <option value="1">naon</option>
                <option value="2">naon</option>
                <option value="3">deui</option>
                <option value="4">sedang</option>
              </select>
              </div>
            </div>
            <div class="garis-batas-vertical"></div>
            <div class="col">
              <p class="text-4">password</p>
              <input class="input-text" type="password" placeholder="nama asli"/>
              <p class="text-4">re-password</p>
              <input class="input-text" type="password" placeholder="user name"/>
              <p class="text-4">status</p>
              <button id="status" v-bind:style="{background: status_color }" v-on:click="change_status()" > {{ status }} </button>
              <div class="button-4">
                <a href="#none">UPDATE PROFILE</a>
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
  background: #9E9FA1;
  z-index: -1;
  height: 83vh;
  overflow: hidden;
}

.col-sm-5{
  padding: 65px 45px;
  margin:0 !important;
}
.col-sm-7{
  padding: 65px 45px;
  margin: 0 !important;
}

.profile{
  margin-left: 45px;
  width: 30vw;
  height: 40vh;
  border-radius: 4px;
  background: white;
  padding : 25px 25px;
}
.ubah-profile{
  float:right;
  margin-right: 45px;
  width: 55vw;
  height: 55vh;
  border-radius: 4px;
  background: white;
  padding: 25px 25px;
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
      status_akun : 1,
      status_color : '#24D39B',
      status : "AKTIF"
    }
  },
  computed:{
    status_changed: function(){
      return this.status_color;
    }
  },
  methods: {
    change_status(){
      if (this.status_akun === 1){
        this.status_akun = 0;
        this.status_color = '#C80000';
        this.status = 'TIDAK AKTIF';
      } else{
        this.status_akun = 1;
        this.status_color = '#24D39B';
        this.status = 'AKTIF';
      }
    }
  }
}

</script>