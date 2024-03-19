<script setup>

import BaseHeader from '../components/BaseHeader.vue';
import { useRouter } from 'vue-router';
import { ref } from 'vue';
import axios from 'axios';

const router = useRouter();

const newTweet = ref({
  title: '',
  content: ''
});

const createTweet = async () => {
  try {
    let response = await axios.post('/api/tweets', {
      title: newTweet.value.title,
      tweet: newTweet.value.content
    });
    
    // Erfolgsmeldung oder Weiterleitung zur Index-Seite
    router.push('/tweets'); 
    
  } catch (error) {
    console.error('Fehler beim Erstellen des Tweets:', error);
  }
};


</script>


<template>

<BaseHeader/>

<div>
    <h1>Neuen Tweet erstellen</h1>
    <form @submit.prevent="createTweet">
      <div>
        <label for="title">Titel:</label>
        <input type="text" id="title" v-model="newTweet.title" required>
      </div>
      <div>
        <label for="content">Inhalt:</label>
        <textarea id="content" v-model="newTweet.content" required></textarea>
      </div>
      <button type="submit">Tweet erstellen</button>
    </form>
  </div>


</template>

<style scoped>



</style>