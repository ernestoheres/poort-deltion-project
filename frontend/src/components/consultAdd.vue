<template>
    <form method="post" id="form-addConsult">
                    <input type="text" name="voornaam" v-model="user.voornaam" placeholder="Voornaam" />
                    <input type="text" name="tussenvoegsels" v-model="user.tussenvoegels" placeholder="tussenvoegsels" />
                    <input type="text" name="achternaam" v-model="user.achternaam" placeholder="Achternaam" />
                    <input type="time" name="btijd" placeholder="Begin tijd" />
                    <input type="time" name="etijd" placeholder="Eind tijd" />
                    <input type="date" name="datum" placeholder="dd/mm/yyyy"/>
                    <select name="doctor">
                      <option value="DHR A">Doctor 1</option>
                      <option value="MVR B">Doctor 2</option>
                    </select>
    </form>
    <div class="submitform-container">
        <button class="subitform-button" @click="addConsult()" form="form-addConsult" value="Plan in">Plan in!</button>
    </div>
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
  addConsult() {
    axios.post('http://localhost:8000/api/addconsult', {
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
        window.location.href = '/dashboard/agenda';
      })
      .catch((error) => {
        console.log(error);
      });
  }

};
</script>


<style scoped>
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

@media only screen and (min-width: 860px) {
}

</style>