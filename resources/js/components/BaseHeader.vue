<template>

<header>
    <div class="header">
        <div class="header-title">
            <h1>Mini-Twitter</h1>
        </div>
        
        <div class="header-button">
            <button @click.prevent="getValue">
                <router-link to="/tweets/create">+ Create a Tweet</router-link>
            </button>
            <p v-if="response">{{ response.data }}</p>
        </div>    
    </div>
</header>

</template>


<script>

</script>

<style scoped>

.header {
    display: flex;
    flex-direction: row;
}


</style>