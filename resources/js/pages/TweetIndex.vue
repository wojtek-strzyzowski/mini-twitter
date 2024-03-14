

<template>

    <div>
        <BaseHeader/>
    </div>


    <div class="tweet-container">
        <h1>Tweets</h1>
        
        <ul>
        <li v-for="tweet in tweets" :key="tweet.id">
            <h2>{{ tweet.title }}</h2>
            <p>{{ tweet.tweet }}</p>
            <p>Erstellt am: {{ tweet.created_at }}</p>
            <p>Aktualisiert am: {{ tweet.updated_at }}</p>
        </li>
        </ul>
    </div>


</template>


<script>

import BaseHeader from '../components/BaseHeader.vue';
//hier wird das objekt einfach aus einer 
//Datei exportiert um in eine andere datei zu importieren
export default {
  data() {
    return {
      tweets: [],
    };
  },
  mounted() {
    this.getValue();
  },
  methods: {
    async getValue() {
      try {
        const response = await axios.get("/api/tweets");
        this.tweets = response.data;
      } catch (error) {
        // Fehlerbehandlung
        console.log(error);
      }
    },
  },
};
</script>


<style scoped>



</style>