import CreatePage from "./components/pages/CreatePage.vue";
import DetailPage from "./components/pages/DetailPage.vue";
import EditPage from "./components/pages/EditPage.vue";
import HomePage from "./components/pages/HomePage.vue";

export const routes = [
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
        path: "/detail",
        name: "detail",
        component: DetailPage,
    },
    {
        path: "/edit",
        name: "edit",
        component: EditPage,
    },
];
