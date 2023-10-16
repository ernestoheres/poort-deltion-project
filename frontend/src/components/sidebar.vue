<script>
    import 'font-awesome/css/font-awesome.css'

    export default {
        data() {
            return {
            isSidebarOpen: false
            };
        },
        methods: {
            toggleSidebar() {
            this.isSidebarOpen = !this.isSidebarOpen;
            }
        }
    };
</script>
<template>
    <div class="Side" :class="{ 'sidebar-open': isSidebarOpen }" @click="toggleSidebar" >
        <div class="top">
            <div class="logo" >
                <img href="./" class="Foto" src="../assets/logopoort2.png">
            </div>
            <div class="close-sidebar" >
                <i class="fa-regular fa-circle-chevron-left fa-xl" style="color:#9B1D20"></i>
            </div>
        </div>

        <div class="center" @click="toggleSidebar">
            <div class="icon">
                <a href="/dashboard">
                    <i class="fa-regular fa-rectangle-list fa-2x icon-highlight"></i>
                    <p>Dashboard</p>
                </a>
            </div>

            <div class="icon">
                <a href="/dashboard/archive">
                    <i class="fa-light fa-box-archive fa-2x icon-highlight"></i>
                    <p>Archive</p>
                </a>
            </div>

            <div class="icon">
                <a href="/dashboard/user/add">
                    <i class="fa-regular fa-user-plus fa-2x icon-highlight"></i>
                    <p>Toevoegen</p>
                </a>
            </div>

            <div class="icon">
                <a href="/dashboard/calender">
                    <i class="fa-thin fa-calendar-days fa-2x icon-highlight"></i>
                    <p>Kalender</p>
                </a>
            </div>
        </div>

        <div class="bottom">
            <div class="icon">
                <a href="/">
                    <i class="fa-solid fa-right-from-bracket fa-2x icon-highlight"></i>
                    <p style="text-wrap: nowrap;">Log uit</p>
                </a>
            </div>
        </div>


    </div>
</template>


<style scoped>

.logo {
    cursor: pointer;
}

.logo img {
    width: 37.5px;
    height: auto;
}

.close-sidebar {
    cursor: pointer;
    margin-right: 3px;
}

.Side .icon {
    transition: background-color .3s, padding-left .3s;
    border-radius: 15px;
}

.Side.sidebar-open .icon {
    padding: 8px 15px;
}

.Side.sidebar-open .icon:hover {
    background-color: hsla(160, 100%, 37%, 0.15);
}

.Side .icon:hover * {
    filter: grayscale(50%);
    cursor: pointer;
    transition: all .3s;
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
    align-items: flex-start;
    color: black;
    display: flex;
    flex-direction: column;
    top: 5;
    z-index: 2;
    justify-content: space-between;
    padding: 15px;
    transition: all .3s;
}

.Side .icon a  {
    display: flex;
    flex-direction: row;
    width: fit-content;
    gap: 0;
    align-items: center;
    flex-wrap: nowrap;
}

.Side.sidebar-open .icon a p  {
    gap: 10px;
}

.Side .icon a p  {
    width: 0px;
    overflow: hidden;
    transition: all .3s;
    display: block;
}

.Side.sidebar-open .icon a p  {
    width: 80px;
}

.Side.sidebar-open {
    width: 200px !important;
}

.Side.sidebar-open .icon a  {
    display: flex;
    flex-direction: row;
    flex-wrap: nowrap;
    align-items: center;
    gap: 15px;
}

.Side.sidebar-open .icon a i  {
    min-width: 40px;
    width: 40px;
    max-width: 40px;
}
.Side.sidebar-open .icon a p  {
    display: block;
}

.top, .center, .bottom {
    display: flex;
    flex-direction: column;
    flex-wrap: nowrap;
    gap: 30px;
}
.Side .top {
    overflow: hidden;
    flex-direction: row;
    flex-wrap: nowrap;
    width: 65px;
    justify-content: space-between;
    align-items: center;
    transition: all .3s;
}

.Side.sidebar-open .top {
    width: 100%;
}

.Side.sidebar-open .center {
    gap: 14px;
    margin-bottom: -8px;
}

.Side.sidebar-open .bottom {
    margin-bottom: -8px;
}
</style>