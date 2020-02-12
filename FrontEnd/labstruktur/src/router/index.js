import Vue from "vue";
import VueRouter from "vue-router";
import Home from "../views/Home.vue";
import Login from "../views/Login.vue";
import LupaPassword from "../views/LupaPassword.vue";
import ResetPassword from "../views/ResetPassword.vue";
import Profil from "../views/Profil.vue";
import TambahInventaris from "../views/TambahInventaris.vue";
import TambahPengujian from "../views/TambahPengujian.vue";
import Daftar from "../views/Daftar.vue";
import EditPengujian from "../views/EditPengujian.vue";
import DetailInventaris from "../views/DetailInventaris.vue";
import EditInventaris from "../views/EditInventaris.vue";
Vue.use(VueRouter);

const routes = [
  {
    path: "/",
    name: "home",
    component: Home,
    meta:{
      header: 1
    }
  },
  {
    path: "/about",
    name: "about",
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ "../views/About.vue"),
    meta:{
      header: 1
    }
  },
  {
    path: "/loginadmin",
    name: "loginadmin",
    component: Login,
    meta: {
      header: 0
    }
  },
  {
    path: "/lupapassword",
    name: "lupapassword",
    component: LupaPassword,
    meta: {
      header: 0
    }
  },
  {
    path: "/resetpassword",
    name: "resetpassword",
    component: ResetPassword,
    meta: {
      header: 0
    }
  },
  {
    path: "/profil",
    name: "profil",
    component: Profil,
    meta: {
      header: 1
    }
  },
  {
    path: "/tambahinventaris",
    name: "tambahinventaris",
    component: TambahInventaris,
    meta: {
      header: 1
    }
  },
  {
    path: "/tambahpengujian",
    name: "tambahpengujian",
    component: TambahPengujian,
    meta: {
      header: 1
    }
  },
  {
    path: "/pendaftaran",
    name: "pendaftaran",
    component: Daftar,
    meta: {
      header: 0
    }
  },
  {
    path: "/editpengujian",
    name: "editpengujian",
    component: EditPengujian,
    meta: {
      header: 1
    }
  },
  {
    path: "/detailinventaris",
    name: "detailinventaris",
    component: DetailInventaris,
    meta: {
      header: 1
    }
  },
  {
    path: "/editinventaris",
    name: "ediinventaris",
    component: EditInventaris,
    meta: {
      header: 1
    }
  }
];

const router = new VueRouter({
  mode: "history",
  base: process.env.BASE_URL,
  routes
});

export default router;

