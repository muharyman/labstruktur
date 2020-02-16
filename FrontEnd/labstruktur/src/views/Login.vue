<template>
  <div class="row">
    <div class="col-sm-8"></div>
    <div class="col-sm-4">
      <div id="logo-1">
        <LabStruktur />
      </div>
      <div class="login">
        <p class="text-1">username</p>
        <input
          class="txt_input-1"
          id="username"
          placeholder="username"
          v-model="username"
          type="text"
        />
        <p class="text-1">password</p>
        <input
          class="txt_input-1"
          v-model="password"
          placeholder="password"
          type="password"
        />
        <b-alert
          variant="danger"
          dismissible
          fade
          :show="showAlert"
          @dismissed="showAlert = false"
        >
          Username atau password Anda salah.
        </b-alert>
        <a href="#none" id="lupapassword">lupa password ?</a>
        <div class="button-1">
          <a @click="logIn()">Login</a>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.row {
  min-height: 100vh;
  overflow: hidden;
}
#logo-1 {
  padding-top: 25px;
  margin: auto;
  display: block;
}
.col-sm-4 {
  margin: auto;
}

.col-sm-8 {
  visibility: visible;
  background-color: #1b3060 !important;
}
@media screen and (max-width: 1200px) {
  .col-sm-8 {
    display: none;
  }
}

.login {
  padding-top: 85px;
  margin: auto;
  text-align: center;
  width: fit-content;
}
.txt_input-1 {
  font-family: "Montserrat Alternates", sans-serif;
  font-size: 17px;
  width: 100%;
  margin-top: 0;
  padding: 12px 20px;
  background: #f2f2f2;
  box-sizing: border-box;
  border: 2px solid #24d39b;
  border-radius: 6px;
  transition: 0.6s;
}
.text-1 {
  margin: 0;
  font-family: "Montserrat Alternates", sans-serif;
  font-size: 17px;
  font-weight: 300;
  text-align: left;
  color: #5e5e5e;
}
.txt_input-1:focus {
  border-radius: 6px;
  border: 2px solid #0066ff;
  outline: 0;
}

#username {
  margin-bottom: 30px;
}

#lupapassword {
  display: block;
  margin-bottom: 40px;
  font-family: "Montserrat Alternates", sans-serif;
  color: #3366ff;
  text-decoration: none;
  transition: 0.6s;
  font-size: 12px;
}
#lupapassword:hover {
  color: #99b3ff;
}

.button-1 {
  width: 300px;
  height: 50px;
}
.button-1 a:hover {
  background: rgb(98, 228, 187);
  color: white;
}
.button-1 a {
  display: block;
  font-family: "Montserrat Alternates", sans-serif;
  padding: 10px 10px;
  margin: auto;
  text-align: center;
  text-decoration: none;
  font-size: 20px;
  color: white;
  font-weight: 700;
  background: #24d39b;
  transition: 0.8s;
  cursor: pointer;
}
</style>
<script>
import LabStruktur from "@/components/LabStruktur.vue";
// import axios from "axios";
export default {
  name: "login",
  components: {
    LabStruktur
  },
  data() {
    return {
      username: "",
      password: "",
      showAlert: false,
      error: {}
    };
  },
  methods: {
    logIn() {
      this.axios
        .post("/auth/login/", {
          nama_login: this.username,
          password: this.password
        })
        .then(respone => {
          const token = respone.data.success.token;
          window.localStorage.setItem("loggedIn", token);
          window.location.href = "/dashboard";
        })
        .catch(e => {
          this.error = e;
          this.showAlert = true;
        })
        .finally(() => {
          (this.username = ""), (this.password = "");
        });
    }
  }
};
</script>
