

<template>

<header>
    <div class="header">
        <div class="header-title">
            <h1>Mini-Twitter</h1>
        </div>
        <div class="home-link">
            <router-link to="/tweets/">my Tweets</router-link>
        </div>

        <div class="header-button">
            <button @click.prevent="getValue">
                <router-link to="/tweets/create"> + Create a Tweet</router-link>
            </button>
            <p v-if="response">{{ response.data }}</p>
        </div>    
    </div>
</header>

</template>



<style scoped>

header {
    background-color: white;
}

.header {
    display: grid;
    grid-template-columns: 25% 50% 25%;
    align-items: center;
}

h1{
    font-size: 24px;
    text-align: center;
    grid-column-start: 1;
    grid-column-end: 2;
    grid-row-start: 1;
}

.header-button {
    grid-column-start: 3;
    grid-column-end: 4;
    grid-row-start: 1;
}

button {
    justify-items: center;
    background-color: #1D9BF0;
    align-self: center;
    border-radius: 50px;
}

a {
    color: white;
}

.home-link a {
    color: black;
}

</style>