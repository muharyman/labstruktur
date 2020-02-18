<template>
  <div id="app">
    <div class="animated fadeInUp shadow" v-if="this.$route.meta.header === 1">
      <b-navbar toggleable="lg" type="dark" variant="white">
        <b-navbar-brand href="/">
          <LabStruktur id="logo-labstruktur"/>
        </b-navbar-brand>

        <b-navbar-toggle target="nav-collapse" style="background:#24D39B"></b-navbar-toggle>

        <b-collapse id="nav-collapse" is-nav>
          <!-- Right aligned nav items -->
          <b-navbar-nav class="ml-auto">
            <b-nav-item href="/dashboard">
              <div class="navbar-text">
                <p v-bind:style="{color: dashboard_color }" class="hov">Dashboard</p>
              </div>
            </b-nav-item>
            <b-nav-item-dropdown left>
              <template v-slot:button-content>
                <div class="navbar-text">
                  <p v-bind:style="{color: pengujian_color }" class="hov">Pengujian</p>
                </div>
              </template>
              <b-dropdown-item href="/listpengujian">
                <p v-bind:style="{color: listpengujian_color }" class="hov">List Pengujian</p>
              </b-dropdown-item>
              <b-dropdown-item href="/tambahpengujian">
                <p v-bind:style="{color: tambahpengujian_color }" class="hov">Tambah Pengujian</p>
              </b-dropdown-item>
            </b-nav-item-dropdown>
            <b-nav-item-dropdown left>
              <template v-slot:button-content>
                <div class="navbar-text">
                  <p v-bind:style="{color: inventaris_color }" class="hov">Inventaris</p>
                </div>
              </template>
              <b-dropdown-item href="/listinventaris">
                <p v-bind:style="{color: listinventaris_color }" class="hov">List Inventaris</p>
              </b-dropdown-item>
              <b-dropdown-item href="/tambahinventaris">
                <p v-bind:style="{color: tambahinventaris_color }" class="hov">Tambah Inventaris</p>
              </b-dropdown-item>
            </b-nav-item-dropdown>
            <b-nav-item-dropdown right>
              <!-- Using 'button-content' slot -->
              <template v-slot:button-content>
                <div class="navbar-text">
                  <p v-bind:style="{color: user_color }" class="hov">User</p>
                </div>
              </template>
              <b-dropdown-item href="/profil">
                <p v-bind:style="{color: profil_color }" class="hov">Profile</p>
              </b-dropdown-item>
              <b-dropdown-item href="#">
                <p class="hover">Sign Out</p>
              </b-dropdown-item>
            </b-nav-item-dropdown>
          </b-navbar-nav>
        </b-collapse>
      </b-navbar>
    </div>
    <router-view />
  </div>
</template>

<style scoped>
.app {
  position: fixed;
}
.navbar-text {
  font-size: 24px;
  color: black !important;
  line-height: 0;
  padding: 0;
}

b-nav-item .navbar-text {
  font-size: 15px;
  color: black !important;
  
}

nav a.router-link-active {
  font-weight: 700;
}
.shadow{
  box-shadow: 2px 2px 5px #878788;
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
    transform: translate3d(0, 40px, 0);
  }

  to {
    transform: translate3d(0, 0, 0);
    opacity: 1;
  }
}

@-webkit-keyframes fadeInUp {
  from {
    transform: translate3d(0, 40px, 0);
  }

  to {
    transform: translate3d(0, 0, 0);
    opacity: 1;
  }
}

.animated {
  animation-duration: 1s;
  animation-fill-mode: both;
  -webkit-animation-duration: 1s;
  -webkit-animation-fill-mode: both;
}

.animatedFadeInUp {
  opacity: 0;
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
  },
  data(){
    return{
      dashboard_color: '#000000',
      pengujian_color: '#000000',
      listpengujian_color: '#000000',
      tambahpengujian_color: '#000000',
      inventaris_color: '#000000',
      listinventaris_color: '#000000',
      tambahinventaris_color: '#000000',
      user_color: '#000000',
      profil_color: '#000000'
    } 
  },
  computed:{
    currentPage(){
      return this.$route.path
    }
  },
  created(){
    if( this.$route.path == "/dashboard"){
      this.dashboard_color = '#24D39B';
      this.pengujian_color = '#000000';
      this.listpengujian_color = '#000000';
      this.tambahpengujian_color = '#000000';
      this.inventaris_color = '#000000';
      this.listinventaris_color = '#000000';
      this.tambahinventaris_color = '#000000';
      this.user_color = '#000000';
      this.profil_color = '#000000';
    }else if (this.$route.path == "/listpengujian"){
      this.dashboard_color = '#000000';
      this.pengujian_color = '#24D39B';
      this.listpengujian_color = '#24D39B';
      this.tambahpengujian_color = '#000000';
      this.inventaris_color = '#000000';
      this.listinventaris_color = '#000000';
      this.tambahinventaris_color = '#000000';
      this.user_color = '#000000';
      this.profil_color = '#000000';
    }else if (this.$route.path == "/tambahpengujian"){
      this.dashboard_color = '#000000';
      this.pengujian_color = '#24D39B';
      this.listpengujian_color = '#000000';
      this.tambahpengujian_color = '#24D39B';
      this.inventaris_color = '#000000';
      this.listinventaris_color = '#000000';
      this.tambahinventaris_color = '#000000';
      this.user_color = '#000000';
      this.profil_color = '#000000';
    }else if (this.$route.path == "/listinventaris"){
      this.dashboard_color = '#000000';
      this.pengujian_color = '#000000';
      this.listpengujian_color = '#000000';
      this.tambahpengujian_color = '#000000';
      this.inventaris_color = '#24D39B';
      this.listinventaris_color = '#24D39B';
      this.tambahinventaris_color = '#000000';
      this.user_color = '#000000';
      this.profil_color = '#000000';
    }else if (this.$route.path == "/tambahinventaris"){
      this.dashboard_color = '#000000';
      this.pengujian_color = '#000000';
      this.listpengujian_color = '#000000';
      this.tambahpengujian_color = '#000000';
      this.inventaris_color = '#24D39B';
      this.listinventaris_color = '#000000';
      this.tambahinventaris_color = '#24D39B';
      this.user_color = '#000000';
      this.profil_color = '#000000';
    }else if (this.$route.path == "/profil"){
      this.dashboard_color = '#000000';
      this.pengujian_color = '#000000';
      this.listpengujian_color = '#000000';
      this.tambahpengujian_color = '#000000';
      this.inventaris_color = '#000000';
      this.listinventaris_color = '#000000';
      this.tambahinventaris_color = '#00000';
      this.user_color = '#24D39B';
      this.profil_color = '#24D39B';
    }
  }
};
</script>
