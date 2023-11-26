<script setup>
  import Sidebar from '../components/sidebar.vue'
  import UserInfo from '../components/UserProfile.vue'
  import UserInfoEdit from '../components/UserProfileEdit.vue'
  import UserConsults from '../components/UserConsults.vue'
  import UserNotes from '../components/UserNotes.vue'
</script>

<template>
  <main>

    <div class="popup" v-if="AccountDetailsPopup">
      <div class="popup-content">
        <div class="popup-div-1">
          <label class="title">Account details:</label>
        </div>
        <form @submit.prevent="ChangeUserDetails($event)">
          <div class="popup-div-2">
            <tr>
              <th>Email:</th>
              <td> <input type="email" name="email" placeholder="mail@depoort.nl" /> </td>
            </tr>

            <tr>
              <th>Nieuw Wachtwoord:</th>
              <td> <input type="text" name="nieuw_wachtwoord" placeholder="Nieuw wachtwoord" /> </td>
            </tr>

            <tr>
              <th>Oud Wachtwoord:</th>
              <td> <input type="text" name="oud_wachtwoord" placeholder="Oud wachtwoord" required /> </td>
            </tr>

            <tr class="pdf-button-div" v-if="shouldShowPDFbutton">
              <button type="button" class="popup-button pdf-button" @click="exportToPDF"><i
                  class="fa-solid fa-file-pdf fa-lg"></i> Maak een
                PDF bestand met al mijn gegevens</button>
            </tr>
          </div>

          <div class="popup-div-3">
            <button type="submit" class="popup-button"><i class="fa-solid fa-floppy-disk fa-lg"></i>
              Opslaan</button>
            <button type="button" class="popup-button" @click="closePopup"><i
                class="fa-solid fa-rectangle-xmark fa-lg"></i>
              Sluiten</button>
          </div>
        </form>
      </div>
    </div>

    <div id="pdf-content-container" v-if="shouldShowNotes">
      <div id="element-to-convert">
        <h1>Gegevens van {{ user.voornaam }} {{ user.tussenvoegels }} {{ user.achternaam }}</h1>

        <h2>Algemene informatie</h2>
        <div class="Data">
          <tr>
            <th>Voornaam:</th>
            <td> {{ user.voornaam }} </td>
          </tr>

          <tr>
            <th>tussenvoegels:</th>
            <td> {{ user.tussenvoegels }} </td>
          </tr>

          <tr>
            <th>achternaam:</th>
            <td> {{ user.achternaam }} </td>
          </tr>

          <tr>
            <th>Tel:</th>
            <td> {{ user.telefoon }} </td>
          </tr>

          <tr>
            <th>Geboortedatum:</th>
            <td> {{ user.geboortedatum }} </td>
          </tr>

          <tr>
            <th>Gender:</th>
            <td> {{ user.geslacht }}</td>
          </tr>

          <tr>
            <th>Bloedtype:</th>
            <td> {{ user.bloedtype }}</td>
          </tr>

          <tr>
            <th>Adres:</th>
            <td> {{ user.adres }}</td>
          </tr>

          <tr>
            <th>Postcode:</th>
            <td> {{ user.postcode }}</td>
          </tr>

          <tr>
            <th>Woonplaats:</th>
            <td> {{ user.woonplaats }}</td>
          </tr>

          <tr>
            <th>Land:</th>
            <td> {{ user.land }}</td>
          </tr>

          <tr>
            <th>BSN:</th>
            <td> {{ user.bsn }} </td>
          </tr>

          <tr>
            <th>Polisnummer:</th>
            <td> {{ user.polisnummer }} </td>
          </tr>

          <tr>
            <th>Verzekering:</th>
            <td> {{ user.vezekering }} </td>
          </tr>

        </div>
        <h2>consults</h2>
        <p>Hier moeten alle consults staan die al zijn geweest en nog komen</p>


        <h2>consult notities</h2>
        <ul>
          <li v-for="(note, index) in notes" :key="index" class="consult-notities-li">
            <div>
              <strong>Consult notitie:</strong>{{ note.content }}
            </div>
            <div>
              <strong>Gemaakt op: </strong>{{ formatDate(note.created_at) }}
            </div>
            <div>
              <strong>Bewerkt op: </strong>{{ formatDate(note.updated_at) }}
            </div>
          </li>
        </ul>
      </div>
    </div>


    <Sidebar />
    <div id="content">

      <component :is="currentComponent"></component>
      <div class="togglecomponent-container">
        <template v-if="currentComponent === 'UserInfoEdit'">
        </template>
        <template v-else>
          <span></span>
        </template>
        <button class="togglecomponent-button" @click="AccountDetailsPopup = true" v-if="shouldShowDetailsButton"
          style="margin-right: 8px;">Account
          details</button>
        <button class="togglecomponent-button" @click="toggleComponent">{{ buttonText }}</button>
      </div>

      <UserConsults />

      <UserNotes v-if="shouldShowNotes" />
    </div>
  </main>
