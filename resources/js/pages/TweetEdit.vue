<script setup>
import BaseHeader from '../components/BaseHeader.vue';
import BaseFooter from '../components/BaseFooter.vue';  
import { ref, onMounted } from 'vue';
import axios from 'axios';
import { useRouter } from 'vue-router';

const router = useRouter();
const editedTweet = ref({ title: '', tweet: '' }); 
const errors = ref({});

// Funktion zum Laden des zu bearbeitenden Tweets
const loadTweet = async () => {
  const tweetId = router.currentRoute.value.params.id; //Hier hole ich die ID mit den Parametern des Routers
  try {
    const response = await axios.get(`/api/tweets/${tweetId}`); // Schicke GET anfrage an die API um den Tweet zu bekommen
    editedTweet.value = response.data; //Speicher den bekommenden Tweet
  } catch (error) {
      console.error('Fehler beim Laden des Tweets:', error);
  }
};

onMounted(() => {
  loadTweet();
});

const updateTweet = async () => {
  // Validierung überprüfen
  if (!editedTweet.value.title.trim()) {
      errors.value.title = 'Titel ist erforderlich';
    return;
  }
  if (!editedTweet.value.tweet.trim()) {
    errors.value.tweet = 'Inhalt ist erforderlich';
    return;
  }

  const tweetId = router.currentRoute.value.params.id;
  try {
    await axios.put(`/api/tweets/${tweetId}`, editedTweet.value);
    router.push(`/`);
  } catch (error) {
    console.error('Fehler beim Aktualisieren des Tweets:', error);
  }
};

</script>


<template>

  <BaseHeader/>

    <div class="grid">
      <div class="flex">
        <h1>Tweet bearbeiten</h1>
        <form @submit.prevent="updateTweet">
          <div class="title">
            <label for="title">Titel:</label>
            <input type="text" id="title" v-model="editedTweet.title" required>
            <div v-if="errors.title" class="error">{{ errors.title }}</div>
          </div>
          <div class="content">
            <label for="content">Inhalt:</label>
            <textarea rows="4" id="content" v-model="editedTweet.tweet" required></textarea>
            <div v-if="errors.tweet" class="error">{{ errors.tweet }}</div>
          </div>
          <button type="submit">Aktualisieren</button>
        </form>
      
    </div>
    </div>

  <BaseFooter/>

  </template>
  
 
  
  <style scoped>

  .grid {
    display: grid;
    grid-template-columns: 1fr minmax(300px, 2fr) 1fr;
    grid-template-rows: 1fr minmax(300px, 2fr) 1fr;;
    align-items: center;
    gap: 20px;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
  }

  .flex {
    display: flex;
    flex-direction: column;
    grid-column: 2;
    grid-row: 2;
    background-color: white;
    padding: 15px;
  }

  .title {
    display: flex;
    flex-direction: column;
    gap: 20px;
    margin-bottom: 20px;
  }

  .content {
    display: flex;
    flex-direction: column;
    gap: 20px;
    margin-bottom: 20px;
  }

  button {
    background-color: #1D9BF0;
    color: white;
    border-radius: 50px;
  }

input, textarea {
  font-size: 24px;
  padding: 5px;
}

  .error {
    color: red;
  }
  </style>
  