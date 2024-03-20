<script setup>
import BaseFooter from '../components/BaseFooter.vue';
import BaseHeader from '../components/BaseHeader.vue';
import { useRouter } from 'vue-router';
import { ref } from 'vue'; // wird verwendetum sich automatisch zu aktualiesiern, wenn sich Werte ändern
import axios from 'axios'; // HTTP-Client Biblio für die Kommunikation mit der API

const router = useRouter();

const newTweet = ref({
  title: '',
  content: ''
});


//Beim try /catch sende ich einen POST Request an die API um TWEET zu erstellen
const createTweet = async () => {
  try {
    let response = await axios.post('/api/tweets', {
      title: newTweet.value.title,
      tweet: newTweet.value.content
    });
    
    // Erfolgsmeldung oder Weiterleitung zur Index-Seite
    router.push('/'); 
    
  } catch (error) {
    console.error('Fehler beim Erstellen des Tweets:', error);
  }
};


</script>


<template>

<BaseHeader/>

<h1>Neuen Tweet erstellen</h1>

<div class="create-tweet">
  <p><strong>Was möchtest du mitteilen?</strong></p>
    <form @submit.prevent="createTweet">
      <div class="title">
        <label for="title">Titel:</label>
        <input type="text" id="title" v-model="newTweet.title" required>
      </div>
      <div class="Inhalt">
        <label for="content">Inhalt:</label>
        <textarea rows="4" id="content" v-model="newTweet.content" required></textarea>
      </div>
      <button type="submit">Tweet erstellen</button>
    </form>
</div>

<BaseFooter/>

</template>

<style scoped>

.create-tweet {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  height: 100vh; /* Setzen Sie die Höhe auf volle Bildschirmhöhe */
}

form {
  display: flex;
  flex-direction: column;
  align-items: center;
  width: 75%;
  padding: 20px; /* Fügen Sie etwas Innenabstand hinzu */
}

h1 {
  text-align: center;
  margin-bottom: 20px; /* Fügen Sie Platz unter dem Titel hinzu */
}

textarea, input {
  resize: none;
  font-size: 24px;
  padding: 10px;
  margin-bottom: 15px;
  width: 100%; /* Füllen Sie die Breite des Formularelements aus */
  box-sizing: border-box; /* Berücksichtigen Sie das Padding in der Breite */
}

button {
  background-color: #1D9BF0;
  color: antiquewhite;
  padding: 10px 20px;
  border: none;
  cursor: pointer;
}
</style>  
