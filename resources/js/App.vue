<template>
    <div>
        <TheNavbar />
        <router-view></router-view>
    </div>
</template>

<script>
import TheNavbar from "./components/TheNavbar.vue";

export default {
    name: "App",
    components: {
        TheNavbar,
    },
};
</script>
