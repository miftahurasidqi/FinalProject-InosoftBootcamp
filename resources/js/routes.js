import { createRouter, createWebHistory } from "vue-router";

import CreatePage from "./components/pages/CreatePage.vue";
import DetailPage from "./components/pages/DetailPage.vue";
import EditPage from "./components/pages/EditPage.vue";
import HomePage from "./components/pages/HomePage.vue";

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
