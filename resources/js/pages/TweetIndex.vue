<script setup>

import BaseHeader from '../components/BaseHeader.vue';
import BaseFooter from '../components/BaseFooter.vue';
import { useRouter } from 'vue-router'; // Importiere useRouter
import axios from 'axios';
import { ref, onBeforeMount } from 'vue';

// Verwende useRouter, um den Router zu erhalten
const router = useRouter();

// Verwende ref, um eine reaktive Variable (erkennt Veränderung->reagiert drauf) zu erstellen
const tweets = ref([]);
const nextPageUrl = ref(null);
const prevPageUrl = ref(null);


onBeforeMount(() => {
  loadPage('/api');
});


const loadPage = async (url) => {
    try {
        const response = await axios.get(url);
        tweets.value = response.data.data;
        nextPageUrl.value = response.data.next_page_url;
        prevPageUrl.value = response.data.prev_page_url;
    } catch (error) {
        console.error(error);
    }
};


const goToNextPage = async () => {
    await loadPage(nextPageUrl.value);
};

const goToPrevPage = async () => {
    await loadPage(prevPageUrl.value);
};




const formatDate = (dateToString) => {
  const date = new Date(dateToString);
  const options = { year: 'numeric', month: '2-digit', day: '2-digit' };
  return date.toLocaleDateString('de-DE', options);
}

// Funktion zum Sortieren der Tweets nach dem neuesten Datum
const sortByNewest = () => {
    tweets.value.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));
};

// Funktion zum Sortieren der Tweets nach dem ältesten Datum
const sortByOldest = () => {
    tweets.value.sort((a, b) => new Date(a.created_at) - new Date(b.created_at));
};
</script>



<template>

    <BaseHeader/>

    <div class="outer-tweet-container">   
     
      <div class="sort-buttons">
            <button @click="sortByNewest">Newest Tweets</button>
            <button @click="sortByOldest">Oldest Tweets</button>
        </div>

        <div class="grid" v-for="tweet in tweets" :key="tweet.id">
            <div class="inner-tweet-container">
              <div class="date">
                <p>Created: {{ formatDate(tweet.created_at) }}</p>
                <p>Updated: {{ formatDate(tweet.updated_at )}}</p>  
              </div>
              
              
                <h2>{{ tweet.title }}</h2>
                <p>{{ tweet.tweet }}</p>

                <router-link :to="{name:'TweetShow', params: {id: tweet.id}}">
                <button>Show Tweet</button>
              </router-link>
            </div>
          </div>
          <div>
            <button @click="goToPrevPage" :disabled="!prevPageUrl">Previous</button>
            <button @click="goToNextPage" :disabled="!nextPageUrl">Next</button>
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

  button:disabled{
    opacity: 0.5;
  }

.sort-buttons {
  display: flex;
  justify-content: space-between;
}

</style>