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
  const date = new Date(dateToString);
  const options = { year: 'numeric', month: '2-digit', day: '2-digit' };
  return date.toLocaleDateString('de-DE', options);
}
</script>



<template>

    <BaseHeader/>

    <div class="outer-tweet-container">   
     
        <div class="grid" v-for="tweet in tweets" :key="tweet.id">
            <div class="inner-tweet-container">
              <div class="date">
                <p>Created: {{ formatDate(tweet.created_at) }}</p>
                <p>Updated: {{ formatDate(tweet.updated_at )}}</p>  
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


.outer-tweet-container{
    display: grid;
    grid-template-columns: 1fr minmax(300px, 2fr) 1fr;
    align-items: center;
    gap: 20px;
    }

    .grid {
      grid-column: 2;
    }

.inner-tweet-container {
  padding: 30px;
  background-color: white;
}




.date {

  text-align: right;
}

  button {
    color: antiquewhite;
    background-color: black;
    border-radius: 15px;
    width: 131px;
    height: 36px;
  }

</style>