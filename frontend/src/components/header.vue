<template>
    <div class="Container">
        <div>
            <img class="Foto" src="../assets/logopoort2.png">
        </div>
        
        <div class="Items">
            Item 1
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
    position: absolute;
    height: 10%;
    width: 100%;
    left: 0;
    align-items: center;
    color: black;
    display: flex;
    overflow:visible;
    top: 0;
}
</style>