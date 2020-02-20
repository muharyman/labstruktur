<template>
  <div class="root">
    <div class="fluid" @scroll="handleSCroll">
      <!-- Top navigation -->
      <!-- navbar-->
      <nav class="navbar navbar-light navbar-expand-md fixed-top shadow-md">
        <LabStruktur/>
        <button
          type="button"
          data-toggle="collapse"
          data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
          class="navbar-toggler"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div id="navbarSupportedContent" class="collapse navbar-collapse">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a href="#carouselExampleIndicators" class="nav-link">Home</a>
            </li>
            <li class="nav-item">
              <a href="#profil" class="nav-link">Profil</a>
            </li>
            <li class="nav-item">
              <a href="#fungsi" class="nav-link">Visi Misi</a>
            </li>
            <li class="nav-item">
              <a href="#daftar" class="nav-link">Daftar</a>
            </li>
            <li class="nav-item">
              <a href="#footer" class="nav-link">Kontak Kami</a>
            </li>
          </ul>
        </div>
      </nav>

      <header>
        <div
          id="carouselExampleIndicators"
          class="carousel slide"
          data-ride="carousel"
        >
          <ol class="carousel-indicators">
            <li
              data-target="#carouselExampleIndicators"
              data-slide-to="0"
              class="active"
            ></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
          </ol>
          <div class="carousel-inner" role="listbox">
            <!-- Slide One - Set the background image for this slide in the line below -->
            <div
              class="carousel-item active"
              v-bind:style="{'background-image': 'url(' + foto1_url +')'}"
            >
              <div class="carousel-caption d-none d-md-block">
                <p class="lead">{{ deskf1 }}</p>
              </div>
            </div>
            <!-- Slide Two - Set the background image for this slide in the line below -->
            <div
              class="carousel-item"
              v-bind:style="{'background-image': 'url(' + foto2_url +')'}"
            >
              <div class="carousel-caption d-none d-md-block">
                <p class="lead">{{ deskf2 }}</p>
              </div>
            </div>
            <!-- Slide Three - Set the background image for this slide in the line below -->
            <div
              class="carousel-item"
              v-bind:style="{'background-image': 'url(' + foto3_url +')'}"
            >
              <div class="carousel-caption d-none d-md-block">
                <p class="lead">{{ deskf3 }}</p>
              </div>
            </div>
          </div>
          <a
            class="carousel-control-prev"
            href="#carouselExampleIndicators"
            role="button"
            data-slide="prev"
          >
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a
            class="carousel-control-next"
            href="#carouselExampleIndicators"
            role="button"
            data-slide="next"
          >
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </header>
      <section class="about-sec" id="profil">
          <div class="row profile">
            <div class="col-md-3 title">
              <h2>
                Profil
              </h2>
            </div>
            <div class="col-md-9 content1">
              <p class="text-justify">
              Laboratorium Rekayasa Struktur merupakan salah satu dari berbagai
              laboratorium yang ada di Institut Teknologi Bandung (ITB).
              Laboratorium ini menjalankan kegiatan berupa pendidikan atau
              pelatihan, penelitian dan pengembangan, serta pengujian di bidang
              Rekayasa Struktur yang meliputi aspek struktur dan material.
            </p>
            <p class="text-justify">
              Laboratorium Rekayasa Struktur tidak hanya ditujukan untuk
              kalangan civitas kampus tetapi juga untuk kalangan luar yang
              berprofesi di bidang Teknik Sipil, maupun masyarakat. Dengan
              dukungan 18 staf pengajar Program Studi Teknik Sipil ITB yang
              berpendidikan S3, 2 asisten peneliti, serta 9 teknisi dan analis,
              Laboratorium Rekayasa Struktur menjadi wadah yang aktif untuk
              melakukan penelitian dan pelayanan jasa di bidang industri
              konstruksi.
            </p>
            <p class="text-justify">
              Hingga kini Laboratorium Rekayasa Struktur telah berpartisipasi
              pada berbagai aktivitas dan penemuan-penemuan baru yang sangat
              bermanfaat di dunia teknik sipil, yang diperoleh dari
              penelitian-penelitian yang dilakukan di laboratorium baik oleh
              kalangan kampus maupun kalangan luar.
            </p>
            <p class="text-justify">
              Untuk meningkatkan diri, Laboratorium Rekayasa Struktur menjalin
              kerjasama dengan berbagai pihak yang memiliki kepentingan sama,
              seperti perguruan tinggi lainya, organisasi-organisasi penelitian
              serta pengembangan lainya baik swasta maupun pemerintah, di dalam
              maupun di luar negeri.
            </p>
            </div>
          </div>
      </section>

      <section id="fungsi">
        <div class="content">
          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6 how-bg-img" v-bind:style="{'background-image': 'url(' + foto_profil +')'}"></div>
            <div class="col-xs-12 col-sm-12 col-md-6 how-contents">
              <h4 class="section-title mb-2 h1">Fungsi, Visi dan Misi</h4>
              <br />
              <ul class="list-unstyled">
              <li>
                Menunjang kegiatan pendidikan, terutama praktikum yang dikelola
                oleh Program Studi Teknik Sipil ITB serta program studi lainnya,
                serta melakukan layanan pendidikan dan pelatihan untuk keperluan
                masyarakat luar.
              </li>
              <li>
                Melakukan kegiatan penelitian dan pengembangan, baik yang
                dikelola oleh Kelompok Keahlian Rekayasa Struktur maupun
                langsung untuk masyarakat.
              </li>
              <li>
                Melakukan kegiatan pengujian baik untuk keperluan internal
                maupun untuk melayani kebutuhan masyarakat.
              </li>
            </ul>
              <br />
              <h5 class="mb-4">
                Visi dan Misi
              </h5>
              <ul class="list-unstyled">
              <li>
                Meningkatkan kualitas pendidikan tinggi di dalam bidang
                perencanaan, perancangan, pembangunan dan pengelolaan lingkungan
                binaan dan infrastruktur
              </li>
              <li>
                Meningkatkan kuantitas dan kualitas penelitian dan pencarian
                solusi permasalahan nasional di bidang perencanaan, perancangan,
                pembangunan dengan pengelolaan lingkungan binaan dan
                infrastruktur.
              </li>
              <li>
                Menjalankan peran yang aktif di dalam pemberdayaan masyarakat
                melalui pendidikan berkelanjutan dan pelayanan masyarakat di
                bidang perencanaan, perancangan, pembangunan dan pengelolaan
                lingkungan binaan dan infrastruktur
              </li>
            </ul>
            </div>
          </div>
        </div>
      </section>


      <section>
        <div id="daftar"> 
          <div class="button" @click="openDaftar()">
              DAFTAR  
          </div>
          <b-modal id="daftar-modal" ref="daftar-modal" size="xl" hide-footer title="Daftar">
            <Daftar/>
            <!-- <b-button class="mt-3" variant="primary" block @click="download()">Download</b-button> -->
          </b-modal>
        </div>
      </section>



      <footer id="footer">
        <!--Google map-->
        <div class="footer-1">
            <div class="row">
              <div class="col-md-6">
                <div class="row kontak">
                  <div class="col-sm-3 kontak" >
                    <p class="header">Alamat</p>
                    <a href="#" class="iconAddress"></a>
                    <p class="text">{{ udin }}</p>
                  </div>
                  <div class="col-sm-3 kontak">
                    <div class="header">Media Sosial</div>
                    <a href="#" class="iconEmail"></a>
                    <p class="text">{{ email }}</p>
                    <a href="#" class="iconContact"></a>
                    <p class="text">{{ kontak }}</p>
                  </div>
                </div>
                <div class="col-sm-12 copyright">
                  <!-- <LabStruktur/><br /> -->
                  &copy;Copyright LabStruktur 2020
                </div>
              </div>
              <div class="col-md-6">
                <main >
                  <div class="container-fluid m-0 p-0">
                  <!--Google map-->
                    <div
                      id="map-container-google-4"
                      class="z-depth-1-half map-container-4"
                      style="height: 35vh"
                    >
                      <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.9930960339734!2d107.60621481495085!3d-6.891428195020292!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e659ec554dab%3A0x939f09d36a8d5204!2sCIBE%20ITB!5e0!3m2!1sen!2sid!4v1582132837586!5m2!1sen!2sid"
                        frameborder="0"
                        style="border:0;"
                        allowfullscreen=""
                      ></iframe>
                    </div>
                  </div>
                </main>
            </div>
          </div>
        </div>
      </footer>
    </div>
    {{udin}}
  </div>
