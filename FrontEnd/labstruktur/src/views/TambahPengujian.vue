<template>
  <div class="root">
    <div class="tambah-pengujian">
      <div id="first-row" class="row">
        <div class="col-sm-12">
          <p id="tambah-pengujian">Tambah Pengujian</p>
          <div id="second-row" class="row">
            <div class="col-sm-7">
              <p class="text">Pembuka</p>
              <div class="select-style">
                <select v-model="pembuka_selected" name="pembuka">
                  <option v-for="pembuka in pembukas" v-bind:value="pembuka.value" :key="pembuka">{{ pembuka.text }}</option>
                </select>
              </div>
              <p class="text">Teknisi</p>
              <div class="select-style">
                <select v-model="teknisi_selected" name="teknisi">
                  <option v-for="teknisi in teknisis" v-bind:value="teknisi.value" :key="teknisi">{{ teknisi.text }}</option>
                </select>
              </div>          
              <p class="text">Engineer</p>  
              <div class="select-style">
                <select v-model="engineer_selected" name="engineer">
                  <option v-for="engineer in engineers" v-bind:value="engineer.value" :key="engineer">{{ engineer.text }}</option>
                </select>
              </div>
              <p class="text">Pemberi Tugas</p>
              <input class="input-text" type="text" placeholder="e.g PT.Bumi Perkasa" v-model="pemberi_tugas"/>
              <p class="text" >NPWP</p>
              <input class="input-text" type="number" placeholder="677503456445001" v-model="npwp"/>
            </div>
            <div class="col-sm-5">
              <p class="text">Proyek</p>
              <input class="input-text" type="text" placeholder="e.g. Toko Buku Jaya" v-model="proyek"/>
              <p class="text">Nomor Laporan</p>
              <input class="input-text" type="text" placeholder="108/L.BT/Test/2020" v-model="nomor_laporan"/>
              <p class="text">Tanggal Terima</p>
              <input class="input-text" type="text" placeholder="31-January-2020" v-model="tanggal_terima"/>
              <div class="button">
                <a @click="tambahPengujian()">TAMBAH</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: "tambapengujian",
  data(){
    return{
      teknisi_selected: null,
      pembuka_selected: null,
      engineer_selected: null,
      teknisis: [
      ],
      pembukas:[
      ],
      engineers:[
      ],
      data:{},
      pemberi_tugas:'',
      npwp:'',
      proyek:'',
      nomor_laporan:'',
      tanggal_terima:'',
      error: ''
    }
  },
  methods:{
    getPembuka(){
      let pembuka = {
        text: "hallo",
        value: 0
      }
      const user = JSON.parse(window.localStorage.getItem('user'));
      pembuka.text = user.nama_user;
      pembuka.value = user.iduser;
      this.pembukas = [];
      this.pembukas.push(pembuka);
    },
    getTeknisi(){
      this.axios
        .get("/user/index/role", {
          params:{
            roles: 4,
          }
        })
        .then(respone => {
          if( respone.data.data.length > 0){
            for(let i = 0; i< respone.data.data.length; i++){
              let teknisi={
                text: "",
                value:i
              }
              teknisi.text = respone.data.data[i].nama_user;
              teknisi.value = respone.data.data[i].iduser;
              this.teknisis.push(teknisi);
            }
          }
        });
    },
    getEngineers(){
      this.axios
        .get("/user/index/role",{
          params:{
            roles: 3,
          }
        })
        .then(respone => {
          if( respone.data.data.length > 0){
            for(let i = 0; i< respone.data.data.length; i++){
              let engineer={
                text: "",
                value:i
              }
              engineer.text = respone.data.data[i].nama_user;
              engineer.value = respone.data.data[i].iduser;
              this.engineers.push(engineer);
            }
          }
        });
    },
    tambahPengujian(){
      this.axios
        .post("/pengujian/create",{
          email: JSON.parse(window.localStorage.getItem('user')).email,
          idteknisi: this.teknisi_selected,
          idengineer: this.engineer_selected,
          pemberi_tugas: this.pemberi_tugas,
          npwp: this.npwp,
          proyek: this.proyek,
          nomor_laporan: this.nomor_laporan,
          tanggal_terima: this.tanggal_terima
        })
        .then(respone => {
          alert('Pengujian berhasil ditambahkan');
          let id = respone.data.idpengujian;
          alert(id);
          window.location.href = "/editpengujian/" + id;
        })
        .catch(e =>{
          this.error = e;
          alert('gagal menambah pengujian');
        });
    }
  },
  created(){
    this.getPembuka();
    this.getTeknisi();
    this.getEngineers();
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
.tambah-pengujian{
  margin-top:3%;
  padding: 24px 25px;
}
#first-row{
  background: white;
  border-radius: 4px;
  margin: 0 45px;
  padding: 25px;
  
  box-shadow: 2px 2px 5px #9E9FA1;
}
#second-row{
  background: white;
  width: inherit;
  margin: auto;
}
#tambah-pengujian{
  font-size: 32px;
  margin-left: 10px;
  font-family: "Raleway", sans-serif;
  font-weight: 400;
}
.col-sm-12{
  margin:auto;
  padding: 0;
}
.text{
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
.button{
  width: inherit;
  margin-top: 25px;
  cursor: pointer;
}
.button a:hover{
  background: green;
  color: white;
  border-color: green;
  text-decoration: none;
}
.button a{
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


@media screen and (max-width: 600px){
  .root{
    height: fit-content;
  }
  .button a{
    font-size: 13px; 
  }
  #status{
    font-size: 17px;
  }
}
</style>

