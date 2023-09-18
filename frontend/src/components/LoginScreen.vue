<script setup>

</script>

<template>
    <div class="LoginBackground">
        <div class="LoginContainer">

            <img src="../assets/DePoort-Logo.png" width="150px">

            <p>Login</p>
            <p>Login met de gegevens</p>

            <div class="LoginInputs">
                <label for="uname"><b>Username</b></label>
                <input type="text" placeholder="Enter Username" name="uname" required>
            
                <label for="psw"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="psw" required>
                
                <button type="submit">Log in</button>
                <label>
                    <input type="checkbox" checked="checked" name="remember"> Remember me
                </label>
            </div>
        </div>
    </div>
  </template>
  
  <script setup>
  </script>
  
  <style scoped>

  .LoginBackground {
    background-color: #abcad2;
    height: 100vh;
    width: 100vw;
  }
  .LoginContainer {
    background-color: #fff;
    box-shadow: #8aa1a5 0px 0px 10px 0px;
    height: 60vh;
    min-height: 300px;
    width: 500px;

    max-width: 1280px;
    margin: auto auto;
    padding: 2rem;

    font-weight: normal;

    border-radius: 7px;

    position: fixed;
    top: calc(50% - 30vh);
    left: calc(50% - 250px);

    text-align: center;

  }

  .LoginInputs {
    display: grid;

    width: 65%;
    text-align: left;
    margin: auto;
    margin-top: 35px;

  }

  .LoginInputs input {
    width: 100%;
    place-self: center;
    height: 30px;
    border-radius: 5px;
    border: 2px lightgray solid;
  }

  .LoginInputs button {
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
  }
  </style>
  