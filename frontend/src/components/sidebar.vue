<script>
    import 'font-awesome/css/font-awesome.css'
</script>
<template>
    <div class="Side">
        <div class="icon">
            <a href="/login">
    <i class="fa-regular fa-house fa-2x icon-highlight"></i>
            </a>
        </div>
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
</template>
<style>

.icon {
    margin-top: 31px;
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
    background-color: azure;
    min-height: calc(100vh - 90px);
    width: 90px;
    left: 0;
    align-items: center;
    color: black;
    display: flex;
    flex-direction: column;
    top: 5;
    z-index: 2;
}
</style>