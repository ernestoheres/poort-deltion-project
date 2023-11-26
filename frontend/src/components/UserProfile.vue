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
                <div class="InfoUser">
                    <div class="InfoUsercontent"><img :src="'http://127.0.0.1:8000/api/clients/' + user.id + '/image'"
                            alt="User Image" class="InfoImage"></div>
                    <p class="InfoUsercontent"> {{ user.voornaam }} <span>{{ user.tussenvoegels }}</span>
                        {{ user.achternaam }} </p>
                </div>
                <table class="SettingUser">
                    <div class="divinfo">Algemene informatie</div>
                    <div class="info-block">
                        <tr>
                            <th>Tel:</th>
                            <td> {{ user.telefoon }} </td>
                        </tr>

                        <tr>
                            <th>Geboortedatum:</th>
                            <td> {{ user.geboortedatum }} </td>
                        </tr>

                        <tr>
                            <th>Gender:</th>
                            <td> {{ user.geslacht }}</td>
                        </tr>

                        <tr>
                            <th>Bloedtype:</th>
                            <td> {{ user.bloedtype }}</td>
                        </tr>
                    </div>
                    <div class="Slide"></div>
                    <div class="divinfo">Woonplaats / adres</div>
                    <div class="info-block">
                        <tr>
                            <th>Adres:</th>
                            <td> {{ user.adres }}</td>
                        </tr>

                        <tr>
                            <th>Postcode:</th>
                            <td> {{ user.postcode }}</td>
                        </tr>

                        <tr>
                            <th>Woonplaats:</th>
                            <td> {{ user.woonplaats }}</td>
                        </tr>

                        <tr>
                            <th>Land:</th>
                            <td> {{ user.land }}</td>
                        </tr>
                    </div>
                    <div class="Slide"></div>
                    <div class="divinfo">extra informatie</div>
                    <div class="info-block">
                        <tr>
                            <th>BSN:</th>
                            <td> {{ user.bsn }} </td>
                        </tr>

                        <tr>
                            <th>Polisnummer:</th>
                            <td> {{ user.polisnummer }} </td>
                        </tr>

                        <tr>
                            <th>Verzekering:</th>
                            <td> {{ user.vezekering }} </td>
                        </tr>

                        <tr>
                            
                        </tr>
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
        border-radius: 0px 8px 8px 0px;
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

    @media only screen and (min-width: 860px) {
        .InfoBubble {
            flex-direction: row;
        }

        .SettingUser {
            width: calc(100% - 12.5%);
        }

        .InfoUser {
            width: 12.5%;
            border-right: 1px lightgray solid;
            border-bottom: none;
        }
    }
</style>