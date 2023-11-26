<template>
  <div method="post" id="Form-Container">
    <form id="form-addConsult">
      <div class="Input-Cont">
        <input type="text" name="voornaam" v-model="user.voornaam" placeholder="Voornaam" />
      </div>
      <div class="Input-Cont">
        <input type="text" name="tussenvoegsels" v-model="user.tussenvoegels" placeholder="tussenvoegsels" />
      </div>
      <div class="Input-Cont">
        <input type="text" name="achternaam" v-model="user.achternaam" placeholder="Achternaam" />
      </div>
      <div class="Input-Cont">
        <input type="time" name="btijd" placeholder="Begin tijd" />
      </div>
      <div class="Input-Cont">
        <input type="time" name="etijd" placeholder="Eind tijd" />
      </div>
      <div class="Input-Cont">
        <input type="date" name="datum" placeholder="dd/mm/yyyy"/>
      </div>
      <div class="Input-Cont">
        <select name="doctor">
          <option value="DHR A">Doctor 1</option>
          <option value="MVR B">Doctor 2</option>
        </select>
      </div>
    </form>
    <div class="submitform-container">
        <button class="subitform-button" @click="addConsult()" form="form-addConsult">Plan in!</button>
    </div>
  </div>
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

        },
    addConsult() {
            axios.post('http://localhost:8000/api/agenda', {
              voornaam: this.consult.voornaam,
              tussenvoegels: this.consult.tussenvoegels,
              achternaam: this.consult.achternaam,
              btijd: this.consult.btijd,
              etijd: this.consult.etijd,
              datum: this.consult.datum,
              doctor: this.consult.doctor,
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

};
</script>


<style scoped>
#Form-Container {
  display: flex;
  flex-direction: column;
  margin-top: 5px;
}
form {
    display: flex;
    flex-direction: column;
    flex-wrap: nowrap;
}
input {
    cursor: text;
    border: solid 2px lightgray;
    border-radius: 8px;
    font-size: 16px;
    margin-bottom: 5px;
    text-align: center;
}
select{
    cursor: pointer;
    border: solid 2px lightgray;
    border-radius: 8px;
    font-size: 16px;
    margin-bottom: 5px;
    text-align: center;
}
</style>