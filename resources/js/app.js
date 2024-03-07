import "./bootstrap";
import { createApp } from "vue";
import { registerGlobComp } from "./components/registerGlobComp";
import App from "./App.vue"; // Komponen App ini untuk induk aplikasi
import router from "./router";
import store from "./store";

// const app = createApp({});
const app = createApp(App);
app.component("App", App); // router-view sama navbar dipasang di App.vue

registerGlobComp(app);

app.use(router);
app.use(store).mount("#app");