</template>
<script>
// import $ from "jquery";
import LabStruktur from "@/components/LabStruktur.vue";
import Daftar from "@/components/Daftar.vue";
export default {
  name: "home",
  components: {
    LabStruktur,
    Daftar
  },
  data() {
    return {
      slide: 0,
      sliding: null,
      foto1_url:'',
      foto2_url:'',
      foto3_url:'',
      deskf1:'',
      deskf2:'',
      deskf3:'',
      foto_profil:'',
      visi_misi:'',
      fungsi:'',
      kontak: '',
      email:'',
      udin:"naon",
      profil:''
    };
  },
  methods: {
    // eslint-disable-next-line no-unused-vars
    handleSCroll(event) {
      let header = document.querySelector(".navbar");
      if (window.scrollY > 300) {
        // eslint-disable-next-line no-console
        console.log(window.scrollY);
        header.classList.add("bg-white");
      }
      if (window.scrollY < 300) {
        // eslint-disable-next-line no-console
        console.log(window.scrollY);
        header.classList.remove("bg-white");
      }
    },
    openDaftar(){
      this.$refs['daftar-modal'].show();
    },
    getHome(){
      this.axios
        .get("landingpage/get")
        .then(function (r){
          this.foto1_url = r.data.photos[0].foto_url;
          this.foto2_url = r.data.photos[1].foto_url;
          this.foto3_url = r.data.photos[2].foto_url;
          this.deskf1 = r.data.photos[0].deskripsi;
          this.deskf2 = r.data.photos[1].deskripsi;
          this.deskf3 = r.data.photos[2].deskripsi;
          this.foto_profil = r.data.foto_profil;
          this.visi_misi = r.data.visi_misi;
          this.fungsi = r.data.fungsi;
          this.kontak = r.data.kontak;
          this.udin = r.data.alamat;
          this.email = r.data.email;
          this.profil = r.data.profil;
          this.profil = this.profil.replace(/\n/g,"<br>");
          this.visi_misi = this.visi_misi.replace(/\n/g,"<br>");
          this.fungsi = this.fungsi.replace(/\n/g,"<br>");
        }.bind(this))
        .catch(e=>{
          alert(e);
        })
    }
  },
  created() {
    window.addEventListener("scroll", this.handleSCroll);
    this.getHome();
  },
  destroyed() {
    window.removeEventListener("scroll", this.handleSCroll);
  }
};
</script>

