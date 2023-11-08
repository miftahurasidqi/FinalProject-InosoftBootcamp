<template>
    <div>
        <TheNavbar />
        <div class="conten">
            <TheSideBar />
            <router-view style="width: calc(100% - 75px)"></router-view>
        </div>
    </div>
</template>

<script>
import TheNavbar from "./components/TheNavbar.vue";
import TheSideBar from "./components/SideBar.vue";

export default {
    name: "App",
    components: {
        TheNavbar,
        TheSideBar,
    },
};
</script>

<style scoped>
.conten {
    display: flex;
}
</style>
