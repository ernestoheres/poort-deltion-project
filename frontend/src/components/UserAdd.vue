<template>
    <form id="form-adduser" @submit.prevent="addUser($event)">
        <div id="ContainerProfile">
            <div class="InfoBubble">
                <table class="SettingUser">
                    <div class="divinfo">Account informatie</div>
                    <div class="info-block">
                        <tr>
                            <th>Voornaam:</th>
                            <td> <input type="text" name="voornaam" v-model="user.voornaam" placeholder="Voornaam" /> </td>
                        </tr>

                        <tr>
                            <th>tussenvoegsels:</th>
                            <td> <input type="text" name="tussenvoegels" v-model="user.tussenvoegels" placeholder="Tussenvoegsels" /> </td>
                        </tr>

                        <tr>
                            <th>Achternaam:</th>
                            <td> <input type="text" name="achternaam" v-model="user.achternaam" placeholder="Achternaam" /> </td>
                        </tr>

                        <tr>
                            <th>email:</th>
                            <td> <input type="email" name="email" v-model="user.email" placeholder="Email adres" required/> </td>
                        </tr>

                        <tr>
                            <th>Type account:</th>
                            <td> <select type="text" name="rol" v-model="user.role" placeholder="rol" required>
                                    <option value="doctor">doktor</option>
                                    <option value="administrator">Administrator</option>
                                </select> </td>
                        </tr>

                        <tr></tr>
                    </div>
                    <div class="Slide"></div>
                </table>
            </div>

        </div>

        <div class="submitform-container">
            <button class="subitform-button" value="Submit">User toevoegen</button>
        </div>

    </form>

</template>

<script>
    import axios from 'axios';

    export default {
        data() {
            return {
                user: {},
            };
        },
        methods: {
            addUser(event) {
                event.preventDefault();
                axios.post('http://localhost:8000/api/user', {
                        email: this.user.email,
                        wachtwoord: this.user.wachtwoord,
                        rol: this.user.rol,
                    }, {
                        headers: {
                            Authorization: `Bearer ${localStorage.getItem('token')}`,
                        }
                    })
                    .then((response) => {
                        console.log(response);
                        window.location.href = '/dashboard';
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            }
        },


    };
</script>


<style scoped>
    #form-adduser {
        width: 90%;
    }

    #ContainerProfile {
        display: flex;
        max-width: 100vw;
        width: 100%;
        flex-direction: column;
        align-items: center;
    }

    .InfoBubble {
        width: 100%;
        display: flex;
        flex-direction: column;
    }

    .email-bubble {
        display: flex;
        flex-direction: column;
        width: 100%;
        gap: 0;
        margin: 0px;
        padding: 0px;
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 0px 10px 0 lightgray;

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
        height: 100%;
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

    .InfoUsercontent-Naam {
        flex-direction: column;
        width: 96%;
    }

    .InfoUsercontent-Naam input {
        cursor: text;
        border: solid 2px lightgray;
        border-radius: 8px;
        font-size: 16px;
        margin-bottom: 5px;
        text-align: center;
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
        box-shadow: 0 0px 10px 0 lightgray;
    }

    .SettingUser td {
        width: 100%;
        margin-inline: 10px;
        text-align: left;
        vertical-align: middle;
        font-weight: bold;
        color: #89BAEB;
        padding-right: 15px;
        flex: 1;
    }

    .SettingUser td input {
        cursor: text;
        border: solid 2px lightgray;
        border-radius: 8px;
        font-size: 16px;
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
        row-gap: 25px;
    }

    .SettingUser .info-block tr {
        min-width: 185px;
        display: flex;
        flex-wrap: wrap;
    }


    .InfoImage {
        max-width: 110px;
        max-height: 110px;
        width: 90px;
        height: 90px;
        border-radius: 100%;
    }

    .image {
        width: 15vw;
        height: 15vw;
        background-size: cover;
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

    .hidden-file-input {
        color: transparent;
        cursor: pointer;
        width: 107px;
        margin-top: 10px;
    }

    .submitform-container {
        width: 100%;
        display: flex;
        justify-content: flex-end;
        flex-wrap: nowrap;
        flex-direction: row;
        align-items: center;
        margin-top: 10px;
    }

    .subitform-button {
        cursor: pointer;
        border: solid 2px lightgray;
        border-radius: 8px;
        font-size: 16px;
        width: 175px;
        padding: 5px;
    }

    @media only screen and (min-width: 860px) {

        .image {
            width: 7vw;
            height: 7vw;
        }

        .InfoBubble {
            flex-direction: row;
        }

        .SettingUser {
            width: 100%;
        }
    }
</style>