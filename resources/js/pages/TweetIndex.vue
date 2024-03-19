<script setup>

import BaseHeader from '../components/BaseHeader.vue';
import BaseFooter from '../components/BaseFooter.vue';
import { useRouter } from 'vue-router'; // Importiere useRouter
import axios from 'axios';
import { ref, onMounted } from 'vue';

// Verwende useRouter, um den Router zu erhalten
const router = useRouter();

// Verwende ref, um eine reaktive Variable zu erstellen
const tweets = ref([]);

// Verwende onMounted, um Code auszuführen, nachdem die Komponente montiert wurde
onMounted(async () => {
  try {
    const response = await axios.get("/api/");
    // Aktualisiere den Wert von tweets mit den Daten aus der API-Antwort
    tweets.value = response.data.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));
  } catch (error) {
    // Fehlerbehandlung
    console.error(error);
  }
});

const showTweet = (tweetID) => {
    // Navigiere zur TweetShow-Seite und übergebe die Tweet-ID
    router.push('/tweets/singletweets',{ name: 'TweetShow', params: { id: tweetID } });
};

const formatDate = (dateToString) => {
  const date = new Date (dateToString);

  return date.toLocaleString ('en-DE');
}
</script>



<template>

    <BaseHeader/>

    <div class="outer-tweet-container">   
     
        <div v-for="tweet in tweets" :key="tweet.id">
            <div class="inner-tweet-container">
              <div class="date">
                <p>Erstellt am: {{ formatDate(tweet.created_at) }}</p>
                <p>Aktualisiert am: {{ formatDate(tweet.updated_at )}}</p>  
              </div>
              
                <h2>{{ tweet.title }}</h2>
                <p>{{ tweet.tweet }}</p>

                <router-link :to="{name:'TweetShow', params: {id: tweet.id}}">
                <button @click="showTweet(tweet.id)">Show Tweet</button>
              </router-link>
            </div>
          </div>
     
    </div>

    <BaseFooter/>

</template>





<style scoped>


.inner-tweet-container{
    display: flex;
    flex-direction: column;
    background-color: white;
    }

  .inner-tweet-container {
    margin: 15px;
  }

.date {
  display: flex;
  flex-direction: column;
  text-align: right;
}

  button {
    color: antiquewhite;
    background-color: black;
    border-radius: 15px;
  }

</style>