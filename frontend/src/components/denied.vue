<template>
<div class="Cont">
    <div class="BackGround">
        <div>
            <img class="Foto" src="../assets/logopoort2.png" width="100px">
        </div>
        <div class="TextCont">
            <div>
                Inloggen niet mogelijk!
            </div>
            <div>
                Uw account is gedeactiveerd.<br>
                Neem contact op met de klantenservice voor meer informatie.
            </div>
            <div>
                <a class="TelNum" href="tel:+310321329999">Klantenservice: 0321329999</a>
            </div>
        </div>
    </div>
</div>
</template>
<style>
    .TelNum{
        color: black;
    }
    .TelNum:hover{
        background-color: rgba(211, 227, 233, 0.562);
        color: black;
    }
    .TextCont{
        display: flex;
        flex-direction: column;
    }
    .BackGround{
        background-color: azure;
        color: black;
        display: flex;
        border-radius: 15px;
        width: 725px;
        box-shadow: 0px 1px 20px 9px black;
        left: 35%;
        height: 125px;
        align-items: center;
        padding-left: 10px;
        top: 45%;
        position: relative;
    }
    .Cont{
        left: 0%;
        position: fixed;
        height: 100%;
        width: auto;
        background-color: rgba(173, 216, 230, 0.322);
        display: block;
    }
    .Foto{
        width: 100px;
        height: 100px;
    }
</style>