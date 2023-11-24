<script setup>
  import Sidebar from '../components/sidebar.vue'
  import UserInfo from '../components/UserProfile.vue'
  import UserInfoEdit from '../components/UserProfileEdit.vue'
  import UserNotes from '../components/UserNotes.vue'
</script>

<template>
  <main>
    <Sidebar />
    <div id="content">

      <div class="popup" v-if="showNewNotePopup">
        <div class="popup-content">
          <label for="user-notes">Maak een notitie voor deze patient:</label>
          <textarea v-model="newNote" id="new-user-notes" class="popup-textarea"></textarea>
          <button class="popup-button" @click="addNote">Opslaan</button>
          <button class="popup-button" @click="closePopup">Annuleren</button>
        </div>
      </div>

      <component :is="currentComponent"></component>
      <div class="togglecomponent-container">
        <template v-if="currentComponent === 'UserInfoEdit'">
        </template>
        <template v-else>
          <span></span>
        </template>
        <button class="togglecomponent-button" @click="showNewNotePopup = true" style="margin-right: 8px;">Account
          details</button>
        <button class="togglecomponent-button" @click="toggleComponent">{{ buttonText }}</button>
      </div>
      <UserNotes />
    </div>
  </main>
</template>

<script>
  export default {
    data() {
      return {
        currentComponent: this.isEditPage() ? 'UserInfoEdit' : 'UserInfo',
        showNewNotePopup: false,
      };
    },
    computed: {
      buttonText() {
        return this.currentComponent === 'UserInfo' ? 'Bewerk info' : 'Bekijk info';
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
</style>