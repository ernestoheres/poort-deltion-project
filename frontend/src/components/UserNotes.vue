<template>
  <div class="notes">
    <div class="popup" v-if="showNewNotePopup">
      <div class="popup-content">
        <label for="user-notes">Maak een notitie voor deze patient:</label>
        <textarea v-model="newNote" id="new-user-notes" class="popup-textarea"></textarea>
        <div class="popop-button">
          <button v-if="userRole === 'doctor'" class="button" @click="addNote"><i class="fa-solid fa-floppy-disk fa-lg"></i> Opslaan</button>
          <button class="button" @click="closePopup"><i class="fa-solid fa-rectangle-xmark fa-lg"></i> Annuleren</button>
        </div>
        <label for="admin-dropdown">Select Administrator:</label>
        <select v-model="selectedAdministrator" id="admin-dropdown">
          <option v-for="admin in administrators" :key="admin.id" :value="admin.id">{{ admin.name }}</option>
        </select>
      </div>
    </div>

    <div class="notes-section">
      <h3>Notities:</h3>
      <div class="notes-container" v-if="paginatedNotes.length > 0">
        <div class="note" v-for="(note, index) in paginatedNotes" :key="index" @click="openNotePopup(note)">
          <p>{{ note.content }}</p>
        </div>
        <div class="popup" v-if="showNotePopup">
          <div class="popup-content">
            <label for="note-content">Notitie:</label>
            <textarea v-model="selectedNote.content" id="update-note-content" class="popup-textarea"></textarea>
            <div class="popop-button">
              <button class="button" @click="async () => { await updateNote(); closeNotePopup(); }"><i class="fa-solid fa-floppy-disk fa-lg"></i> Opslaan</button>
              <button class="button" @click="async () => { await deleteNote(); closeNotePopup(); }"><i class="fa-solid fa-trash fa-lg"></i> Verwijderen</button>
              <button class="button" @click="closeNotePopup"><i class="fa-solid fa-rectangle-xmark fa-lg"></i> Sluiten</button>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="buttons-container">
      <div class="CRUD-group">
        <button class="button" @click="showNewNotePopup = true">Nieuwe Notitie</button>
      </div>

      <div class="pagination">
        <button class="P-button" @click="showFirstPage"><i class="fa-solid fa-arrow-left-to-line"></i></button>
        <button class="P-button" @click="showPreviousNote" :disabled="currentPage === 1"><i class="fa-solid fa-arrow-left"></i></button>
        <span>{{ currentPage }} / {{ totalPages }}</span>
        <button class="P-button" @click="showNextNote" :disabled="currentPage === totalPages"><i class="fa-solid fa-arrow-right"></i></button>
        <button class="P-button" @click="showLastPage"><i class="fa-solid fa-arrow-right-to-line"></i></button>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      user: [],
      userRole: '',
      newNote: '',
      updatedNote: '',
      notes: [],
      currentNote: null,
      showNewNotePopup: false,
      showUpdateNotePopup: false,
      showNotePopup: false,
      selectedNote: null,
      currentPage: 1,
      perPage: 4, // Kies hoeveel notes per keer
      administrators: [],
      selectedAdministrator: null,
    };
  },
  created() {
    this.userRole = localStorage.getItem('role');
    this.loadAdministrators(); // Add this line to fetch administrators
  },

  computed: {
    paginatedNotes() {
      const sortedNotes = this.notes.slice().sort((a, b) => b.timestamp - a.timestamp);
      const start = (this.currentPage - 1) * this.perPage;
      const end = start + this.perPage;
      return sortedNotes.slice(start, end);
    },
    totalPages() {
      return Math.ceil(this.notes.length / this.perPage);
    },
  },

  methods: {
    async addNote() {
      try {
        if (!this.user.id) {
          console.error(this.user.id);
          return;
        }
        console.log("this.newNote:", this.newNote, this.user.id);
        const url = `http://localhost:8000/api/clients/${this.user.id}/notes`;
        console.log("Request payload:", {
          content: this.newNote,
          client_id: this.user.id,
        });

        const response = await axios.post(url, {
          content: this.newNote,
          client_id: this.user.id,
          administrator_id: this.selectedAdministrator,
        }, {
          headers: {
            Authorization: `Bearer ${localStorage.getItem('token')}`
          },
        });

        this.notes.push(response.data);
        this.currentNote = response.data;
        this.showNewNotePopup = false;
        this.newNote = '';
        this.notes.unshift(response.data);

      } catch (error) {
        console.error("Error adding note:", error);
      }
    },

    closePopup() {
      this.showNewNotePopup = false;
    },

    openNotePopup(note) {
      this.selectedNote = note;
      this.showNotePopup = true;
    },

    closeNotePopup() {
      this.showNotePopup = false;
    },

    async updateNote() {
      try {
        const url = `http://localhost:8000/api/clients/${this.user.id}/notes/${this.selectedNote.id}`;
        const response = await axios.put(url, {
          content: this.selectedNote.content,
        }, {
          headers: {
            Authorization: `Bearer ${localStorage.getItem('token')}`
          },
        });

        const index = this.notes.findIndex(note => note.id === this.selectedNote.id);
        this.$set(this.notes, index, response.data);

        this.closeNotePopup();
      } catch (error) {
        console.error("Error updating note:", error);
      }
    },

    async loadNotes() {
      try {
        if (!this.user.id) {
          console.error("User ID not available.");
          return;
        }

        const url = `http://localhost:8000/api/clients/${this.user.id}/notes`;

        console.log("Requesting notes with user ID:", this.user.id);

        const response = await axios.get(url, {
        headers: {
          Authorization: `Bearer ${localStorage.getItem('token')}`
        },
      });

        console.log("Notes received:", response.data);

        this.notes = response.data;
      } catch (error) {
        console.error("Error fetching notes:", error);
      }
    },

    async loadAdministrators() {
      try {
        const url = 'http://localhost:8000/api/administrators';
        const response = await axios.get(url, {
          headers: {
            Authorization: `Bearer ${localStorage.getItem('token')}`
          },
        });
        this.administrators = response.data;
      } catch (error) {
        console.error("Error fetching administrators:", error);
      }
    },

    showPreviousNote() {
      if (this.currentPage > 1) {
        this.currentPage--;
      }
    },
    showNextNote() {
      if (this.currentPage < this.totalPages) {
        this.currentPage++;
      }
    },

    showFirstPage() {
      this.currentPage = 1;
    },

    showLastPage() {
      this.currentPage = this.totalPages;
    },

    async deleteNote() {
      try {
        if (!this.user.id) {
          console.error("User ID not available.");
          return;
        }

        const url = `http://localhost:8000/api/clients/${this.user.id}/notes/${this.selectedNote.id}`;

        await axios.delete(url, {
          headers: {
            Authorization: `Bearer ${localStorage.getItem('token')}`
          },
        });

        const index = this.notes.findIndex(note => note.id === this.selectedNote.id);
        if (index !== -1) {
          this.notes.splice(index, 1);
        }

        this.currentNote = null;
      } catch (error) {
        console.error("Error deleting note:", error);
      }
    },

  },

  watch: {
    '$route.params.id': 'loadNotes',
  },

  mounted() {
    const id = this.$route.params.id;
    axios.get(`http://localhost:8000/api/clients/${id}`, {
      headers: {
        Authorization: `Bearer ${localStorage.getItem('token')}`
      },
    })
        .then(response => {
          this.user = response.data;
          return this.loadNotes();
        })
        .catch(error => {
          console.error(error);
        })
        .finally(() => {
          if (this.notes.length > 0) {
            this.currentNote = this.notes[this.notes.length - 1];
          }
        });
  },
};

