import { createRouter, createWebHistory } from "vue-router";

import HomePage from "../views/HomePage.vue";
import CreatePage from "../views/CreatePage.vue";
import DetailPage from "../views/DetailPage.vue";
import EditPage from "../views/EditPage.vue";

const routes = [
    {
        path: "/",
        name: "home",
        component: HomePage,
    },
    {
        path: "/create",
        name: "create",
        component: CreatePage,
    },
    {
        path: "/detail/:id",
        name: "detail",
        component: DetailPage,
    },
    {
        path: "/edit/:id",
        name: "edit",
        component: EditPage,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});
export default router;
