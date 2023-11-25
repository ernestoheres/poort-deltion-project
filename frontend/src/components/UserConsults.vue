<script>
    import axios from 'axios';

    export default {
        data() {
            return {
                user: []
            };
        },
        mounted() {
            const id = this.$route.params.id;

            axios.get(`http://localhost:8000/api/clients/${id}`, {
                    headers: {
                        Authorization: `Bearer ${localStorage.getItem('token')}`
                    }
                })
                .then(response => {
                    this.user = response.data;
                    console.log(response.data);
                })
                .catch(error => {
                    console.error(error);
                });
        }
    };
</script>

<template>
    <div class="insideContainer">
        <div id="ContainerProfile">
            <div class="InfoBubble">
                <table class="SettingUser">
                    <div class="divinfo">Consults</div>
                    <div class="info-block">
                        <div class="consult">
                            <div>
                                <p class="consult-title" >Wanneer:</p>
                                <p class="consult-data" >29 aug</p>
                            </div>

                            <div class="seperator"></div>

                            <div>
                                <p class="consult-title" >Hoelaat:</p>
                                <p class="consult-data" >03:00 tot 04:00</p>
                            </div>

                            <div class="seperator"></div>

                            <div>
                                <p class="consult-title" >Met:</p>
                                <p class="consult-data" >Dokter beer</p>
                            </div>
                        </div>

                        <div class="consult">
                            <div>
                                <p class="consult-title" >Wanneer:</p>
                                <p class="consult-data" >29 aug</p>
                            </div>

                            <div class="seperator"></div>

                            <div>
                                <p class="consult-title" >Hoelaat:</p>
                                <p class="consult-data" >03:00 tot 04:00</p>
                            </div>

                            <div class="seperator"></div>

                            <div>
                                <p class="consult-title" >Met:</p>
                                <p class="consult-data" >Dokter beer</p>
                            </div>
                        </div>
                        
                        <div class="consult">
                            <div>
                                <p class="consult-title" >Wanneer:</p>
                                <p class="consult-data" >29 aug</p>
                            </div>

                            <div class="seperator"></div>

                            <div>
                                <p class="consult-title" >Hoelaat:</p>
                                <p class="consult-data" >03:00 tot 04:00</p>
                            </div>

                            <div class="seperator"></div>

                            <div>
                                <p class="consult-title" >Met:</p>
                                <p class="consult-data" >Dokter beer</p>
                            </div>
                        </div>

                    </div>
                </table>
            </div>
        </div>
    </div>
</template>



<style scoped>
    .insideContainer {
        max-width: calc(100vw - 75px);
        width: 100%;
        margin: 35px 0;
    }
    #ContainerProfile {
        display: flex;
        max-width: 100vw;
        width: 100%;
        flex-direction: column;
        align-items: center;
    }

    .InfoBubble {
        width: 90%;
        display: flex;
        flex-direction: column;
        box-shadow: 0 0px 10px 0 lightgray;
        border-radius: 8px;
        background-color: white;
    }

    .email-bubble {
        margin-top: 15px;
        padding: 20px 8px;
    }

    .email-bubble input {
        cursor: text;
        border: solid 2px lightgray;
        border-radius: 8px;
        font-size: 16px;
    }

    .InfoUser {
        width: 100%;
        display: flex;
        align-items: center;
        flex-direction: column;
        flex-wrap: nowrap;
        justify-content: center;
        border-bottom: 1px lightgray solid;
    }

    .InfoUsercontent {
        display: flex;
        justify-content: center;
        text-align: center;
        padding-top: 20px;
        font-weight: bold;
        font-size: large;
    }

    .InfoUsercontent span {
        display: contents;
    }

    .SettingUser {
        display: flex;
        flex-direction: column;
        width: 100%;
        gap: 0;
        margin: 0px;
        padding: 0px;
        background-color: white;
        border-radius: 8px;
    }

    .SettingUser td {
        /* min-width: 100px; */
        margin-inline: 10px;
        text-align: left;
        vertical-align: middle;
        font-weight: bold;
        color: #89BAEB;
        padding-right: 15px;
        flex: 1;
    }

    .SettingUser th {
        width: fit-content;
        padding-right: 5px;
    }

    .SettingUser .info-block {
        justify-content: space-between;
        margin-left: 18px;
        margin-top: 15px;
        margin-bottom: 30px;
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        height: 100%;
    }

    .SettingUser .info-block tr {
        width: 20%;
        min-width: 185px;
        display: flex;
        flex-wrap: wrap;
    }


    .InfoImage {
        max-width: 120px;
        width: 90%;
        height: auto;
        border-radius: 100%;
    }

    .Slide {
        width: 100%;
        height: 1px;
        background-color: rgba(0, 0, 0, 0.1);
        min-height: 1px;

    }

    .divinfo {
        margin-left: 18px;
        margin-top: 18px;
        font-weight: bold;
    }

    .info-block {
        margin: 18px;
        display: flex;
        flex-wrap: wrap;
        gap: 25px;
    }

    .consult {
        width: fit-content;
        flex-wrap: wrap;
        border: 1px solid #89BAEB;
        padding: 25px;
        border-radius: 8px;
        display: flex;
        gap: 25px;
    }

    .consult-title {
        font-weight: 600;
    }

    .consult-data {

    }

    .seperator {
        width: 1px;
        background-color: lightgray;
    }

    @media only screen and (min-width: 860px) {
        
    }
</style>