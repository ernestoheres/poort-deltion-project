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
      <component :is="currentComponent"></component>
      <div class="togglecomponent-container">
        <template v-if="currentComponent === 'UserInfoEdit'">
        </template>
        <template v-else>
          <span></span>
        </template>
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
}

#content {
  margin-top: 25px;
  max-width: calc(100vw - 75px);
  width: 100%;
  display: flex;
  flex-direction: column;
  align-items: center;
  overflow-y: auto; /* Enable vertical scrolling when content overflows */
  height: 100vh;
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
</style>