<template>
  <div id="table-container">
    <div class="table-border">
      <table>
        <thead>
          <tr>
            <th>Foto</th>
            <th>Voornaam</th>
            <th>Tussenvoegels</th>
            <th>Achternaam</th>
            <th>Adres</th>
            <th>Woonplaats</th>
            <th>Bekijk meer</th>
          </tr>
        </thead>

        <tbody>
          <tr v-for="user in paginatedUsers" :key="user.id" class="User-TR">
            <td>
              <img :src="userImageUrl(user)" alt="User Image" class="user-image">
            </td>

            <td>{{ user.voornaam }}</td>
            <td>{{ user.tussenvoegels }}</td>
            <td>{{ user.achternaam }}</td>
            <td>{{ user.adres }}</td>
            <td>{{ user.woonplaats }}</td>
            <td><i class="fa-light fa-id-badge fa-2xl" style="color: #89baeb;"></i></td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Pagination Controls -->
    <div class="pagination">
      <button @click="currentPage -= 1" :disabled="currentPage === 1">Previous</button>
      <span>Page {{ currentPage }}</span>
      <button @click="currentPage += 1" :disabled="currentPage * perPage >= users.length">Next</button>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      users: [],
      currentPage: 1,
      perPage: 5,
    };
  },
  computed: {
    paginatedUsers() {
      const start = (this.currentPage - 1) * this.perPage;
      const end = start + this.perPage;
      return this.users.slice(start, end);
    },
  },
  methods: {
    userImageUrl(user) {
      const imageUrl = `http://127.0.0.1:8000/api/clients/${user.id}/image`;
      const image = new Image();
      image.src = imageUrl;

      // Check if the image is valid by adding an event listener
      image.onload = () => {
        // If the image is valid, set the source to the user's image URL
        user.isValidImage = true;
      };

      // If the image fails to load (e.g., 404 or invalid image), show the placeholder
      image.onerror = () => {
        user.isValidImage = false;
      };

      // Return the image URL or the placeholder based on validity
      return user.isValidImage ? imageUrl : '/public/placeholder.jpg';
    },
  },
  mounted() {
    axios.get('http://localhost:8000/api/clients')
      .then(response => {
        this.users = response.data;
      })
      .catch(error => {
        console.error(error);
      });
  },
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
  text-align: left;
}

.table-border {
  border: 1px solid lightgray;
  box-shadow: 0 0 5px 3px rgba(0,0,0,0.15);
  border-radius: 15px;
  padding: 10px 0; 
  width: 90%;
  margin-top: 25px;
}

thead {
  border-bottom: solid 1px gray;
}

thead tr th {
  font-weight: 700;
}

thead tr th:first-of-type {
  padding-left: 35px;
}

thead tr th:last-of-type {
  text-align: center;
}

tbody tr td:last-of-type {
  text-align: center;
  cursor: pointer;
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