</script>

<style scoped>
.notes {
  display: flex;
  flex-direction: column;
  width: 90%;
  padding-top: 15px;
}

.notes-container {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
}

.note {
  flex-basis: calc(25% - 20px);
  box-sizing: border-box;
  border: 1px solid #dcdcdc;
  padding: 8px;
  margin-bottom: 10px;
  border-radius: 8px;
  background-color: white;
  width: calc(25% - 20px);
  cursor: pointer;
}

.note:nth-child(4n) {
  margin-right: 0;
}



.buttons-container {
  display: flex;
  justify-content: space-between;
  margin-top: 10px;
}

.button:disabled {
  background-color: #d3d3d3;
  color: #808080;
  cursor: default;
}

.button {
  cursor: pointer;
  border: solid 2px lightgray;
  border-radius: 8px;
  font-size: 16px;
  width: 150px;
  padding: 5px;
  margin: 1px;
}

.P-button {
  cursor: pointer;
  border: solid 2px lightgray;
  border-radius: 8px;
  font-size: 16px;
  padding: 5px;
  margin: 1px;
}

.P-button:disabled {
  background-color: #d3d3d3;
  color: #808080;
  cursor: default;
}

.pagination {
  text-align: right;
  margin-top: 10px;
}

.CRUD-group {
  text-align: left;
  margin-top: 10px;
  margin-bottom: 10px;
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
  width: 100px;
  padding: 5px;
  margin-right: 5px;
}

.notes-section {
  width: 100%;
  border: 1px solid #dcdcdc;
  padding: 8px;
  margin-bottom: 10px;
  box-shadow: 0 0px 10px 0 lightgray;
  border-radius: 8px;
  background-color: white;
}

.popop-button {
  display: flex;
  flex-wrap: wrap;
  gap: 25px;
  justify-content: space-between;
}

.fa-solid::before {
    font-weight: 900;
  }
</style>
