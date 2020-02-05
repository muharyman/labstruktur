<template>
  <div class="root">
    <div class="container">
      <div class="logo-2">
        <LabStruktur2/>
      </div>
      <div class="lupapassword">
        <p id="title">lupa password?</p>
        <input class="txt_input-2" placeholder="example@email.com" type="text"/>
        <div class="button-2">
            <a href="#none">request reset link</a>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import LabStruktur2 from "@/components/LabStruktur2.vue";
export default {
  name: "logo",
  components: {
    LabStruktur2
  }
};
</script>
<style>
  @import '../styles/lupapassword.css';
</style>