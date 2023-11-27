<template>
  <form>
    <div>
      <tr>
        <td>
          Client:
        </td>
        <td>
          <select class="form-control" v-model="selected" @change=getSelected>
                    <option disabled value="">Selecteer Client</option>
                    <option v-for="user in this.user" v-bind:value="user.id">{{ user.voornaam }}</option>
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
      users: []
    }
  },

  mounted() {
    axios.get('http://localhost:8000/api/clients', {
          headers: {
            Authorization: `Bearer ${localStorage.getItem('token')}`
        }
      })
      .then(response => {
        this.user = response.data;
        console.log(this.user)
      })
      .catch(error => {
        console.error(error);
      });
  }
};
</script>