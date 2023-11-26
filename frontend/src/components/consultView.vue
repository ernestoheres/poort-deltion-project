<script>
    import axios from 'axios';

    export default {
        data() {
          return {
            consults: []
          }
        },
        mounted() {
            this.fetchConsults()
        },
        methods: {
          fetchConsults(){
            axios.get(`http://localhost:8000/api/agenda`, {
                    headers: {
                        Authorization: `Bearer ${localStorage.getItem('token')}`
                    }
                })
                .then(response => {
                    this.consults = response.data;
                })
                .catch(error => {
                    console.error(error);
          })
        }
      }
    };
</script>
<template>
  <div>Consults:</div>
  <tbody>
    <tr v-for="consult in consults">
      <td>
        {{ consult.id }}
      </td>
      <td>
        {{ consult.voornaam }}
      </td>
    </tr>
  </tbody>
</template>