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

<style scoped>
  .root{
    height: 100vh;
    overflow: hidden;
    background: #1B3060 !important;
  }
  
.container-1{
  width: 30%;
  margin: auto;
  display: block;
  padding: 0 15px;
}
@media screen and (max-width: 1200px) {    
    .container-1{
    width: 40%;
    margin: auto;
    display: block;
  }
}
@media screen and (max-width: 1000px) {    
    .container-1{
    width: 60%;
    margin: auto;
    display: block;
  }
}
@media screen and (max-width: 900px) {    
    .container-1{
    width: 65%;
    margin: auto;
    display: block;
  }
}
@media screen and (max-width: 800px) {    
    .container-1{
    width: 70%;
    margin: auto;
    display: block;
  }
}
@media screen and (max-width: 700px) {    
    .container-1{
    width: 80%;
    margin: auto;
    display: block;
  }
}
@media screen and (max-width: 600px) {    
    .container-1{
    width: 100%;
    margin: auto;
    display: block;
  }
}
.logo-2{
  margin-bottom: 20px;
  float: left;
}
.resetpassword{
    float: left;
    width: 100%;
    height: 250px;
    border: 2px solid white;
    border-radius: 6px;
    background: white;
    margin:auto;
    padding: 15px;
}
#title-1{
  font-family: 'Montserrat Alternates', sans-serif;
  font-size: 25px;
  text-align: center;
  color: #1700FF;
  font-weight: 500;
  padding: 0;
  margin-bottom: 10px;
}
.txt_input-3{
  width:inherit;
  box-sizing: border-box;
  border:2px solid #24D39B;
  border-radius: 4px;
  margin-top: 0px;
  font-family: 'Montserrat Alternates', sans-serif;
  font-size: 17px;
  color:#8D8D8D;
  padding: 12px 20px;
  margin-bottom: 8px;
}
.txt_input-3:focus{
  border-radius: 4px;
  border: 2px solid #0066ff;
  outline: 0;
}
.button-3{
  width: inherit;
}
.button-3 a:hover{
  background: green;
  color: white;
  border-color: green;
}
.button-3 a{
  display: block;
  font-family: 'Raleway', sans-serif;
  padding: 5px 10px;
  margin:auto;
  text-align: center;
  text-decoration: none;
  font-size: 25px;
  color: #24D39B;
  font-weight: 400;
  background: white;
  transition: 2s;
  border:1px solid#24D39B;
  border-radius: 4px;
}
</style>