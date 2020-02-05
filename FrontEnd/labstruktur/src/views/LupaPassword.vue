<template>
  <div class="root">
    <div class="container">
      <div class="logo">
      <LabStruktur/>
      </div>
      <div class="lupapassword">
        <p id="title">lupa password?</p>
        <input class="txt_input" placeholder="example@email.com" type="text"/>
        <div class="button">
            <a href="#none">request reset link</a>
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
  @import '../styles/lupapassword.css';
</style>