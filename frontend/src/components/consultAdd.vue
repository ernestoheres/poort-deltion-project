<template>
    <form action="/verstuurd.php" method="post" id="form-adduser">
                    <input type="text" name="voornaam" v-model="user.voornaam" placeholder="Voornaam" />
                    <input type="text" name="tussenvoegsels" v-model="user.tussenvoegels" placeholder="tussenvoegsels" />
                    <input type="text" name="achternaam" v-model="user.achternaam" placeholder="Achternaam" />
                    <input type="time" name="btijd" placeholder="Begin tijd" />
                    <input type="time" name="etijd" placeholder="Eind tijd" />
                    <input type="date" name="datum" placeholder="dd/mm/yyyy"/>
                    <select name="doctor">
                      <option value="DHR A">Doctor 1</option>
                      <option value="MVR B">Doctor 2</option>
                      <option value="Assistent C">Assistent 1</option>
                    </select>
                    <input type="submit" value="Plan in"/>
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