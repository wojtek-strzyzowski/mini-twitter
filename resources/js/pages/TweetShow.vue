<template>
  <div v-if="tweet">
    <h1>{{ tweet.title }}</h1>
    <p>{{ tweet.tweet }}</p>
    <p>Erstellt am: {{ tweet.created_at }}</p>
    <p>Aktualisiert am: {{ tweet.updated_at }}</p>
    <button @click="editTweet">Bearbeiten</button>
    <button @click="confirmDelete">Löschen</button>
  </div>
  <div v-else>
    <p>Der Tweet wurde nicht gefunden.</p>
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

<script setup>
import { ref, watch } from 'vue';
import axios from 'axios';
import { useRouter } from 'vue-router';

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
</script>

<style>
/* Stil definieren, falls gewünscht */
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
</style>
