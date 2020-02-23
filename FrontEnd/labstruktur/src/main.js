import "@babel/polyfill";
import "mutationobserver-shim";
import Vue from "vue";
import "./plugins/bootstrap-vue";
import App from "./App.vue";
import router from "./router";
import store from "./store";
import { BootstrapVue, IconsPlugin } from "bootstrap-vue";
import "bootstrap/dist/css/bootstrap.css";
import "bootstrap-vue/dist/bootstrap-vue.css";
import axios from "axios";
import VueAxios from "vue-axios";
import Eagle from "eagle.js";
// import animate.css for slide transition
import "animate.css";
import "eagle.js/dist/themes/gourmet/gourmet.css";
import "jquery";

Vue.config.productionTip = false;

axios.defaults.baseURL = "http://localhost:8000/api";
// VueAxios.defaults.header.common= {
//   "Access-Control-Allow-Origin": "*"
// };
// Vue.config.productionTip = false;
// Install BootstrapVue
Vue.use(BootstrapVue);
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin);
Vue.use(VueAxios, axios);

Vue.use(Eagle);

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount("#app");
