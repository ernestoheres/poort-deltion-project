<script setup>
  import axios from "axios";
</script>

<template>
  <div class="LoginBackground">
    <div class="LoginContainer">

      <img src="../assets/DePoort-Logo.webp" class="LoginDePoortLogo">

      <p class="LoginInfo">Login met de gegevens die u heeft ontvangen door uw huisarts</p>

      <div class="LoginInputs">
        <form @submit.prevent="onLoginSubmit">
          <label for="uname"><b>Gebruikersnaam</b></label>
          <input type="text" v-model="username" name="uname" required>
          <label for="uname"><b>Email</b></label>
          <input type="text" v-model="email" name="email" required>
          <span style="height:15px"></span>

          <div>
            <span class="password-labels">
              <label for="password"><b>Wachtwoord</b></label>
              <label for="password"><a href="/forgot-password" style="cursor:pointer;">Wachtwoord vergeten?</a></label>
            </span>
            <span class="LoginPasswordSpan">
              <input class="LoginPasswordInput" name="password" :type="showPassword ? 'text' : 'password'"
                v-model="password" required />
             

              <button @click="togglePasswordVisibility" class="LoginPasswordButton">
                <i class="fa" v-bind:class="[showPassword ? 'fa fa-eye-slash' : 'fa fa-eye']"></i>
              </button>
            </span>
            <label for="onetimepassword"><b>Eenmalige code</b></label>
         
         <input class="onetimecode" name="onetimepassword" :type="showPassword ? 'text' : 'password'"
         v-model="onetimepassword" required />
          </div>

          <button type="submit" id="login" ref="login" >Log in</button>

          <div id="error" ref="errorMessage"></div>

          <label class="LoginRemembermeCheck">
            <input type="checkbox" checked="checked" name="remember" required>Ik ga akkoord met de <a href="/privacy-en-cookieverklaring">privacy en cookieverklaring</a>.
          </label>
        </form>
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
        email: "",
        password: "",
        onetimepassword: "",	

      };
    },
    methods: {
      togglePasswordVisibility(event) {
        this.showPassword = !this.showPassword;
        event.preventDefault();
      },

      async onLoginSubmit() {
        const loginButton = this.$refs.login;

        if (loginButton) {
          loginButton.innerHTML = 'Log in <i class="fa-duotone fa-spinner fa-spin"></i>';
        }


        const errorMessageElement = this.$refs.errorMessage;

        if (errorMessageElement) {
          errorMessageElement.style.display = "none";
        }

        const result = await axios.post("http://localhost:8000/api/register", {
          name: this.username,
          email: this.email,
          password: this.password,
          one_time_password: this.onetimepassword,
        }, {

        }).
        catch((error) => {
            console.log(error);
        });

        console.log(result);
        if (result.data.status == "success") {
            const loginDate = new Date();
            localStorage.setItem("token", result.data.data.token);
            localStorage.setItem("role", result.data.data.role);
            localStorage.setItem("email", result.data.data.email);
            localStorage.setItem("userid", result.data.data.id);
            localStorage.setItem("loginDate", loginDate.toISOString());
            if (result.data.data.role == "client") {
              window.location.href = `/dashboard/client/${result.data.data.id}`;
            } else {
              window.location.href = "/dashboard";
            }

        } else {
          this.showError();

          if (loginButton) {
            loginButton.innerHTML = 'Log in';
          }
        }
      },

      showError() {
      const errorMessageElement = this.$refs.errorMessage;

      if (errorMessageElement) {
        errorMessageElement.innerHTML = '<i class="fa-light fa-triangle-exclamation"></i> Inlog mislukt';
        errorMessageElement.style.display = "flex";
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

  .onetimecode {
    width: 100%;
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
    justify-content: flex-start;

    text-align: left;
    align-items: flex-start;
    padding: 0 15px;

    margin: 0 10px;
    box-shadow: 2px 4px 15px 1px gray;

    @media only screen and (min-width: 576px) {
      padding: 0;

      text-align: center;
      align-items: center;
    }

    ;

    @media only screen and (min-width: 640px) {
      padding: 2rem;
      margin: 0;
    }

    ;

  }

  #error {
    display: none;

    height: 70px;
    align-items: center;
    justify-content: center;
    gap: 7px;
    font-weight: 600;
    color: #B92B27;
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