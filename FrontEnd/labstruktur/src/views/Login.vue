<template>
  <div class="row">
    <div class="col-sm-8"></div>
    <div class="col-sm-4">
      <div id="logo-1">
        <LabStruktur/>
      </div>
      <div class="login">
        <p class="text-1">username</p>
        <input class="txt_input-1" id="username" placeholder="username" type="text"/> 
        <p class="text-1">password</p>
        <input class="txt_input-1" placeholder="password" type="password"/>
        <a href="#none" id="lupapassword">lupa password ?</a>
        <div class="button-1">
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