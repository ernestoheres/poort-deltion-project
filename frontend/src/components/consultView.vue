<script>
    import axios from 'axios';

    export default {
        data() {
            return {
                consult: []
            };
        },
        mounted() {

            axios.get(`http://localhost:8000/api/consult`, {
                    headers: {
                        Authorization: `Bearer ${localStorage.getItem('token')}`
                    }
                })
                .then(response => {
                    this.consult = response.data;
                })
                .catch(error => {
                    console.error(error);
                });
        }
    };
</script>
<template>
    <tr v-for="consult in paginatedUsers" :key="consult.id" class="User-TR">
              <template v-if="isSmallScreen">
                <td><b style="font-weight: 700">Voornaam:</b> {{ consult.voornaam }}</td>
                <td><b style="font-weight: 700">tussenvoegels:</b> {{ consult.tussenvoegels }}</td>
                <td><b style="font-weight: 700">achternaam:</b> {{ consult.achternaam }}</td>
                <td><b style="font-weight: 700">Begintijd:</b> {{ consult.btijd }}</td>
                <td><b style="font-weight: 700">Eindtijd:</b> {{ consult.etijd }}</td>
                <td><b style="font-weight: 700">Datum:</b> {{ consult.datum }}</td>
                <td><b style="font-weight: 700">Doctor:</b> {{ consult.doctor }}</td>
              </template>
              <template v-else>
                <td>{{ consult.voornaam }}</td>
                <td>{{ consult.tussenvoegels }}</td>
                <td>{{ consult.achternaam }}</td>
                <td>{{ consult.btijd }}</td>
                <td>{{ consult.etijd }}</td>
                <td>{{ consult.datum }}</td>
                <td>{{ consult.doctor }}</td>
              </template>
    </tr>
    <div class="pagination">
        <button @click="goToPage(1)"><i class="fa-solid fa-arrow-left-to-line"></i></button>
        <button @click="currentPage -= 1" :disabled="currentPage === 1"><i class="fa-solid fa-arrow-left"></i></button>

        <button v-for="page in totalPages" :key="page" @click="goToPage(page)" class="page-buttons-desktop"
          :class="{ 'current-page': currentPage === page }">
          {{ page }}
        </button>

        <button @click="currentPage += 1" :disabled="currentPage >= totalPages"><i
            class="fa-solid fa-arrow-right"></i></button>
        <button @click="goToPage(totalPages)"><i class="fa-solid fa-arrow-right-to-line"></i></button>
      </div>
</template>