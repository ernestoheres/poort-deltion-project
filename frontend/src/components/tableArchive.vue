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
            <td class="buttons-td">
              <a :href="'dashboard/user/' + user.id" title="Bekijk client" ><i class="fa-light fa-user fa-2xl" style="color: #d67513;"></i></a>
              <a :href="'dashboard/user/' + user.id" title="Bewerk client" ><i class="fa-solid fa-user-pen fa-2xl" style="color: #89baeb;"></i></a>
              <i class="fa-light fa-user-lock fa-2xl" style="color: #729B79;" title="Un-Archief client" ></i>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Pagination Controls -->
    <div class="pagination">
      <button @click="goToPage(1)"><i class="fa-solid fa-arrow-left-to-line"></i></button>
      <button @click="currentPage -= 1" :disabled="currentPage === 1"><i class="fa-solid fa-arrow-left"></i></button>
      
      <button v-for="page in totalPages" :key="page" @click="goToPage(page)" class="page-buttons-desktop" :class="{ 'current-page': currentPage === page }">
          {{ page }}
        </button>
      
      <button @click="currentPage += 1" :disabled="currentPage >= totalPages"><i class="fa-solid fa-arrow-right"></i></button>
      <button @click="goToPage(totalPages)"><i class="fa-solid fa-arrow-right-to-line"></i></button>
    </div>

    <!-- Page Buttons Mobile -->
    <div class="page-buttons-mobile">
        <button v-for="page in totalPages" :key="page" @click="goToPage(page)" :class="{ 'current-page': currentPage === page }">
          {{ page }}
        </button>
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
      perPage: 8,
      placeholderImage: '/public/placeholder.jpg',
    };
  },
  computed: {
    paginatedUsers() {
      const start = (this.currentPage - 1) * this.perPage;
      const end = start + this.perPage;
      return this.users.slice(start, end);
    },
    totalPages() {
      return Math.ceil(this.users.length / this.perPage);
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
      return user.isValidImage ? imageUrl : this.placeholderImage;
    },
    goToPage(page) {
      if (page >= 1 && page <= this.totalPages) {
        this.currentPage = page;
      }
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

.buttons-td a {
  margin-right: 8px;
}

#table-container {
  width: 100%;
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
  overflow: auto;
  max-height: calc(98vh - 80px);
  background-color: white;
  border: 1px solid lightgray;
  box-shadow: 0 0 5px 3px rgba(0,0,0,0.15);
  border-radius: 8px;
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

.pagination button, .page-buttons-mobile button {
    border: solid 2px lightgray;
    padding: 10px;
    border-radius: 8px;
    margin: 0 8px;
    font-size: 16px;
    cursor: pointer;
}
.page-buttons-mobile button.current-page, .pagination button.current-page {
  border-color: #2782DD;
}

.pagination {
  display: flex;
  width: 90%;
  justify-content: center;
  margin-top: 10px;
}

.pagination button.page-buttons-desktop {
  display: none;
}

.page-buttons-mobile {
  margin-top: 13px;
}

@media only screen and (min-width: 480px) {
  .pagination {
    justify-content: flex-end;
  }

  .pagination button.page-buttons-desktop {
    display: block;
  }

  .page-buttons-mobile {
  display: none;
}
}

</style>