</template>

<script>
  import axios from 'axios';
  import html2pdf from "html2pdf.js";

  export default {
    data() {
      return {
        currentComponent: this.isEditPage() ? 'UserInfoEdit' : 'UserInfo',
        AccountDetailsPopup: false,
        user: {},
        notes: [],
        nieuw_wachtwoord: '', // New password
        oud_wachtwoord: '', // Old password
        errorMessage: '', // Error message for the form
      };
    },
    mounted() {
      const id = this.$route.params.id;
      axios.get(`http://localhost:8000/api/clients/${id}`, {
          headers: {
            Authorization: `Bearer ${localStorage.getItem('token')}`
          }
        })
        .then(response => {
          this.user = response.data;
          return this.loadNotes();
        })
        .catch(error => {
          console.error(error);
        });
    },
    computed: {
      buttonText() {
        return this.currentComponent === 'UserInfo' ? 'Bewerk info' : 'Bekijk info';
      },
      shouldShowNotes() {
        const role = localStorage.getItem('role');
        return role == 'doctor' || role == 'client';
      },
      shouldShowPDFbutton() {
        const role = localStorage.getItem('role');
        return role == 'client';
      },
      shouldShowDetailsButton() {
        const role = localStorage.getItem('role');
        return role == 'client';
      },
    },
    components: {
      UserInfo,
      UserInfoEdit,
    },
    methods: {
      toggleComponent() {
        this.currentComponent = this.currentComponent === 'UserInfo' ? 'UserInfoEdit' : 'UserInfo';
      },
      isEditPage() {
        // Check if the URL parameter "edit" is set to "true"
        const urlParams = new URLSearchParams(window.location.search);
        return urlParams.get('edit') === 'true';
      },

      closePopup() {
        this.AccountDetailsPopup = false;
      },

      async ChangeUserDetails(event) {
        event.preventDefault(); // Prevent the default form submission behavior

        try {
          const formData = new FormData(event.target);

          const oldEmail = localStorage.getItem('email');
          const newEmail = formData.get('email').trim();
          const oldPassword = formData.get('oud_wachtwoord').trim();
          const newPassword = formData.get('nieuw_wachtwoord').trim();

          if (newEmail && newEmail !== oldEmail) {
            // Your code for changing email

            axios.post('http://localhost:8000/api/change-email', {
                  password: oldPassword,
                  new_email: newEmail,
                }, {
                  headers: {
                    Authorization: `Bearer ${localStorage.getItem('token')}`,
                  },
                })
                .then((response) => {
                  // console.log(response);
                })
                .catch((error) => {
                  this.showError(error);
                });
          }

          if (newPassword) {
            if (!newEmail || newEmail == oldEmail) {
              // Your code for changing password when email hasn't changed

              axios.post('http://localhost:8000/api/change-password', {
                  old_password: oldPassword,
                  new_password: newPassword,
                }, {
                  headers: {
                    Authorization: `Bearer ${localStorage.getItem('token')}`,
                  },
                })
                .then((response) => {
                  // console.log(response);
                })
                .catch((error) => {
                  this.showError(error);
                });

            } else {
              await new Promise(resolve => setTimeout(resolve,
              500)); // waits so the password doesnt get changed while still needing the password for changing the email

              // Your code for changing password when email has changed

              axios.post('http://localhost:8000/api/change-password', {
                  old_password: oldPassword,
                  new_password: newPassword,
                }, {
                  headers: {
                    Authorization: `Bearer ${localStorage.getItem('token')}`,
                  },
                })
                .then((response) => {
                  // console.log(response);
                })
                .catch((error) => {
                  this.showError(error);
                });
            }
          }

          // Reset input fields after successful changes
          event.target.reset();
          this.AccountDetailsPopup = false;
        } catch (error) {
          // Set error message on failure
          this.errorMessage = 'Failed to update user details. Please try again.';
          console.error("Error updating details:", error);
        }
      },

      exportToPDF() {
        const userRole = localStorage.getItem('role');
        const storedUserId = localStorage.getItem('userid');
        // console.log('userRole:', userRole);
        // console.log('this user:', this.user);
        // console.log('this user id:', this.user.id);
        // console.log('storedUserId:', storedUserId);

        if (userRole == 'client' && this.user.id == storedUserId) {
          const fileName =
            `gegevens De Poort - ${this.user.voornaam} ${this.user.tussenvoegels} ${this.user.achternaam}.pdf`;
          html2pdf(document.getElementById('element-to-convert'), {
            filename: fileName,
          });
        } else {
          console.log('Insufficient permissions to export PDF.');
        }
      },

      async loadNotes() {
        try {
          if (!this.user.id) {
            console.error("User ID not available.");
            return;
          }

          const url = `http://localhost:8000/api/clients/${this.user.id}/notes`;

          // console.log("Requesting notes with user ID 2:", this.user.id);

          const response = await axios.get(url, {
            headers: {
              Authorization: `Bearer ${localStorage.getItem('token')}`
            },
          });

          // console.log("Notes received 2:", response.data);

          this.notes = response.data;
        } catch (error) {
          console.error("Error fetching notes:", error);
        }
      },

      async loadAgenda() {
        try {
          if (!this.user.id) {
            console.error("User ID not available.");
            return;
          }

          const url = `http://localhost:8000/api/agenda`;

          // console.log("Requesting notes with user ID 2:", this.user.id);

          const response = await axios.get(url, {
            headers: {
              Authorization: `Bearer ${localStorage.getItem('token')}`
            },
          });

          // console.log("Notes received 2:", response.data);

          this.notes = response.data;
        } catch (error) {
          console.error("Error fetching notes:", error);
        }
      },

      formatDate(timestamp) {
        const date = new Date(timestamp);
        const options = {
          day: 'numeric',
          month: 'long',
          year: 'numeric'
        };
        return date.toLocaleDateString('en-US', options);
      },

    },
  };
