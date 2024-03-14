<template>
    <div>
        <h1>TWEETS</h1>
        <router-link to="/test">Link zur Test Seite</router-link>
        <button @click.prevent="getValue">Trigger Endpoint</button>
        <p v-if="response">{{ response.data }}</p>
    </div>
</template>

<script setup>
    import axios from "axios";
    import { ref } from "vue";

    const response = ref();

    const getValue = async () => {
        try {
            response.value = await axios.get("/api/tweets");
        } catch (error) {
            // Do something with the error
            console.log(error);
        }
    };
</script>