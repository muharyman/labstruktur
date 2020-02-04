<template>
  <div class="row">
    <div class="col-sm-8"></div>
    <div class="col-sm-4">
      <div class="logo">
        <LabStruktur/>
      </div>
      <div class="login">
        <p class="text">username</p>
        <input class="txt_input" id="username" placeholder="username" type="text"/> 
        <p class="text">password</p>
        <input class="txt_input" placeholder="password" type="password"/>
        <a href="#none" id="lupapassword">lupa password ?</a>
        <div class="button">
          <a href="#none">Login</a>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import LabStruktur from "@/components/LabStruktur.vue";
export default {
  name: "logo",
  components: {
    LabStruktur
  }
};
</script>

<style>
@import '../styles/login.css';

</style>