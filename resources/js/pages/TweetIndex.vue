<script setup>

import BaseHeader from '../components/BaseHeader.vue';


//hier wird das objekt einfach aus einer 
//Datei exportiert um in eine andere datei zu importieren
import { ref, onMounted } from 'vue'; // Importiere ref und onMounted aus dem Vue-Paket


    // Verwende ref, um eine reaktive Variable zu erstellen
    const tweets = ref([]);

    // Verwende onMounted, um Code auszuführen, nachdem die Komponente montiert wurde
    onMounted(async () => {
      try {
        const response = await axios.get("/api/tweets");
        // Aktualisiere den Wert von tweets mit den Daten aus der API-Antwort
        tweets.value = response.data;
      } catch (error) {
        // Fehlerbehandlung
        console.error(error);
      }
    });



</script>



<template>

    <BaseHeader/>

    <div class="outer-tweet-container">   
        <ul>
        <li v-for="tweet in tweets" :key="tweet.id">
            <div class="inner-tweet-container">
                <h2>{{ tweet.title }}</h2>
                <p>{{ tweet.tweet }}</p>
                <p>Erstellt am: {{ tweet.created_at }}</p>
                <p>Aktualisiert am: {{ tweet.updated_at }}</p>
        </div>
        </li>
        </ul>
    </div>


</template>





<style scoped>

.inner-tweet-container{
    background-color: beige;
    padding-bottom: 15px;
}

</style>