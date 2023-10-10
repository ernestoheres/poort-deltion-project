<template>
    <div id="ContainerProfile">
        <div class="InfoBubble">
            <div class="InfoUser">
                <div>User Info</div>
                <div class="InfoUsercontent"><img :src="'http://127.0.0.1:8000/api/clients/' + 1 + '/image'" alt="User Image" class="InfoImage"></div>
                <div class="InfoUsercontent"> {{ user.voornaam }} {{ user.achternaam }} </div>
            </div>
            <table class="SettingUser">
                <tr> 
                    <td>Telefoonnummer: {{ user.telefoon }} <i class="fa-solid fa-gear"></i></td>
                    <td>Polisnummer: {{ user.polisnummer }} <i class="fa-solid fa-gear"></i></td>
                    <td>Verzekering: {{ user.vezekering }} <i class="fa-solid fa-gear"></i></td>
                </tr>
                <div class="Slide"></div>
                <tr>
                    <td>Adres: {{ user.adres }}</td>
                    <td>Postcode: {{ user.postcode }}</td>
                    <td>Woonplaats: {{ user.woonplaats }}</td>
                    <td>Land: {{ user.land }}</td>
                </tr>
                <div class="Slide"></div>
                <tr>
                    <td>BSN: {{ user.bsn }} </td>
                </tr>
            </table>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      user: []
    };
  },
  mounted() {
    axios.get('http://localhost:8000/api/clients/1')
      .then(response => {
        this.user = response.data;
      })
      .catch(error => {
        console.error(error);
      });
  }
};
</script>

<style scoped>
#ContainerProfile{
    display: flex;
    max-width: 95vw;
    width: 100%;
    height: 100%;
    flex-direction: column;
    align-items: center;
}

.InfoBubble{
    width: 90%;
    display: flex;
    flex-direction: row;
    border-radius: 5px;
    height: 300px;
    box-shadow: 0 0px 10px 0 lightgray;
    border-radius: 15px;
}

.InfoUser{
    width: 12.5%;
    height: 100%;
    display: flex;
    align-items: center;
    flex-direction: column;
    flex-wrap: nowrap;
    justify-content: center;
    border-right: 1px lightgray solid;
}

.InfoUsercontent {
    display: flex;
    justify-content: center;
}

.SettingUser{
    display: flex;
    flex-direction: column;
    width: 100%;
    gap: 0;
    margin: 0px;
    padding: 0px;
}

.SettingUser td{
    width: 250px;
    margin-inline: 10px;
}

.SettingUser tr{
    /* margin-left: 30px; */
    margin-top: 15px;
    margin-bottom: 30px;
    display: flex;
    flex-direction: row;
}

.SettingUser hr{
    width: 100%;
}

.InfoImage{
    width: 80px;
    height: 80px;
    border-radius: 100%;
}
.Slide{
    width: 100%;
    height: 1px;
    background-color: rgba(0, 0, 0, 0.1);
}
</style>