import { createRouter, createWebHistory } from "vue-router";

import CreatePage from "../views/Create";
import DetailPage from "../views/Detail";
import HomePage from "../views/Home";
import EditPage from "../views/Edit";

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
