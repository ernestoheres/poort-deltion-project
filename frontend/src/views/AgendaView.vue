<script setup>
import Sidebar from '../components/sidebar.vue'
import consultAdd from '../components/consultAdd.vue'
import consultView from '../components/consultView.vue'
</script>

<template>
  <main>

    <Sidebar />
    <div id="content">
      <div id="Mobile-div">
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
          <consultView></consultView>
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
    </div>

  </main>
</template>

<style scoped>
main {
    top: 0;
    min-height: 100vh;
    display: flex;
    width: 100vw;
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
#Mobile-div{
  margin: 25px;
}
@media screen and (max-width: 1100px) {
  #content{
    flex-direction: column;
  }
  #upcomming-consulten{
    max-height: 250px;
  }
  #past-consulten{
    max-height: 250px;
  }
  #plannen-consulten{
    height: 400px;
    max-height: 400px;
  }
  #Mobile-div{
    width: 100%;
    height: 100vh;
  }
  .consulten-tab{
    margin-top: 15px;
    width: 75%;
    height: fit-content;
    max-height: 350px;
    padding-bottom: 10px;
  }
}
</style>