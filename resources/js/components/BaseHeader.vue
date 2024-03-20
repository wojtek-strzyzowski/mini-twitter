

<template>

<header>
    <div class="header">
        <div class="header-title">
            <h1>Mini-Twitter</h1>
        </div>
        <div class="home-link">
            <router-link to="/">my Tweets</router-link>
        </div>

        <div class="header-button">
            <button @click.prevent="getValue">
                <router-link to="/tweets/create"> + Create a Tweet</router-link>
            </button>
        </div>    
    </div>
</header>

</template>



<style scoped>

header {
    background-color: white;
   margin-bottom: 25px;
}

.header {
    display: grid;
    grid-template-columns: 1fr minmax(300px, 2fr) 1fr;
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
    display: flex;
    justify-content: end;

}

button {
    justify-content: center;
    background-color: #1D9BF0;
    align-self: center;
    border-radius: 50px;
    width: 161px;
    height: 39px;
}


a {
    color: white;
    font-size: 16px;
}

.home-link a {
    display: grid;
    color: black;
    justify-content: end;  
    font-size: 18px;
}

</style>