<template> 
    <form method="post" id="form-edituser" @submit.prevent="updateUser(id)">
        
    <div id="ContainerProfile">
        <div class="InfoBubble">
            <div class="InfoUser">
                <div class="InfoUsercontent">
                    <div class="image" :style="{ backgroundImage: 'url(' + selectedImage + ')' }"></div>
                </div>
                <input type="file" @change="handleImageChange" name="avatar" accept="image/png, image/jpeg" class="hidden-file-input" />
                <div class="InfoUsercontent InfoUsercontent-Naam">
                    <input type="text" name="voornaam" placeholder="Voornaam" v-model="user.voornaam" required/>
                    <input type="text" name="tussenvoegsels" v-model="user.tussenvoegels" placeholder="tussenvoegsels" />
                    <input type="text" name="achternaam" placeholder="Achternaam" v-model="user.achternaam" required/>
                </div>
            </div>
            <table class="SettingUser">
                <div class="divinfo">Algemene informatie</div>
                <div class="info-block"> 
                    <tr>
                        <th>Tel:</th>
                        <td> <input type="text" name="telefoon" placeholder="Telefoon nummer" v-model="user.telefoon" required/> </td>
                    </tr>

                    <!-- <tr>
                        <th>Geboortedatum:</th>
                        <td> <input type="date" name="geboortedatum" placeholder="Geboorte datum" v-model="user.geboortedatum" required/> </td>
                    </tr> -->

                    <tr>
                        <th>Gender:</th>
                        <td>
                             <select name="gender" v-model="user.geslacht">
                                <option value="Man">Man</option>
                                <option value="Vrouw">Vrouw</option>
                            </select>
                        </td>
                    </tr>
                
                    <tr>
                        <th>Bloedtype:</th>
                            <td> 
                                <select name="Bloedtype" v-model="user.bloedtype">
                                    <option value="A+">A+</option>
                                    <option value="A-">A-</option>
                                    <option value="B+">B+</option>
                                    <option value="B-">B-</option>
                                    <option value="AB+">AB+</option>
                                    <option value="AB-">AB-</option>
                                    <option value="O+">O+</option>
                                    <option value="O-">O-</option>
                                    <option value="onbekend">Onbekend</option>
                                </select> 
                            </td>
                    </tr>

                    <tr>

                    </tr>

                </div>
                <div class="Slide"></div>
                <div class="divinfo">Woonplaats / adres</div>
                <div class="info-block">
                    <tr>
                        <th>Adres:</th>
                        <td> <input type="text" name="adres" placeholder="Adres" v-model="user.adres" required/> </td>
                    </tr>

                    <tr>
                        <th>Postcode:</th>
                        <td> <input type="text" name="postcode" placeholder="Postcode" v-model="user.postcode" required/> </td>
                    </tr>

                    <tr>
                        <th>Woonplaats:</th>
                        <td> <input type="text" name="woonplaats" placeholder="Woonplaats" v-model="user.woonplaats" required/> </td>
                    </tr>

                    <tr>
                        <th>Land:</th>
                        <td> <input type="text" name="land" placeholder="Land" v-model="user.land" required/> </td>
                    </tr>
                </div>
                <div class="Slide"></div>
                <div class="divinfo">extra informatie</div>
                <div class="info-block">
                    <tr>
                        <th>BSN:</th>
                        <td> <input type="number" name="bsnnummer" placeholder="BSN nummer" v-model="user.bsn" required/> </td>
                    </tr>

                    <tr>
                        <th>Polisnummer:</th>
                        <td> <input type="number" name="polisnummer" placeholder="Polis nummer" v-model="user.polisnummer" required/> </td>
                    </tr>

                    <tr>
                        <th>Verzekering:</th>
                        <td> <input type="text" name="verzekering" placeholder="Verzekering" v-model="user.vezekering" required/> </td>
                    </tr>

                </div>
            </table>
        </div>
        <div v-if="showConfirmMessage" class="confirm">
            Uw data is aangepast!
        </div>
        <div class="subitform-div">
             <button class="subitform-button" type="submit" form="form-edituser" value="Submit">Opslaan</button>
        </div>
    </div>
    </form>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      user: {
      tussenvoegels: 'de',
      },
    showConfirmMessage: false,
      id: this.$route.params.id,
      userImage: '', // Initialize as an empty string
      selectedImage: '',
    };
  },
  mounted() {
    const id = this.$route.params.id;
    this.selectedImage = `http://127.0.0.1:8000/api/clients/${id}/image`; // Set the initial value
    axios.get(`http://localhost:8000/api/clients/${id}`,  { headers: { Authorization: `Bearer ${localStorage.getItem('token')}` } })
      .then(response => {
        this.user = response.data;
        this.userImage = `http://127.0.0.1:8000/api/clients/${this.user.id}/image`;
      })
      .catch(error => {
        console.error(error);
      });
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
  
  updateUser(id) {

        axios.put('http://localhost:8000/api/clients/'+id, this.user, { headers: { Authorization: `Bearer ${localStorage.getItem('token')}` } }) 
            .then(res => {
                console.log(res.data)

                this.errorList = '';
            })
            
            // zodat er geen refresh nodig is voor een nieuwe confirm message
             this.showConfirmMessage = false;

             setTimeout(() => {
          this.showConfirmMessage = true;
        }, 1000);

  },
    }, 
};
</script>


<style scoped>

#form-edituser {
    width: 100%;
}

#ContainerProfile{
    display: flex;
    max-width: 100vw;
    width: 100%;
    flex-direction: column;
    align-items: center;
}

.subitform-div {
    width: 90%;
    display: flex;
    justify-content: flex-end;
    margin-top: 15px;
}

.subitform-button{
  cursor: pointer;
  border: solid 2px lightgray;
  border-radius: 8px;
  font-size: 16px;
  width: 125px;
  padding: 5px;
  margin-bottom: 5px;
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

.InfoUsercontent-Naam select {
    border: solid 2px lightgray;
    border-radius: 8px;
    font-size: 16px;
    margin-bottom: 5px;
    text-align: center;
}

.InfoUsercontent-Naam option {
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

.confirm {
        height: 1px;
        align-items: center;
        justify-content: center;
        gap: 7px;
        font-weight: 600;
        color: green;
        margin: 15px 0;
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