<style scoped>
@import url("https://fonts.googleapis.com/css?family=Montserrat:400,700");
@import url("https://fonts.googleapis.com/css?family=Lato:300,400,700");
@import url("//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css");
.header{
  font-family: "Raleway", sans-serif;
  font-size: 22px;
}
.header{
  font-family: "Raleway", sans-serif;
  font-size: 14px;
}
.root{
  padding: 0;
  margin: 0;
  background: #e9f5ec;
  z-index: -1;
  min-height: 100vh;
  overflow-x: hidden;
}
.button{
  width: 20vw;
  margin: auto;
  border: 2px solid #1A53FF;
  padding: 6px 8px;
  font-size: 25px;
  font-weight: 700;
  color: #1A53FF;
  text-align: center;
  border-radius: 2px;
  transform: translateY(-50%);
  transition: 0.4s;
  cursor: pointer;
}
.button:hover{
  background: #1A53FF;
  color: white;
}
#daftar{
  /* width: 100vw;
  min-height: 100vh; */
  padding: 25%;
  background-image: url("../assets/lab.png");
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: cover;
}
.title{
  width: 100%;
  font-family: "Montserrat ALternates", sans-serif;
  margin: auto;
  text-align: center;
}
.iconEmail{
   background: url("../assets/mail.png") no-repeat;
   width: 16px;
   height: 16px;
   border: none;
   display:inline-block;
}
.iconContact{
   background: url("../assets/phone.png") no-repeat;
   width: 16px;
   height: 16px;
   border: none;
   display:inline-block;
}
.iconAddress{
   background: url("../assets/address.png") no-repeat;
   width: 16px;
   height: 16px;
   border: none;
   display:inline-block;
}
.profile{
  width: 100%;
  height: 100%;
}
.profile h2{
  color: #007b5e;
}
.kontak{
  width: 100%;
  margin: auto;
  height: 50%;
}
.col-md-6{
  margin: 0;
  padding: 0;
}
.row{
  margin:0;
  padding: 0;
}
.copyright{
  background: #e9f5ec;
  position: absolute;
  bottom: 0;
  left: 0;
  padding: 25px;
}
.content1{
  width: 100%;
  padding: 25px 45px;
  font-family: "Raleway", sans-serif;
  font-weight: 500;
}
.carousel-item {
  height: 100vh;
  min-height: 350px;
  background: no-repeat center center scroll;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}

