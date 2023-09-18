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

<style>
/* Table styling here */
</style>
