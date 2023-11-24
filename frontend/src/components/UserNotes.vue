<template>
  <div class="notes-section">
    <div class="popup" v-if="showNewNotePopup">
      <div class="popup-content">
        <label for="user-notes">Maak een notitie voor deze patient:</label>
        <textarea v-model="newNote" id="new-user-notes" class="popup-textarea"></textarea>
        <button class="popup-button" @click="addNote">Opslaan</button>
        <button class="popup-button" @click="closePopup">Annuleren</button>
      </div>
    </div>

    <div class="popup" v-if="showUpdateNotePopup">
      <div class="popup-content">
        <label for="update-user-notes">Bewerk de notitie:</label>
        <textarea v-model="updatedNote" id="update-user-notes" class="popup-textarea"></textarea>
        <button class="popup-button" @click="updateNote">Opslaan</button>
        <button class="popup-button" @click="closeUpdatePopup">Annuleren</button>
      </div>
    </div>

    <div class="combined-section" v-if="notes.length > 0">
      <h3>Notities:</h3>
        <div v-for="(note, index) in paginatedNotes" :key="index">
          <p>{{ note.content }}</p>
        </div>

        <div class="pagination">
          <button @click="showPreviousNote" :disabled="currentPage === 0 || notes.length === 0">Vorige Notitie</button>
          <button @click="showNextNote" :disabled="currentPage === totalPages - 1 || notes.length === 0">Volgende Notitie</button>
        </div>
    </div>

    <div v-else>
      <p>Er zijn nog geen notities</p>
    </div>

    <div class="button-group">
      <button class="button" @click="showNewNotePopup = true">Nieuwe Notitie</button>
      <button class="button" @click="showUpdateNotePopup = true" :disabled="!currentNote || notes.length === 0">Bewerk Notitie</button>
      <button class="button" @click="deleteNote" :disabled="!currentNote || notes.length === 0">Verwijder Notitie</button>
    </div>
  </div>


</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      user: [],
      newNote: '',
      updatedNote: '',
      notes: [],
      currentNote: null,
      showNewNotePopup: false,
      showUpdateNotePopup: false,
      currentPage: 1,
      perPage: 4, // Set the desired number of notes per page
    };
  },

  computed: {
    paginatedNotes() {
      const start = (this.currentPage - 1) * this.perPage;
      const end = start + this.perPage;
      return this.notes.slice(start, end);
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

        const url = `http://localhost:8000/api/clients/${this.user.id}/notes`;
        const response = await axios.post(url, {
          content: this.newNote,
          client_id: this.user.id,
        }, {
          headers: {
            Authorization: `Bearer ${localStorage.getItem('token')}`
          },
        });

        this.notes.push(response.data);
        this.currentNote = response.data;
        this.showNewNotePopup = false;
        this.newNote = '';

        console.log("this.newNote:", this.newNote);
      } catch (error) {
        console.error("Error adding note:", error);
      }
    },

    closePopup() {
      this.showNewNotePopup = false;
    },

    async updateNote() {
      try {
        const url = `http://localhost:8000/api/clients/${this.user.id}/notes/${this.currentNote.id}`;
        const response = await axios.put(url, {
          content: this.updatedNote,
        }, {
          headers: {
            Authorization: `Bearer ${localStorage.getItem('token')}`
          },
        });

        const index = this.notes.findIndex(note => note.id === this.currentNote.id);

        this.notes = Object.assign([], this.notes, { [index]: response.data });
        this.currentNote = response.data;
        this.showUpdateNotePopup = false;
        this.updatedNote = '';
      } catch (error) {
        console.error("Error updating note:", error);
      }
    },

    closeUpdatePopup() {
      this.showUpdateNotePopup = false;
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

    async deleteNote() {
      try {
        if (!this.user.id) {
          console.error("User ID not available.");
          return;
        }

        const url = `http://localhost:8000/api/clients/${this.user.id}/notes/${this.currentNote.id}`;

        await axios.delete(url, {
          headers: {
            Authorization: `Bearer ${localStorage.getItem('token')}`
          },
        });

        // Remove the deleted note from the notes array
        const index = this.notes.findIndex(note => note.id === this.currentNote.id);
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
.notes-section {
  display: flex;
  justify-content: space-between;
  width: 90%;
  padding-top: 15px;
}

.button:disabled {
  background-color: #d3d3d3; /* Grey background for disabled buttons */
  color: #808080; /* Grey text color for disabled buttons */
  cursor: not-allowed; /* Change cursor for disabled buttons */
}

.button{
  cursor: pointer;
  border: solid 2px lightgray;
  border-radius: 8px;
  font-size: 16px;
  width: 150px;
  padding: 5px;
  margin-bottom: 5px;
  margin-right: 5px;
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
}

.popup-content {
  background: #fff;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  max-width: 400px;
  width: 100%;
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

.combined-section {
  width: 100%;
  border: 1px solid #dcdcdc;
  padding: 8px;
  margin-bottom: 10px;
  box-shadow: 0 0px 10px 0 lightgray;
  border-radius: 8px;
  background-color: white;
}

.combined-section p {
  word-wrap: break-word; /* Add this line to enable word wrapping */
}

.combined-section label,
.combined-section h3 {
  display: block;
  width: 100%;
  margin-bottom: 10px;
}

.combined-section textarea {
  display: block;
  width: calc(100% - 20px);
}

.combined-section button {
  cursor: pointer;
  border: solid 2px lightgray;
  border-radius: 8px;
  font-size: 14px;
  width: 150px;
  padding: 5px;
  margin-right: 5px;
}

.combined-section textarea {
  height: 100px;
}
</style>