.fluid {
  background: white no-repeat center center;
  background-size: cover;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}
.list-unstyled{
  font-family: "Raleway", sans-serif;
  font-weight: 500;
}

/* PETA GOOGLE MAPS */
iframe {
  width: 100%;
  height: 100%;
}

/* ----- */

/* NAVBAR */

.logo {
  line-height: 20px;
  position: fixed;
  float: left;
  margin: 16px 46px;
  color: #fff;
  font-weight: bold;
  font-size: 20px;
  letter-spacing: 2px;
}

nav {
  position: fixed;
  width: 100%;
  line-height: 15px;
}

nav ul {
  line-height: 15px;
  list-style: none;
  background: rgba(0, 0, 0, 0);
  overflow: hidden;
  color: #fff;
  padding: 0;
  text-align: right;
  margin: 0;
  padding-right: 15px;
  transition: 1s;
}

nav.black ul {
  background: #000;
}

nav ul li {
  display: inline-block;
  padding: 10px 15px;
}

nav ul li a {
  text-decoration: none;
  color: #fff;
  font-size: 16px;
}

.menu-icon {
  line-height: 15px;
  width: 100%;
  background: #000;
  text-align: right;
  box-sizing: border-box;
  padding: 10px 10px;
  cursor: pointer;
  color: #fff;
  display: none;
}

/* ABOUT SECTION
-------------------------------------------------- */

.about-sec {
  color: black;
  position: relative;
  height: 100vh;
  min-height: 350px;
}
.about-sec .col-md-3 {
  margin: auto;
}

.about-sec h2 {
  font-size: 55px;
  font-weight: 800;
  align-items: center;
}

.about-sec .col-md-9 {
  margin: auto;
}

.about-sec p{
  font-size: 17px;
}

@import url("https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css");
#fungsi {
  color: #ffffff;  
  padding-top: 10vh;
  margin-top: -10vh;
  min-height: 100%;
  margin:0;
}
#fungsi h4 {
  text-align: left !important;
}
#fungsi .how-bg-img {
  background-size: cover;
  background-repeat: no-repeat;
  padding: 300px 0;
  filter: grayscale(100%);
}
#fungsi:hover .how-bg-img {
  -webkit-transition: 0.5s all ease;
  -moz-transition: 0.5s all ease;
  transition: 0.5s all ease;
  filter: grayscale(1%);
}
#fungsi .how-contents {
  padding: 60px 30px;
  background: #007b5e;
}

#fungsi .how-contents ul li {
  padding-left: 50px;
  position: relative;
  margin-bottom: 26px;
}
#fungsi .how-contents ul li:before {
  font-family: FontAwesome;
  content: "\f209";
  position: absolute;
  font-size: 39px;
  color: #ffffff;
  left: 0;
}
#profil{
  padding-top: 10vh;
  margin-top: -10vh;
}
</style>

