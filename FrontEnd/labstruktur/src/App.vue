<template>
  <div id="app">
  <div class="animated fadeInUp"  v-if="this.$route.meta.header === 1">
  <b-navbar toggleable="lg" type="dark" variant="white">
    <b-navbar-brand href="#"><LabStruktur id="logo-labstruktur"/></b-navbar-brand>

    <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

    <b-collapse id="nav-collapse" is-nav>
      <!-- Right aligned nav items -->
      <b-navbar-nav class="ml-auto">

        <b-nav-item href="#">
          <div class="navbar-text">
            Dashboard
          </div>
        </b-nav-item>
        <b-nav-item-dropdown left>
          <template v-slot:button-content>
            <div class="navbar-text">Pengujian</div>
          </template>
          <b-dropdown-item href="/listinventaris">List Pengujian</b-dropdown-item>
          <b-dropdown-item href="#">Tambah Pengujian</b-dropdown-item>
        </b-nav-item-dropdown>
        <b-nav-item-dropdown left>
          <template v-slot:button-content>
            <div class="navbar-text">Inventaris</div>
          </template>
          <b-dropdown-item href="#">List Inventaris</b-dropdown-item>
          <b-dropdown-item href="#">Tambah Inventaris</b-dropdown-item>
        </b-nav-item-dropdown>
        <b-nav-item href="#">
          <div class="navbar-text">
            Laporan
          </div>
        </b-nav-item>

        <b-nav-item-dropdown right>
          <!-- Using 'button-content' slot -->
          <template v-slot:button-content>
            <div class="navbar-text">User</div>
          </template>
          <b-dropdown-item href="/profil">Profile</b-dropdown-item>
          <b-dropdown-item href="#">Sign Out</b-dropdown-item>
        </b-nav-item-dropdown>
      </b-navbar-nav>
    </b-collapse>
  </b-navbar>
</div>
<router-view />
</div>
</template>

<style>
.navbar-text{
  font-size: 25px;
  color: black !important;
}

b-nav-item .navbar-text{
  font-size: 25px;
  color: black !important;
}


nav a.router-link-active {
    font-weight: 700;
}

@keyframes FadeIn {
  0% {
      opacity: 0;
      -webkit-transition-duration: 0.8s;
      transition-duration: 0.8s;
      -webkit-transform: translateY(-10px);
      -ms-transform: translateY(-10px);
      transform: translateY(-10px);
  }


  100% {
      opacity: 1;
      -webkit-transform: translateY(0);
      -ms-transform: translateY(0);
      transform: translateY(0);
      pointer-events: auto;
      transition: cubic-bezier(0.4, 0, 0.2, 1);
  }
}

/* Animation */

@keyframes fadeInUp {
  from {
      transform: translate3d(0, 40px, 0)
  }

  to {
      transform: translate3d(0, 0, 0);
      opacity: 1
  }
}

@-webkit-keyframes fadeInUp {
  from {
      transform: translate3d(0, 40px, 0)
  }

  to {
      transform: translate3d(0, 0, 0);
      opacity: 1
  }
}

.animated {
  animation-duration: 1s;
  animation-fill-mode: both;
  -webkit-animation-duration: 1s;
  -webkit-animation-fill-mode: both
}

.animatedFadeInUp {
  opacity: 0
}

.fadeInUp {
  opacity: 0;
  animation-name: fadeInUp;
  -webkit-animation-name: fadeInUp;
}

</style>

<script>
import LabStruktur from "@/components/LabStruktur.vue";
export default {
  name: "logo",
  components: {
    LabStruktur
  }
};

</script>
