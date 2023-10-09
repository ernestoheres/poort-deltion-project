<script setup>
import Table from '../components/table.vue'
import Header from '../components/header.vue'
import Sidebar from '../components/sidebar.vue'
import UserInfo from '../components/UserProfile.vue'
</script>

<template>
  <main>

    <Header />

    <div id="content">
      <Sidebar />
      <!-- <UserInfo /> -->
      <Table />
    </div>

  </main>
</template>

<style scoped>
main {
    top: 0;
    position: fixed;
    min-height: 100vh;
}

#content {
  display: flex;
}
</style>