<script setup>
import { ref, watch } from 'vue';
import axios from 'axios';
import { useRouter } from 'vue-router';
import BaseHeader from '../components/BaseHeader.vue';

const router = useRouter();
const tweet = ref(null);
const loading = ref(false);
const error = ref(null);
const showDeleteModal = ref(false); // Zustand für das Löschmodal

const loadTweet = async () => {
  const tweetId = router.currentRoute.value.params.id;
  loading.value = true;
  try {
    const response = await axios.get(`/api/tweets/${tweetId}`);
    tweet.value = response.data;
  } catch (error) {
    console.error('Fehler beim Laden des Tweets:', error);
    error.value = error.message; // Fehlermeldung setzen
  } finally {
    loading.value = false;
  }
};

// API-Aufruf beim Laden der Komponente und bei Änderungen der Route auslösen
watch(() => router.currentRoute.value.params.id, () => {
  loadTweet();
}, { immediate: true }); // Sofortige Ausführung beim ersten Laden der Komponente

const editTweet = () => {
  const tweetId = router.currentRoute.value.params.id;
  router.push(`/tweets/${tweetId}/edit`);
};

const confirmDelete = () => {
  showDeleteModal.value = true;
};

const cancelDelete = () => {
  showDeleteModal.value = false;
};

const deleteTweet = async () => {
  const tweetId = router.currentRoute.value.params.id;
  try {
    await axios.delete(`/api/tweets/${tweetId}`);
    router.push('/tweets'); // Zur Indexseite navigieren
  } catch (error) {
    console.error('Fehler beim Löschen des Tweets:', error);
  }
};

const formatDate = (dateToString) => {
  const date = new Date(dateToString);
  const options = { year: 'numeric', month: '2-digit', day: '2-digit' };
  return date.toLocaleDateString('de-DE', options);
}

</script>



<template>

<BaseHeader/>

<div class="grid">
  <div v-if="tweet" class="tweet">
      <p>Tweet vom: {{ formatDate(tweet.created_at) }}</p> 
      <h1>{{ tweet.title }}</h1>
      <p>{{ tweet.tweet }}</p>
      

    <div class="button"> 
      <button class="edit" @click="editTweet">Bearbeiten</button>
      <button class="delete" @click="confirmDelete">Löschen</button>
    </div>
  </div>
  
  <div v-else>
    <p>Der Tweet wurde nicht gefunden.</p>
  </div>
</div>

  <!-- Bestätigungsmodal -->
  <div v-if="showDeleteModal" class="modal">
    <div class="modal-content">
        <p>Möchten Sie diesen Tweet wirklich löschen?</p>
        <button @click="deleteTweet">Ja</button>
        <button @click="cancelDelete">Abbrechen</button>
     

    </div>
  </div>

</template>


<style>

.grid {
  display: grid;
  grid-template-columns: 1fr minmax(300px, 2fr) 1fr;
  align-items: center;
  gap: 20px;
}

.modal {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
}

.modal-content {
  background-color: white;
  padding: 20px;
  border-radius: 5px;
}

.tweet {
    display: flex;
    flex-direction: column;
    margin: 15px;
    grid-column: 2;
  }

.button {
    display: flex;
    gap: 25px;
    flex-direction: row;
    align-items: center;
    width: 146px;
    height: 38px;
  }

.edit {
    color: antiquewhite;
    background-color: black;
    border-radius: 5px;
  }

.delete {
  color: antiquewhite;
  background-color: red;
  border-radius: 5px;
  }

</style>
