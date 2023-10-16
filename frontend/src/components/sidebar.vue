<script>
    import 'font-awesome/css/font-awesome.css'
</script>
<template>
    <div class="Side">
        <div class="top">
            <div class="logo">
                <img href="./" class="Foto" src="../assets/logopoort2.png">
            </div>
        </div>

        <div class="center">
            <div class="icon">
                <i class="fa-solid fa-grid-horizontal fa-2x icon-highlight"></i> 
            </div>

            <div class="icon">
                <i class="fa-solid fa-plus fa-2x icon-highlight"></i>
            </div>

            <div class="icon">
                <i class="fa-regular fa-user fa-2x icon-highlight"></i>
            </div>

            <div class="icon">
                <i class="fa-solid fa-moon fa-2x icon-highlight"></i>
            </div>
        </div>

        <div class="bottom">
            <div class="icon">
                <a href="/login">
                    <i class="fa-solid fa-right-from-bracket fa-2x icon-highlight"></i>
                </a>
            </div>
        </div>


    </div>
</template>


<style scoped>

.logo {

}

.logo img {
    width: auto;
    height: 50px;
}

.icon {
    
}

.icon-highlight:hover {
  color: rgb(150, 150, 150); /* Change the color to your desired highlight color */
  cursor: pointer; /* Optional: Change the cursor to a pointer on hover */
}

.Item{
    padding-inline: 15px;
    padding-top: 15px;
}
.Side{
    box-shadow: 0 0 15px rgba(0,0,0,0.5);
    clip-path: inset(0px -15px 0px 0px);
    background-color: white;
    min-height: calc(100vh - 90px);
    width: 75px;
    left: 0;
    align-items: center;
    color: black;
    display: flex;
    flex-direction: column;
    top: 5;
    z-index: 2;
    justify-content: space-between;
    padding: 15px 0;
}

.top, .center, .bottom {
    display: flex;
    flex-direction: column;
    flex-wrap: nowrap;
    gap: 30px;
}
</style>