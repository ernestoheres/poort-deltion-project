<script setup>
import axios from "axios";
</script>

<template>
    <div class="LoginBackground">
        <div class="LoginContainer">

            <img src="../assets/DePoort-Logo.webp" class="LoginDePoortLogo">

            <p class="LoginInfo">Login met de gegevens die u heeft ontvangen door uw huisarts</p>
 
            <div class="LoginInputs">
                <label for="uname"><b>Gebruikersnaam</b></label>
                <input type="text" v-model="username" name="uname" required>
            
                <span style="height:15px"></span>

                <div>
                  <span class="password-labels">
                    <label for="password"><b>Wachtwoord</b></label>
                    <label for="password"><a href="/forgot-password" style="cursor:pointer;">Wachtwoord vergeten?</a></label>
                  </span>
                  <span class="LoginPasswordSpan">
                    <input
                      class="LoginPasswordInput" name="password"
                      :type="showPassword ? 'text' : 'password'"
                      v-model="password"
                      required
                    />
                    <button @click="togglePasswordVisibility" class="LoginPasswordButton">
                      <i class="fa" v-bind:class="[showPassword ? 'fa fa-eye-slash' : 'fa fa-eye']"></i>
                    </button>
                  </span>
                </div>
                
                <button type="submit" @click="onLoginSubmit">Log in</button>

                <label class="LoginRemembermeCheck">
                    <input type="checkbox" checked="checked" name="remember"> Onthoudt mij voor 30 dagen
                </label>
            </div>
        </div>
    </div>
  </template>
  
<script>
export default {
  data() {
    return {
      showPassword: false,
      username: "",
      password: "",

    };
  },
  methods: {
    togglePasswordVisibility() {
      this.showPassword = !this.showPassword;
      event.preventDefault();
    },
  
  async onLoginSubmit() {


  const result = await axios.post("http://localhost:8000/api/login", {
    name: this.username,
    password: this.password,
  },
  {
   
  }
  );
  console.log(result.data);
  if (result.data.status == "success") {
    console.log(result.data)
    console.log("Login succesvol");
    localStorage.setItem("token", result.data.data.token);
    window.location.href = "/dashboard";
  } else {
    console.log("Login mislukt", result.data.status);
  }
},

},

  


}


</script>
  
  <style scoped>

  .LoginBackground {
    background-color: #89BAEB;
    background-image: linear-gradient(225deg, #abcad2, #89BAEB);
    height: 100vh;
    width: 100vw;

    display: flex;
    justify-content: center;
    align-items: center;
  }
  .LoginContainer {
    background-color: #fff;
    box-shadow: #8aa1a5 0px 0px 10px 0px;
    min-height: 60vh;

    max-width: 840px;
    width: 100%;

    font-weight: normal;

    border-radius: 7px;

    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;

    text-align: left;
    align-items: flex-start;
    padding: 0 15px;

    margin: 0 10px;
    box-shadow: 2px 4px 15px 1px gray;

    @media only screen and (min-width: 576px) {
      padding: 0;

      text-align: center;
      align-items: center;
    };

    @media only screen and (min-width: 640px) {
      padding: 2rem;
      margin: 0;
    };

  }

  .LoginDePoortLogo {
    max-width: 150px;
    width: 100%;

    align-self: center;
  }

  .LoginInfo {
    width: 95%;
    margin-top: 5px;

    @media only screen and (min-width: 576px) {
      width: 65%;
    }
  }

  .LoginInputs {
    display: grid;

    width: 95%;
    text-align: left;
    margin-top: 35px;

    @media only screen and (min-width: 576px) {
      width: 65%;
    }

  }

  .LoginInputs input {
    width: 100%;
    place-self: center;
    height: 30px;
    border-radius: 5px;
    border: 2px lightgray solid;
  }

  .LoginInputs button[type=submit] {
    width: 100%;
    place-self: center;
    border-radius: 5px;
    background-color: #88BAEC;
    color: white;
    font-weight: 700;
    border: none;
    height: 35px;
    cursor: pointer;
    margin-top: 25px;
    box-shadow: lightgray 2px 2px 6px 1px;
    transition: all 0.3s;
  }

  .LoginInputs button[type=submit]:hover {
    box-shadow: lightgray 5px 5px 6px 1px;
  }

  .LoginRemembermeCheck {
    display: flex;
    align-content: center;
    align-items: center;
    justify-content: flex-start;
    gap: 5px;
    margin-top: 10px;
    cursor: pointer;
  }

  .LoginRemembermeCheck input {
        width: fit-content;
        min-width: 15px;
        cursor: pointer;
    }

    .password-labels {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
  }

  .LoginPasswordSpan {
    display: flex;
    flex-direction: row;
    position: relative;
    align-items: center;
  }
  .LoginPasswordInput {
    width: 100%;
    place-self: center;
    height: 30px;
    border-radius: 5px;
    border: 2px lightgray solid;
  }

  .LoginPasswordButton {
    background: none;
    border: none;
    cursor: pointer;

    position: absolute;
    right: 3px;
  }
  </style>