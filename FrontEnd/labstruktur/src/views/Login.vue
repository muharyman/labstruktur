<template>
  <div class="row">
    <div class="col-sm-9"></div>
      <div class="col-sm-3">
          <div class="logo">
            <LabStruktur/>
          </div>
          <div class="login">
            <p>username</p>
            <input placeholder="username" type="text"/> 
            <p>password</p>
            <input placeholder="password" type="password"/>
            <p>lupa password ?</p>
            <div class="button">
              <a href="#haha">Login</a>
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
.logo{
  margin: auto;
  padding-top: 25px;
}
.col-sm-9{
  background-color : #1C45A4;
}
.login{
  padding-top: 25px;
}
.button{
  width: 200px;
  border-style: solid;
  border-color: #24D39B;
  background-color: #24D39B;
  border-radius: 10px 0 10px 0;
  margin:0;
  padding:0;
}
.button p{
  text-align: center;
  overflow: hidden;
  padding: 10px;
}
</style>