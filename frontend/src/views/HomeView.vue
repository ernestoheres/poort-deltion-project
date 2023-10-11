<script setup>
import Table from '../components/table.vue'
import Header from '../components/header.vue'
import Sidebar from '../components/sidebar.vue'
import UserInfo from '../components/UserProfile.vue'
</script>

<template>
  <main>

    <Sidebar />
    <div id="content">
      <Header />
      <UserInfo />
      <!-- <Table /> -->
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