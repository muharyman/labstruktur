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

    <b-carousel
      id="carousel-1"
      v-model="slide"
      :interval="4000"
      controls
      indicators
      background="#ababab"
      img-width="1024"
      img-height="480"
      style="text-shadow: 1px 1px 2px #333;"
      @sliding-start="onSlideStart"
      @sliding-end="onSlideEnd"
    >
      <!-- Text slides with image -->
      <b-carousel-slide
        caption="First slide"
        text="Nulla vitae elit libero, a pharetra augue mollis interdum."
        img-src="https://picsum.photos/1024/480/?image=52"
      ></b-carousel-slide>

      <!-- Slides with custom text -->
      <b-carousel-slide img-src="https://picsum.photos/1024/480/?image=54">
        <h1>Hello world!</h1>
      </b-carousel-slide>

      <!-- Slides with image only -->
      <b-carousel-slide
        img-src="https://picsum.photos/1024/480/?image=58"
      ></b-carousel-slide>

      <!-- Slides with img slot -->
      <!-- Note the classes .d-block and .img-fluid to prevent browser default image alignment -->
      <b-carousel-slide>
        <template v-slot:img>
          <img
            class="d-block img-fluid w-100"
            width="1024"
            height="480"
            src="https://picsum.photos/1024/480/?image=55"
            alt="image slot"
          />
        </template>
      </b-carousel-slide>

      <!-- Slide with blank fluid image to maintain slide aspect ratio -->
      <b-carousel-slide caption="Blank Image" img-blank img-alt="Blank image">
        <p>
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse
          eros felis, tincidunt a tincidunt eget, convallis vel est. Ut
          pellentesque ut lacus vel interdum.
        </p>
      </b-carousel-slide>
    </b-carousel>

    <section class="about-sec" id="profil">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
            <h2>
              Profil
            </h2>
          </div>
          <div class="col-md-4">
            <p>
              Laboratorium Rekayasa Struktur merupakan salah satu dari berbagai
              laboratorium yang ada di Institut Teknologi Bandung (ITB).
              Laboratorium ini menjalankan kegiatan berupa pendidikan atau
              pelatihan, penelitian dan pengembangan, serta pengujian di bidang
              Rekayasa Struktur yang meliputi aspek struktur dan material.
            </p>
            <p>
              Laboratorium Rekayasa Struktur tidak hanya ditujukan untuk
              kalangan civitas kampus tetapi juga untuk kalangan luar yang
              berprofesi di bidang Teknik Sipil, maupun masyarakat. Dengan
              dukungan 18 staf pengajar Program Studi Teknik Sipil ITB yang
              berpendidikan S3, 2 asisten peneliti, serta 9 teknisi dan analis,
              Laboratorium Rekayasa Struktur menjadi wadah yang aktif untuk
              melakukan penelitian dan pelayanan jasa di bidang industri
              konstruksi.
            </p>
          </div>
          <div class="col-md-4">
            <p>
              Hingga kini Laboratorium Rekayasa Struktur telah berpartisipasi
              pada berbagai aktivitas dan penemuan-penemuan baru yang sangat
              bermanfaat di dunia teknik sipil, yang diperoleh dari
              penelitian-penelitian yang dilakukan di laboratorium baik oleh
              kalangan kampus maupun kalangan luar.
            </p>
            <p>
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
      <div class="container fluid">
        <div class="row">
          <div class="col-md-4 text left">
            <h3>Kontak Kami</h3>

            <p>
              <strong>Adress:</strong> 514 S. Magnolia St. Orlando, FL 32806
              <!-- Random Adress -->
            </p>
            <p><strong>Email:</strong> email@example.com</p>
            <p><strong>Tel.:</strong> (888) 888 8888</p>
          </div>
          <div class="col-md-2"></div>
          <div class="col-md-6 list">
            <!--Google map-->
            <div
              id="map-container-google-1"
              class="z-depth-1-half map-container"
              style="height: 500px"
            >
              <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.9930960339734!2d107.60621481495085!3d-6.891428195020292!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e659ec554dab%3A0x939f09d36a8d5204!2sCIBE%20ITB!5e0!3m2!1sen!2sid!4v1582037489395!5m2!1sen!2sid"
                width="600"
                height="450"
                frameborder="0"
                style="border:0;"
                allowfullscreen=""
              ></iframe>
            </div>

            <!--Google Maps-->
          </div>
        </div>
      </div>
    </footer>
  </div>
</template>

<style scoped>
@import url("https://fonts.googleapis.com/css?family=Montserrat:400,700");
@import url("https://fonts.googleapis.com/css?family=Lato:300,400,700");
@import url("//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css");

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
  /* background: url("http://grafreez.com/wp-content/temp_demos/burnout/img/para-01.jpg") */
  /* no-repeat center center; */
  background-size: cover;
  color: #fff;
  position: relative;
}
.about-sec:before {
  content: " ";
  position: absolute;
  width: 100%;
  height: 100%;
  background: rgba(22, 122, 192, 0.8);
  top: 0;
  left: 0;
}
.about-sec h2 {
  font-size: 55px;
  font-weight: 800;
  margin-top: 50%;
  align-items: center;
}

.about-sec p {
  font-size: 16px;
}
section {
  margin-top: 10px;
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
