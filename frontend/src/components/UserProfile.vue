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
    
    axios.get(`http://localhost:8000/api/clients/${id}`)
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
    <div id="ContainerProfile">
        <div class="InfoBubble">
            <div class="InfoUser">
                <div class="InfoUsercontent"><img :src="'http://127.0.0.1:8000/api/clients/' + user.id + '/image'" alt="User Image" class="InfoImage"></div>
                <div class="InfoUsercontent"> {{ user.voornaam }} {{ user.achternaam }} </div>
            </div>
            <table class="SettingUser">
                <div class="divinfo">Klant informatie</div>
                <tr> 
                    <th>Tel:</th><td> {{ user.telefoon }} </td>
                    <th>Polisnummer:</th><td> {{ user.polisnummer }} </td>
                    <th>Verzekering:</th><td> {{ user.vezekering }}  </td>
                    <th>Geboortedatum:</th><td> {{ user.geboortedatum }} </td>
                </tr>
                <div class="Slide"></div>
                <div class="divinfo">Woonplaats / adres</div>
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
                    <th>BSN:</th><td> {{ user.bsn }} </td>
                </tr>
            </table>
        </div>
    </div>

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
    height: 50%;
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
    /* min-width: 100px; */
    margin-inline: 10px;
    text-align: left;
    vertical-align: middle;
    font-weight: bold;
    color: #89BAEB;
    padding-right: 15px;
    flex: 1;
}
.SettingUser th{
    /* width: calc(fit-content + 15px); */
    text-align: left;
    padding-left: 5px;
    max-width: 95px;
    min-width: 95px;
}
.SettingUser tr{
    /* margin-left: 30px; */
    margin-top: 15px;
    margin-bottom: 30px;
    display: flex;
    flex-direction: row;
    height: 100%;
}


.InfoImage{
    width: 100px;
    height: 100px;
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