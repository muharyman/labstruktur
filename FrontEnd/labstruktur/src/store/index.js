import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    user: null,
    isLoggedIn: false
  },
  mutations: {
    user(state, user){
      state.user = user
    },
    isLoggedIn(state, status){
      state.isLoggedIn = status
    }
  },
  getters:{
    user: (state) => state.user,
    isLoggedIn: (state) => state.isLoggedIn
  },
  actions: {},
  modules: {}
});