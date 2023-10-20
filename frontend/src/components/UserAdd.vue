<template>
    <form action="/verstuurd.php" method="post" id="form-adduser">
    <div id="ContainerProfile">
        <div class="InfoBubble">
            <div class="InfoUser">
                <div class="InfoUsercontent">
                    <div class="image" :style="{ backgroundImage: 'url(' + selectedImage + ')' }"></div>
                </div>
                <input type="file" @change="handleImageChange" name="avatar" accept="image/png, image/jpeg" class="hidden-file-input" />
                <div class="InfoUsercontent InfoUsercontent-Naam">
                    <input type="text" name="voornaam" v-model="user.voornaam" placeholder="Voornaam" />
                    <input type="text" name="tussenvoegsels" v-model="user.tussenvoegels" placeholder="tussenvoegsels" />
                    <input type="text" name="achternaam" v-model="user.achternaam" placeholder="Achternaam" />
                </div>
            </div>
            <table class="SettingUser">
                <div class="divinfo">Klant informatie</div>
                <div class="info-block"> 
                    <tr>
                        <th>Tel:</th>
                        <td> <input type="text" name="telefoon" v-model="user.telefoon" placeholder="Telefoon nummer" /> </td>
                    </tr>

                    <tr>
                        <th>Polisnummer:</th>
                        <td> <input type="number" name="polisnummer" v-model="user.polisnummer" placeholder="Polis nummer" /> </td>
                    </tr>

                    <tr>
                        <th>Verzekering:</th>
                        <td> <input type="text" name="verzekering" v-model="user.vezekering" placeholder="Verzekering" /> </td>
                    </tr>

                    <tr>
                        <th>Geboortedatum:</th>
                        <td> <input type="date" name="geboortedatum" v-model="user.geboortedatum" placeholder="Geboorte datum" /> </td>
                    </tr>
                </div>
                <div class="Slide"></div>
                <div class="divinfo">Woonplaats / adres</div>
                <div class="info-block">
                    <tr>
                        <th>Adres:</th>
                        <td> <input type="text" name="adres" v-model="user.adres" placeholder="Adres" /> </td>
                    </tr>

                    <tr>
                        <th>Postcode:</th>
                        <td> <input type="text" name="postcode" v-model="user.postcode" placeholder="Postcode" /> </td>
                    </tr>

                    <tr>
                        <th>Woonplaats:</th>
                        <td> <input type="text" name="woonplaats" v-model="user.woonplaats" placeholder="Woonplaats" /> </td>
                    </tr>

                    <tr>
                        <th>Land:</th>
                        <td> <input type="text" name="land" v-model="user.land" placeholder="Land" /> </td>
                    </tr>
                </div>
                <div class="Slide"></div>
                <div class="divinfo">Klant informatie</div>
                <div class="info-block">
                    <tr>
                        <th>BSN:</th>
                        <td> <input type="number" name="bsnnummer" v-model="user.bsn" placeholder="BSN nummer" /> </td>
                    </tr>

                    <tr>
                        <th>Gender:</th>
                        <td> <input type="text" name="gender" v-model="user.gender" placeholder="Gender" /> </td>
                    </tr>

                    <tr>
                        <th>Bloedtype:</th>
                        <td> <input type="text" name="bloedtype" v-model="user.bloodtype" placeholder="Bloedtype" /> </td>
                    </tr>
                </div>
            </table>
        </div>
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
  },
};
</script>


<style scoped>
#ContainerProfile{
    display: flex;
    max-width: 100vw;
    width: 100%;
    flex-direction: column;
    align-items: center;
}

.InfoBubble{
    width: 90%;
    display: flex;
    flex-direction: column;
    box-shadow: 0 0px 10px 0 lightgray;
    border-radius: 8px;
    background-color: white;
}

.InfoUser{
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

.SettingUser{
    display: flex;
    flex-direction: column;
    width: 100%;
    gap: 0;
    margin: 0px;
    padding: 0px;
    background-color: white;
    border-radius: 0px 8px 8px 0px;
}

.SettingUser td{
    /* min-width: 100px; */
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
.SettingUser .info-block{
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


.InfoImage{
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

.Slide{
    width: 100%;
    height: 1px;
    background-color: rgba(0, 0, 0, 0.1);
    min-height: 1px;

}
.divinfo{
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

@media only screen and (min-width: 860px) {

    .image {
        width: 7vw;
        height: 7vw;
    }

    .InfoBubble{
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