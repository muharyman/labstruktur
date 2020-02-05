<template>
  <div class="root">
    <div class="container-1">
      <div class="logo-2">
        <LabStruktur2/>
      </div>
      <div class="resetpassword">
        <p id="title-1">reset password</p>
        <input class="txt_input-3" placeholder="new password" type="text"/>
        <input class="txt_input-3" placeholder="confirm your password" type="text"/>
        <div class="button-3">
            <a href="#none">kirim</a>
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
}
</script>

<style>
  @import '../styles/resetpassword.css';
</style>