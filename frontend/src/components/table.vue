<template>
  <div id="table-container">
    <table>
      <tbody>
        <tr v-for="user in users" :key="user.id">
          <td> 
            <img :src="'http://127.0.0.1:8000/api/clients/' + user.id + '/image'" alt="User Image" class="user-image">
            {{ user.name }}
          </td>
          
          <tr>
           <td>{{ user.voornaam }} {{ user.achternaam }}</td>
          </tr>


          <tr>
           <td>{{ user.adres }}</td>
          </tr>

        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      users: []
    };
  },
  mounted() {
    axios.get('http://localhost:8000/api/clients')
      .then(response => {
        this.users = response.data;
      })
      .catch(error => {
        console.error(error);
      });
  }
};
</script>

<style scoped>

#table-container {
  width: 95vw;
  display: flex;
  flex-direction: column;
  align-items: center;
  flex-wrap: wrap;
}

table {
  border: 3px solid grey;
  box-shadow: 0 1px 1px rgba(0,0,0,0.15), 0 2px 2px rgba(0,0,0,0.15), 0 4px 4px rgba(0,0,0,0.15), 0 8px 8px rgba(0,0,0,0.15);
  border-radius: 20px;
  border-collapse: collapse;  

  width: 90%;
  margin-top: 25px;
}

td {
  
}

tr {
    height: 50px;
}

img {
  width: 110px;
  height: 110px;
}

</style>
