import HomePage from './components/pages/HomePage.vue'
import CreatePage from './components/pages/CreatePage.vue'
import EditPage from './components/pages/EditPage.vue'
import DetailPage from './components/pages/DetailPage.vue'

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
        path: "/edit",
        name: "edit",
        component: EditPage,
    },
    {
        path: "/detail",
        name: "detail",
        component: DetailPage,
    },
];