<template>
  <form>
    <div>
      <tr>
        <td>
          Client:
        </td>
        <td>
          <select class="form-control" v-model="selectedClient" @change="getSelected">
            <option disabled value="">Selecteer Client</option>
            <option v-for="user in users" :key="user.id" :value="user.id">
              {{ user.voornaam }} {{ user.tussenvoegsels }}{{ user.achternaam }}
            </option>
          </select>
        </td>
      </tr>
    </div>
    <div>
      <div>
          Tijd:
      </div>
      <tr>
        <td>
          <input type="time">
          <input type="date">
        </td>
      </tr>
      <div>
          tot:
      </div>
      <tr>
        <td>
          <input type="time">
          <input type="date">
        </td>
      </tr>
    </div>
    <div>
      <tr>
        <td>
          Doctor:
        </td>
        <td>
          <select class="form-control" v-model="doctorselected" @change=selectDoctorChange>
                    <option disabled value="">Selecteer Doctor</option>
                    <option value="Doctor 1">Doctor Maasveld</option>
                    <option value="Doctor 2">Doctor Roosland</option>
          </select>
        </td>
      </tr>
    </div>
    <div>
      <button> Plan Consult in! </button>
    </div>
  </form>
</template>

<script>
import axios from 'axios'

export default {
  data() {
    return {
      selectedClient: "",
      users: [], // Corrected the variable name here
    }
  },

  mounted() {
    axios.get('http://localhost:8000/api/clients', {
      headers: {
        Authorization: `Bearer ${localStorage.getItem('token')}`
      }
    })
    .then(response => {
      this.users = response.data;
      console.log(this.users);
    })
    .catch(error => {
      console.error(error);
    });
  },

  methods: {
    getSelected() {
      // Your logic for handling selected client
    },
    // Other methods
  }
};
</script>
