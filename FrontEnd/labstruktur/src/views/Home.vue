<template>
  <div class="fluid" @scroll="handleSCroll">
    <!-- Top navigation -->
    <!-- navbar-->
    <nav class="navbar navbar-light navbar-expand-md fixed-top shadow-md">
      <a class="navbar-brand">Free BS Template</a>
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
            <a href="#" class="nav-link">Daftar</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">Kontak Kami</a>
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
            style="background-image: url('https://source.unsplash.com/LAaSoL0LrYs/1920x1080')"
          >
            <div class="carousel-caption d-none d-md-block">
              <h2 class="display-4">First Slide</h2>
              <p class="lead">This is a description for the first slide.</p>
            </div>
          </div>
          <!-- Slide Two - Set the background image for this slide in the line below -->
          <div
            class="carousel-item"
            style="background-image: url('https://source.unsplash.com/bF2vsubyHcQ/1920x1080')"
          >
            <div class="carousel-caption d-none d-md-block">
              <h2 class="display-4">Second Slide</h2>
              <p class="lead">This is a description for the second slide.</p>
            </div>
          </div>
          <!-- Slide Three - Set the background image for this slide in the line below -->
          <div
            class="carousel-item"
            style="background-image: url('https://source.unsplash.com/szFUQoyvrxM/1920x1080')"
          >
            <div class="carousel-caption d-none d-md-block">
              <h2 class="display-4">Third Slide</h2>
              <p class="lead">This is a description for the third slide.</p>
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
      <div class="container">
        <div class="row">
          <div class="col-md-3">
            <h2>
              Profil
            </h2>
          </div>
          <div class="col-md-9">
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
      </div>
    </section>

    <section id="fungsi" class="p-0">
      <div class="container-fluid">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-6 how-bg-img"></div>
          <div class="col-xs-12 col-sm-12 col-md-6 how-contents">
            <h4 class="section-title mb-2 h1">Fungsi, Visi dan Misi</h4>
            <br />
            <h5 class="mb-4">
              Fungsi
            </h5>
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
      DAFTAR
    </section>

    <footer>
      <!--Google map-->
      <main class=" m-0 p-0">
        <div class="container-fluid m-0 p-0">
          <!--Google map-->
          <div
            id="map-container-google-4"
            class="z-depth-1-half map-container-4"
            style="height: 500px"
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
      <div class="row">
        <div class="col-md-4">
          logo<br />
          copyright
        </div>
        <div class="col-md-4">
          Alamat<br />
          nama Alamat
        </div>
        <div class="col-md-4">
          Media Sosial<br />
          Icon Email <br />
          Icon Kontak
        </div>
      </div>
    </footer>
  </div>
</template>

<style scoped>
@import url("https://fonts.googleapis.com/css?family=Montserrat:400,700");
@import url("https://fonts.googleapis.com/css?family=Lato:300,400,700");
@import url("//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css");

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

footer {
  background: #373a3b;
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
  height: 50vh;
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
}
#fungsi h4 {
  text-align: left !important;
}
#fungsi .how-bg-img {
  background-image: url("https://www.arketipomagazine.it/wp-content/uploads/sites/20/2017/11/Nakaaoki_03.jpg");
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
</style>

<script>
// import $ from "jquery";
export default {
  name: "home",
  data() {
    return {
      slide: 0,
      sliding: null
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
    }
  },
  created() {
    window.addEventListener("scroll", this.handleSCroll);
  },
  destroyed() {
    window.removeEventListener("scroll", this.handleSCroll);
  }
};
</script>
