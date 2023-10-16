<script setup>
import Sidebar from '../components/sidebar.vue'
import UserInfo from '../components/UserProfile.vue'
import UserNotes from '../components/UserNotes.vue'
</script>

<template>
  <main>

    <Sidebar />
    <div id="content">
      <UserInfo />
      <UserNotes />
    </div>

  </main>
</template>

<style scoped>
main {
    top: 0;
    min-height: 100vh;
    display: flex;
}

#content {
  width: calc(100vw - 75px);
  display: flex;
  flex-direction: column;
}
</style>