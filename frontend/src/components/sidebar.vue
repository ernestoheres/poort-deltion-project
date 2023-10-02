<template>
    <div class="Side">
        <div class="Item">
            Item 1
        </div>
        <div class="Item">
            Item 2
        </div>
        <div class="Item">
            Item 3
        </div>
        <div class="Item">
            Item 4
        </div>
        <div class="Item">
            Item 5
        </div>
    </div>
</template>
<style>
.Item{
    padding-inline: 15px;
    padding-top: 15px;
}
.Side{
    background-color: azure;
    min-height: calc(100vh - 90px);
    width: 75px;
    left: 0;
    align-items: center;
    color: black;
    display: flex;
    flex-direction: column;
    top: 5;
    z-index: 2;
}
</style>