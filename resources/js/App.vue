<template>
    <div id="container-utama">
        <TheNavbar />
        <TheSideBar />
        <div class="conten">
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
    padding-top: 50px;
    padding-left: 72px;
}
</style>
