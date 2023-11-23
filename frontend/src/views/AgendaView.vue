<script setup>
import Sidebar from '../components/sidebar.vue'
import consultAdd from '../components/consultAdd.vue'

</script>

<template>
  <main>

    <Sidebar />
    <div id="content">
      <div class="past-consulten consulten-tab">
        <div class="consult-header">
            <h2>Geweeste consulten</h2>
        </div>
        <div class="consult-content">

        </div>
      </div>
      <div class="upcomming-consulten consulten-tab">
        <div class="consult-header">
            <h2>Toekomstige consulten</h2>
        </div>
        <div class="consult-content">

        </div>
      </div>
      <div class="plannen-consulten consulten-tab">
        <div class="consult-header">
            <h2>Consult inplannen</h2>
        </div>
        <div class="consult-content">
            <consultAdd></consultAdd>
        </div>
      </div>
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
    flex-direction: row;
    position: relative;
    flex-wrap: wrap;
    gap: 50px;
    align-content: center;
    justify-content: center;
}

.consulten-tab {
    width: 28%;
    height: 90vh;
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 0 15px rgba(0,0,0,0.3);
}

.consult-content {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;
}

.consult-header {
    border-bottom: 1px solid darkslategray;
    padding: 5px 15px 5px 15px;
}

.consult-header h2 {
    font-weight: bold;
}

</style>