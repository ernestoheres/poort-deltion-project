<template>
  <div id="table-container">
    <div class="table-border">
      <table>
        <tbody>
          <tr v-for="user in users" :key="user.id" class="User-TR">
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
  width: 100%;
  border-collapse: collapse;
}

.table-border {
  border: 1px solid lightgray;
  box-shadow: 0 0 5px 3px rgba(0,0,0,0.15);
  border-radius: 15px;
  padding: 10px 0; 
  width: 90%;
}

td {
  
}

.User-TR {
  padding: 0 10px;
  border-bottom: 1px solid lightgray;
}

.User-TR:last-child {
  border-bottom: none;
}

tr {
    height: 50px;
}

img {
  margin-top: 8px;
  border-radius: 100%;
  width: 75px;
  height: 75px;
  margin-left: 25px;
}

</style>
