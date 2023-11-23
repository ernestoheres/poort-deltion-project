<script setup>
import Sidebar from '../components/sidebar.vue'
import ClientAdd from '../components/UserAdd.vue'
</script>

<template>
  <main>
    <Sidebar />
    <div id="content">
      <ClientAdd></ClientAdd>

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
  margin-top: 25px;
  width: calc(100vw - 75px);
  display: flex;
  flex-direction: column;
  align-items: center;
  overflow-y: auto; /* Enable vertical scrolling when content overflows */
  height: 100vh;
}

.submitform-container {
  width: 90%;
  display: flex;
  justify-content: flex-end;
  flex-wrap: nowrap;
  flex-direction: row;
  align-items: center;
  margin-top: 10px;
}

.subitform-button {
  cursor: pointer;
  border: solid 2px lightgray;
  border-radius: 8px;
  font-size: 16px;
  width: 175px;
  padding: 5px;
}
</style>