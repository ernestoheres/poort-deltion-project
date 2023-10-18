<template>
    <div class="ContainerHeader">
        <div class="Header">
            
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
    </div>
</template>
<style scoped>
.Items{
    padding-left: 15px;
}
.Foto{
    padding-left: 15px;
    width: auto;
    height: 75px;
}

.ContainerHeader {
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 120px;
}

.Header{
    box-shadow: 0 0 15px rgba(0,0,0,0.3);
    width: 90%;
    background-color: white;
    border-radius: 8px;
    height: 90px;
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