<template>
  <form>
    <div>
      <tr>
        <td>
          Client:
        </td>
        <td>
          <input list="browser">
          <datalist id="browser">
            <option value="1"></option>
            <option value="2"></option>
            <option value="3"></option>
          </datalist>
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
          <select v-model="selected.user">
            <option v-for="user in users" :key="user.id" value="user.id">{{ user.voornaam }} {{user.id}}</option>
          </select>
          <div>selectedClient: {{ selected.user }}</div>
        </td>
      </tr>
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
    };
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