import { createRouter, createWebHistory } from "vue-router";
import TweetShow from "./pages/TweetShow.vue";
import TweetEdit from './pages/TweetEdit.vue';



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
        path: "/tweets/:id",
        component: TweetShow => import("./pages/TweetShow.vue"),
        name: "TweetShow",
    },
    {
        path: '/tweets/:id/edit',
        component: TweetEdit => import("./pages/TweetEdit.vue"),
    },
];

export default createRouter({
    history: createWebHistory(),
    routes,
});