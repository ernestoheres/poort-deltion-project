<script setup>
import Table from '../components/table.vue'
import Sidebar from '../components/sidebar.vue'
</script>

<template>
  <main>

    <Sidebar />
    <div id="content">
      <Table />
    </div>

  </main>
</template>

<style scoped>
main {
    top: 0;
    min-height: 100vh;
    display: flex;
    width: 100vw;
    overflow-y: auto; /* Enable vertical scrolling when content overflows */
    height: 100vh;
}

#content {
  max-width: calc(100vw - 75px);
  width: 100%;
  display: flex;
  flex-direction: column;
}
</style>