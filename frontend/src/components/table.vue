<template>
  <div>
    <h1>Vue Table Example</h1>
    <table>
      <!-- Table header here -->
      <tbody>
        <tr v-for="user in users" :key="user.id">
           <td>{{ user.voornaam }}</td>
           <td>{{ user.achternaam }}</td>
           <td>{{ user.adres }}</td>
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
    // Make a GET request to your backend API to fetch the data
    axios.get('http://localhost:8000/api/clients') // Replace with your backend API URL
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

table {
  border: 3px solid grey;
  box-shadow: 0 1px 1px rgba(0,0,0,0.15), 0 2px 2px rgba(0,0,0,0.15), 0 4px 4px rgba(0,0,0,0.15), 0 8px 8px rgba(0,0,0,0.15);
  border-radius: 20px;
}

tr {
  border: 3px solid grey;
}

</style>
