<template>
  <div id="container">
    <form>
      <div id="client_tab" class="formDiv">
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
      <div id="tijd_tab" class="formDiv">
        <div>
            van:
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
      <div id="doctor_tab" class="formDiv">
        <tr>
          <td>
            Doctor:
          </td>
          <td>
            <select class="form-control" v-model="doctorselected" @change=selectDoctorChange>
                      <option disabled value="">Selecteer Doctor</option>
              <option v-for="doctor in doctors" :key="doctor.id" :value="doctor.id">
                {{ doctor.name }}
              </option>
            </select>
          </td>
        </tr>
      </div>
      <div id="button_tab" class="formDiv">
        <button> Plan Consult in! </button>
      </div>
    </form>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  data() {
    return {
      selectedClient: "",
      users: [], // Corrected the variable name here
      doctors: [],
    }
  },

  mounted() {
    const clientsRequest = axios.get('http://localhost:8000/api/clients', {
      headers: {
        Authorization: `Bearer ${localStorage.getItem('token')}`,
      },
    });

    const doctorsRequest = axios.get('http://localhost:8000/api/doctors', {
      headers: {
        Authorization: `Bearer ${localStorage.getItem('token')}`,
      },
    });

    Promise.all([clientsRequest, doctorsRequest])
      .then(responses => {
        // Handle response for clients
        this.users = responses[0].data;
        console.log(responses[0].data);
        // Handle response for doctors
        this.doctors = responses[1].data;
        console.log(responses[1].data);
      })
      .catch(error => {
        console.error(error);
      });
  },
  methods: {
    getSelected() {
      // Your logic for handling selected client
    }
    // Other methods
  }
};
</script>
<style>
  #container{
    width: calc(100%-12.5px);
    display: flex;
    flex-direction: column;
  }
  .formDiv {
    margin-bottom: 20px;
    padding: 20px;
    background-color: #f2f2f2;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }

  select.form-control,
  input[type="time"],
  input[type="date"],
  button {
    width: 100%;
    padding: 8px;
    margin-top: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
  }

  button {
    background-color: #4CAF50;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }

  button:hover {
    background-color: #45a049;
  }
</style>
