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
import ListPengujian from "../views/ListPengujian.vue";
import ListInventaris from "../views/ListInventaris.vue";
import Dashboard from "../views/Dashboard.vue";
import ManajemenUser from "../views/ManajemenUser.vue";
import EditHome from "../views/EditHome.vue";
Vue.use(VueRouter);

const routes = [
  {
    path: "/",
    name: "home",
    component: Home,
    meta:{
      header: 0
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
    path: "/editpengujian/:id",
    name: "editpengujian",
    component: EditPengujian,
    meta: {
      header: 1
    }
  },
  {
    path: "/detailinventaris/:id",
    name: "detailinventaris",
    component: DetailInventaris,
    meta: {
      header: 1
    }
  },
  {
    path: "/editinventaris/:id",
    name: "ediinventaris",
    component: EditInventaris,
    meta: {
      header: 1
    }
  },
  {
    path: "/listpengujian",
    name: "listpengujian",
    component: ListPengujian,
    meta: {
      header: 1
    }
  },
  {
    path: "/listinventaris",
    name: "listinventaris",
    component: ListInventaris,
    meta: {
      header: 1
    }
  },
  {
    path: "/dashboard",
    name: "dashboard",
    component: Dashboard,
    meta: {
      header: 1
    }
  },
  {
    path: "/manajemenuser",
    name: "manajemenuser",
    component: ManajemenUser,
    meta: {
      header: 1
    }
  },
  {
    path: "/edithome",
    name: "edithome",
    component: EditHome,
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
