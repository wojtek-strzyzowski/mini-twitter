import { createRouter, createWebHistory } from "vue-router";



const routes = [
    {
        path: "/tweets",
        component: TweetIndex => import("./pages/TweetIndex.vue"),
    },
    {
        path: "/tweets/create",
        component: TweetCreate => import("./pages/TweetCreate.vue"),
    },
    {
        path: "/tweets/singletweet",
        component: TweetShow => import("./pages/TweetShow.vue"),
    },
    {
        path: "/tweets/edit",
        component: TweetEdit => import("./pages/TweetEdit.vue"),
    },
];

export default createRouter({
    history: createWebHistory(),
    routes,
});