</script>

<style scoped>
  main {
    top: 0;
    min-height: 100vh;
    display: flex;
    width: 100vw;
    overflow-y: auto;
    /* Enable vertical scrolling when content overflows */
    height: 100vh;
  }

  #content {
    margin-top: 25px;
    max-width: calc(100vw - 75px);
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  #pdf-content-container {
    display: none;
  }

  .togglecomponent-container {
    width: 90%;
    display: flex;
    justify-content: flex-end;
    flex-wrap: nowrap;
    flex-direction: row;
    align-items: center;
    margin-top: 10px;
  }

  .togglecomponent-button {
    cursor: pointer;
    border: solid 2px lightgray;
    border-radius: 8px;
    font-size: 16px;
    width: 125px;
    padding: 5px;
  }

  .subitform-button {
    cursor: pointer;
    border: solid 2px lightgray;
    border-radius: 8px;
    font-size: 16px;
    width: 125px;
    padding: 5px;
  }

  .fa-solid::before {
    font-weight: 900;
  }

  .popup {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9;
  }

  .popup-content {
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px 6px rgba(0, 0, 0, 0.2);
    width: 100%;
    max-width: 600px;
    margin: 0 25px;
    border: 3px solid #89BAEB;
  }

  .popup-textarea {
    width: 100%;
    height: 300px;
  }

  .popup-button {
    cursor: pointer;
    border: solid 2px lightgray;
    border-radius: 8px;
    font-size: 14px;
    min-width: 100px;
    padding: 5px;
    margin-right: 5px;
  }

  .popup .title {
    font-weight: 600;
    font-size: 18px;
    margin-bottom: 16px;
  }

  .popup input {
    cursor: text;
    border: solid 2px lightgray;
    border-radius: 8px;
    font-size: 16px;
    margin-bottom: 5px;
    width: 100%;
  }

  .popup th {
    text-align: left;
  }

  .popup td {
    text-align: right;
  }

  .popup tr {
    display: flex;
    max-width: 400px;
    justify-content: space-between;
    flex-wrap: wrap;
  }

  .popup-div-1 {
    margin-bottom: 3em;
  }

  .popup-div-3 {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
    justify-content: space-between;
    margin-top: 4em;
  }

  .pdf-button-div {
    margin-top: 1em;
  }

  .Data tr th {
    font-weight: 700;
    text-align: left;
  }

  .data td {
    text-align: left;
  }

  .data th {
    font-weight: 700 !important;
    text-align: left !important;
  }

  #element-to-convert h2 {
    margin-top: 16px;
  }

  .consult-notities-li {
    margin-bottom: 13px;
  }
</style>