import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    user: null,
    isLoggedIn: false,
    token: null
  },
  mutations: {
    user(state, user){
      state.user = user
    },
    isLoggedIn(state, status){
      state.isLoggedIn = status
    },
    token(state, token){
      state.token = token
    }
  },
  getters:{
    user: (state) => state.user,
    isLoggedIn: (state) => state.isLoggedIn,
    token: (state) => state.token
  },
  actions: {},
  modules: {}
});