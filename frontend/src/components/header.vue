<template>
    <div class="Container">
        <div>
            <img href="./" class="Foto" src="../assets/logopoort2.png">
        </div>
        
        <div class="Items">
            <a href="/login">Login</a>
        </div>
        <div class="Items">
            Item 2
        </div>
        <div class="Items">
            Item 3
        </div>
        <div class="Items">
            Item 4
        </div>
        <div class="Items">
            Item 5
        </div>
    </div>
</template>
<style>
.Items{
    padding-left: 15px;
}
.Foto{
    padding-left: 15px;
    width: auto;
    height: 75px;
}
.Container{
    background-color: azure;
    height: 90px;
    width: 100vw;
    left: 0;
    align-items: center;
    color: black;
    display: flex;
    flex-direction: row;
    overflow:visible;
    top: 0;
    z-index: 3;
}
</style>