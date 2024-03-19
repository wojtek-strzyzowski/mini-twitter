<template>
    <div>
      <h1>Tweet bearbeiten</h1>
      <form @submit.prevent="updateTweet">
        <div>
          <label for="title">Titel:</label>
          <input type="text" id="title" v-model="editedTweet.title" required>
          <div v-if="errors.title" class="error">{{ errors.title }}</div>
        </div>
        <div>
          <label for="content">Inhalt:</label>
          <textarea id="content" v-model="editedTweet.tweet" required></textarea>
          <div v-if="errors.tweet" class="error">{{ errors.tweet }}</div>
        </div>
        <button type="submit">Aktualisieren</button>
      </form>
      <button @click="deleteTweet">Löschen</button>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue';
  import axios from 'axios';
  import { useRouter } from 'vue-router';
  
  const router = useRouter();
  const editedTweet = ref({ title: '', tweet: '' }); 
  const errors = ref({});
  
  const loadTweet = async () => {
    const tweetId = router.currentRoute.value.params.id;
    try {
      const response = await axios.get(`/api/tweets/${tweetId}`);
      editedTweet.value = response.data;
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
      router.push(`/tweets/`);
    } catch (error) {
      console.error('Fehler beim Aktualisieren des Tweets:', error);
    }
  };
  
  const deleteTweet = async () => {
    const tweetId = router.currentRoute.value.params.id;
    try {
      await axios.delete(`/api/tweets/${tweetId}`);
      router.push('/tweets');
    } catch (error) {
      console.error('Fehler beim Löschen des Tweets:', error);
    }
  };
  </script>
  
  <style>
  .error {
    color: red;
  }
  </style>
  