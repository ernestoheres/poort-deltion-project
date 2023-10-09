<template>
    <div id="ContainerProfile">
        <div>User Info</div>
        <div class="InfoBubble">
            <div class="InfoUser">
                <div><img :src="'http://127.0.0.1:8000/api/clients/' + 1 + '/image'" alt="User Image" class="InfoImage"></div>
                <div> {{ user.voornaam }} {{ user.achternaam }} </div>
            </div>
            <table id="SettingUser">
                <tr> 
                    <td>Telefoonnummer: {{ user.telefoon }}</td><td>Polisnummer: {{ user.polisnummer }}</td><td>Verzekering: {{ user.vezekering }}</td></tr>
                <tr><td>Adres: {{ user.adres }}</td><td>Postcode: {{ user.postcode }}</td><td>Woonplaats: {{ user.woonplaats }}</td><td>Land: {{ user.land }}</td></tr>
                <tr><td>Bsn: {{ user.bsn }} </td></tr>
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
    width: 100%;
    height: 100%;
    flex-direction: column;
}
.InfoBubble{
    display: flex;
    flex-direction: row;
    border: 1px black solid;
    border-radius: 5px;
}
.InfoUser{
    /* background-color: black; */
    width: 25%;
    height: 100%;
}
.SettingUser{
    display: flex;
    flex-direction: column;
    
}
.InfoImage{
    width: 150px;
    height: 150px;
    border-radius: 100%;
}
#SettingUser{
    border: 1px black solid;
}
</style>