<template>
<div class="Block">
    <div class="BackGround">
        <div>
            <img class="Foto" src="../assets/logopoort2.png">
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
        left: 30%;
        height: 125px;
        align-items: center;
        padding-left: 10px;
        top: 45%;
        position: relative;
    }
    .Block{
        left: 0%;
        position: fixed;
        top: 0%;
        height: 100%;
        width: auto;
        background-color: rgba(173, 216, 230, 0.322);
        display: block;
        width: 100%;
        z-index: 100000;
    }
    .Foto{
        width: auto;
        height: 100px;
        padding-right: 10px;
    }
</style>