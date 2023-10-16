<script>

import axios from 'axios';

export default {
  data() {
    return {
      user: []
    };
  },
  mounted() {
    axios.get('http://localhost:8000/api/clients/3')
      .then(response => {
        this.user = response.data;
      })
      .catch(error => {
        console.error(error);
      });
  }
};
</script>
<script setup>
import Notes from './notes.vue'
</script>

<template>
    <div id="ContainerProfile">
        <div class="InfoBubble">
            <div class="InfoUser">
                <div class="InfoUsercontent"><img :src="'http://127.0.0.1:8000/api/clients/' + user.id + '/image'" alt="User Image" class="InfoImage"></div>
                <div class="InfoUsercontent"> {{ user.voornaam }} {{ user.achternaam }} </div>
            </div>
            <table class="SettingUser">
                <div class="divinfo">Klant informatie</div>
                <tr> 
                    <th>Telefoonnummer:</th><td> {{ user.telefoon }} </td>
                    <th>Polisnummer:</th><td> {{ user.polisnummer }} </td>
                    <th>Verzekering:</th><td> {{ user.vezekering }}  </td>
                </tr>
                <div class="Slide"></div>
                <div class="divinfo">Klant informatie</div>
                <tr>
                    <th>Adres:</th><td> {{ user.adres }}</td>
                    <th>Postcode:</th><td> {{ user.postcode }}</td>
                    <th>Woonplaats:</th><td> {{ user.woonplaats }}</td>
                    <th>Land:</th><td> {{ user.land }}</td>
                </tr>
                <div class="Slide"></div>
                <div class="divinfo">Klant informatie</div>
                <tr>
                    <th>BSN:</th><td> {{ user.bsn }} </td>
                    <th>Gender:</th><td> {{ user.gender }}</td>
                    <th>Bloedtype:</th><td> {{ user.bloodtype }}</td>
                </tr>
            </table>
        </div>
    </div>

    <Notes />

</template>



<style scoped>
#ContainerProfile{
    display: flex;
    max-width: 100vw;
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
    background-color: white;
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
    text-align: center;
    padding-top: 20px;
    font-weight: bold;
    font-size: large;
}

.SettingUser{
    display: flex;
    flex-direction: column;
    width: calc(100% - 12.5%);
    gap: 0;
    margin: 0px;
    padding: 0px;
    background-color: white;
    border-radius: 0px 8px 8px 0px;
}

.SettingUser td{
    width: calc(fit-content + 15px);
    margin-inline: 10px;
    text-align: left;
    vertical-align: middle;
    font-weight: bold;
}

.SettingUser tr{
    /* margin-left: 30px; */
    margin-top: 15px;
    margin-bottom: 30px;
    display: flex;
    flex-direction: row;
    height: 100%;
}

.SettingUser th{
    width: calc(fit-content + 15px);
    text-align: left;
    padding-left: 5px;
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
    min-height: 1px;

}
.divinfo{
    margin-left: 5px;
    margin-top: 5px;
    font-weight: bold;
}
</style>