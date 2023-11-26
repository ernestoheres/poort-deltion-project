<template>
    <form @submit.prevent="addClient($event)" id="form-addclient">
        <div id="ContainerProfile">
            <div class="InfoBubble">
                <div class="InfoUser">
                    <div class="InfoUsercontent">
                        <div class="image" :style="{ backgroundImage: 'url(' + selectedImage + ')' }"></div>
                    </div>
                    <input type="file" @change="handleImageChange" name="avatar" accept="image/png, image/jpeg"
                        class="hidden-file-input" />
                    <div class="InfoUsercontent InfoUsercontent-Naam">
                        <input type="text" name="voornaam" v-model="user.voornaam" placeholder="Voornaam" required />
                        <input type="text" name="tussenvoegsels" v-model="user.tussenvoegsels"
                            placeholder="tussenvoegsels" />
                        <input type="text" name="achternaam" v-model="user.achternaam" placeholder="Achternaam" required />
                    </div>
                </div>
                <table class="SettingUser">
                    <div class="divinfo">Algemene informatie</div>
                    <div class="info-block">
                        <tr>
                            <th>Tel:</th>
                            <td> <input type="text" name="telefoon" v-model="user.telefoon" placeholder="Telefoon nummer" /> </td>
                        </tr>

                        <tr>
                            <th>Geboortedatum:</th>
                            <td> <input type="date" name="geboortedatum" v-model="user.geboortedatum" placeholder="Geboorte datum" required /> </td>
                        </tr>

                        <tr>
                            <th>Gender:</th>
                            <td> <select type="text" name="gender" v-model="user.gender" placeholder="Gender" required>
                                    <option value="Man">Man</option>
                                    <option value="Vrouw">Vrouw</option>
                                </select> </td>
                        </tr>

                        <tr>
                            <th>Bloedtype:</th>
                            <td> <select type="text" name="bloedtype" v-model="user.bloedtype" placeholder="Bloedtype" required>
                                    <option value="A+">A+</option>
                                    <option value="A-">A-</option>
                                    <option value="B+">B+</option>
                                    <option value="B-">B-</option>
                                    <option value="AB+">AB+</option>
                                    <option value="AB-">AB-</option>
                                    <option value="O+">O+</option>
                                    <option value="O-">O-</option>
                                    <option value="onbekend" selected="selected" >Onbekend</option>
                                </select> </td>
                        </tr>

                    </div>
                    <div class="Slide"></div>
                    <div class="divinfo">Woonplaats / adres</div>
                    <div class="info-block">
                        <tr>
                            <th>Adres:</th>
                            <td> <input type="text" name="adres" v-model="user.adres" placeholder="Adres" required /> </td>
                        </tr>

                        <tr>
                            <th>Postcode:</th>
                            <td> <input type="text" name="postcode" v-model="user.postcode" placeholder="Postcode" required />
                            </td>
                        </tr>

                        <tr>
                            <th>Woonplaats:</th>
                            <td> <input type="text" name="woonplaats" v-model="user.woonplaats" placeholder="Woonplaats" required /> </td>
                        </tr>

                        <tr>
                            <th>Land:</th>
                            <td> <input type="text" name="land" v-model="user.land" placeholder="Land" required /> </td>
                        </tr>
                    </div>
                    <div class="Slide"></div>
                    <div class="divinfo">Extra informatie</div>
                    <div class="info-block">
                        <tr>
                            <th>BSN:</th>
                            <td> <input type="number" name="bsnnummer" v-model="user.bsn" placeholder="BSN nummer" />
                            </td>
                        </tr>

                        <tr>
                            <th>vezekerings polisnummer:</th>
                            <td> <input type="number" name="polisnummer" v-model="user.polisnummer" placeholder="polisnummer" /> </td>
                        </tr>

                        <tr>
                            <th>Verzekering:</th>
                            <td> <input type="text" name="verzekering" v-model="user.vezekering" placeholder="Verzekering" /> </td>
                        </tr>

                    </div>
                </table>
            </div>

            <div class="InfoBubble email-bubble">
                <div class="info-block">
                    <tr>
                        <th>E-mail adres:</th>
                        <td> <input type="email" name="email" v-model="user.email" placeholder="email@DePoort.nl" required /> </td>
                    </tr>
                </div>
            </div>

        </div>

    <div class="submitform-container">
        <button type="submit" class="subitform-button" form="form-addclient" value="Submit">Client toevoegen</button>
    </div>

    </form>
</template>

<script>
    import axios from 'axios';

    export default {
        data() {
            return {
                user: {},
                userImage: '', // Initialize as an empty string
                selectedImage: 'http://placehold.it/180',
            };
        },
        methods: {
            handleImageChange(event) {
                const input = event.target;
                if (input.files && input.files[0]) {
                    const reader = new FileReader();

                    reader.onload = (e) => {
                        this.selectedImage = e.target.result;
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            },
        addClient(event) {
            event.preventDefault();

            const formData = new FormData(event.target);
            axios.post('http://localhost:8000/api/clients', {
                    voornaam: formData.get('voornaam'),
                    tussenvoegels: formData.get('tussenvoegsels'),
                    achternaam: formData.get('achternaam'),
                    adres: formData.get('adres'),
                    postcode: formData.get('postcode'),
                    woonplaats: formData.get('woonplaats'),
                    land: formData.get('land'),
                    telefoon: formData.get('telefoon'),
                    bsn: formData.get('bsnnummer'),
                    vezekering: formData.get('verzekering'),
                    polisnummer: formData.get('polisnummer'),
                    bloedtype: formData.get('bloedtype'),
                    geslacht: formData.get('gender'),
                    email: formData.get('email'),

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
    #form-addclient {
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
        border-radius: 0px 8px 8px 0px;
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
        width: 90%;
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
            width: calc(100% - 12.5%);
        }

        .InfoUser {
            width: 12.5%;
            border-right: 1px lightgray solid;
            border-bottom: none;
        }
    }
</style>