<template>

    <div class="footer">
        <p>Mini-Twitter built with Laravel</p>
        <p class="copyright">&#169; Wojtek Strzyzowski</p>
    </div>


</template>

<style>


.footer {
    display: grid;
    grid-template-columns: 1fr minmax(300px, 2fr) 1fr;
    align-items: center;
    background-color: white;
    bottom: 0;
    position: fixed;
    width: 100%;
    }

.copyright {
    grid-column-start: 3;
    grid-column-end: 4;
    text-align: center; 
}

</style>