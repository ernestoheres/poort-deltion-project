<script setup>
  import Table from '../components/tableArchive.vue'
  import Sidebar from '../components/sidebar.vue'
</script>

<template>
  <main>

    <Sidebar />

    <div id="content">
      <div class="privacy-policy">
        <h1>Privacyverklaring</h1>
        <p>
          Bij De Poort, onze huisartsenpraktijk, nemen we de privacy en
          bescherming van persoonlijke gegevens uiterst serieus. Deze
          privacyverklaring beschrijft welke informatie we verzamelen, hoe we deze
          gebruiken en beschermen, en welke rechten je hebt met betrekking tot je
          persoonlijke gegevens.
        </p>

        <h2>Welke informatie verzamelen we?</h2>
        <p>
          We verzamelen en verwerken de volgende persoonlijke gegevens wanneer je
          gebruikmaakt van onze diensten:
        </p>
        <ul>
          <li>Naam</li>
          <li>Adresgegevens</li>
          <li>Telefoonnummer</li>
          <li>E-mailadres</li>
          <li>Geboortedatum</li>
          <li>Geslacht</li>
          <li>BSN-nummer</li>
          <li>Verzekeringsgegevens</li>
          <li>Medische informatie (bijv. bloedtype)</li>
        </ul>

        <h2>Waarom verzamelen we deze informatie?</h2>
        <p>
          Deze gegevens worden verzameld om adequate medische zorg te bieden,
          afspraken te plannen, en voor administratieve doeleinden. De gegevens
          worden vertrouwelijk behandeld en uitsluitend gebruikt binnen onze
          praktijk.
        </p>

        <h2>Hoe gebruiken we cookies?</h2>
        <p>
          Wij maken gebruik van JavaScript LocalStorage in plaats van traditionele cookies. Deze gegevens worden direct verwijderd op het moment dat je uitlogt van je account. De opgeslagen informatie omvat jouw unieke gebruikers inlogtoken, jouw rol en jouw account-ID. Ze zijn essentieel voor het correct functioneren van de website en worden niet gebruikt voor marketingdoeleinden.
        </p>

        <h2>Hoe beschermen we jouw gegevens?</h2>
        <p>
          We hanteren strikte veiligheidsmaatregelen om jouw gegevens te
          beschermen tegen ongeoorloofde toegang, verlies, of diefstal. We delen
          je gegevens niet met derden, tenzij wettelijk vereist.
        </p>

        <h2>Jouw rechten</h2>
        <p>
          Je hebt het recht om jouw persoonlijke gegevens in te zien, te corrigeren
          of te verwijderen. Daarnaast kun je bezwaar maken tegen de verwerking
          van jouw gegevens.
        </p>

        <h2>Contact</h2>
        <p>
          Heb je vragen of opmerkingen over onze privacyverklaring, of wil je jouw gegevens wijzigen of verwijderen? Neem dan contact met ons op via <a href="mailto:gegevens@FAKE-DePoort.nl">gegevens@DePoort.nl</a>.
        </p>

        <p>
          Deze privacyverklaring kan van tijd tot tijd worden bijgewerkt om te voldoen aan veranderende wettelijke vereisten of om ons privacybeleid aan te passen. We raden je aan om regelmatig de verklaring te controleren op eventuele wijzigingen.
        </p>

        <br><br>

        <p>
          Datum van laatste bijwerking: 22 november 2023
        </p>
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
  }

  #content {
    max-width: calc(100vw - 75px);
    width: 100%;
    display: flex;
    flex-direction: column;
    overflow-y: auto;
    height: 100vh;
  }

  .privacy-policy {
    margin-left: 1em;
    margin-top: 25px;
    margin-bottom: 25px;
  }

  .privacy-policy h2 {
    margin-top: 1em;
  }
</style>