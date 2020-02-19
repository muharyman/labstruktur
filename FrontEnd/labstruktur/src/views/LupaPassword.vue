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
<style scoped>
.root{
    height: 100vh;
    overflow: hidden;
    background: #1B3060 !important;
  }
  
.container{
  width: 40%;
  margin: auto;
  display: block;
}
@media screen and (max-width: 1200px) {    
    .container{
    width: 50%;
    margin: auto;
    display: block;
  }
}
@media screen and (max-width: 1000px) {    
    .container{
    width: 60%;
    margin: auto;
    display: block;
  }
}
@media screen and (max-width: 900px) {    
    .container{
    width: 65%;
    margin: auto;
    display: block;
  }
}
@media screen and (max-width: 800px) {    
    .container{
    width: 70%;
    margin: auto;
    display: block;
  }
}
@media screen and (max-width: 700px) {    
    .container{
    width: 80%;
    margin: auto;
    display: block;
  }
}
@media screen and (max-width: 600px) {    
    .container{
    width: 100%;
    margin: auto;
    display: block;
  }
}
.logo-2{
  margin-bottom: 20px;
  float: left;
}
.lupapassword{
    float: left;
    width: 100%;
    height: 250px;
    border: 2px solid white;
    border-radius: 6px;
    background: white;
    margin: auto;
    margin-left: 0;
}
#title{
  font-family: "Raleway", sans-serif;
  font-size: 45px;
  margin-left: 30px;
  margin-top: 20px;
  color: #5E5E5E;
  font-weight: 500;
  padding: 0;
  margin-bottom: 10px;
}
.txt_input-2{
  width: 90%;
  margin-left: 30px;
  border:2px solid #24D39B;
  border-radius: 4px;
  margin-top: 0px;
  font-family: 'Montserrat Alternates', sans-serif;
  font-size: 17px;
  color:#8D8D8D;
  padding: 12px 20px;
}
.txt_input-2:focus{
  border-radius: 4px;
  border: 2px solid #0066ff;
  outline: 0;
}
.button-2{
  width: 50%;
  float: right;
  margin-right: 30px;
  margin-top: 25px;
}
.button-2 a:hover{
  background: white;
  color: green;
  border-color: green;
}
.button-2 a{
  display: block;
  font-family: 'Montserrat Alternates', sans-serif;
  padding: 10px 10px;
  margin:auto;
  text-align: center;
  text-decoration: none;
  font-size: 20px;
  color: red;
  font-weight: 700;
  background: white;
  transition: 0.8s;
  border:2px solid red;
  border-radius: 4px;
}
</style>