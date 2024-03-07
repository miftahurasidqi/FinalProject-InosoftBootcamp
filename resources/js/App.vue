<template>
    <div id="container-utama">
        <!-- <TheNavbar /> -->
        <TheSideBar />
        <div class="conten">
            <router-view style="width: calc(100% - 75px)"></router-view>
        </div>
    </div>
</template>

<script>
export default {
    name: "App",
};
</script>

<style scoped>
.conten {
    display: flex;
    padding-top: 50px;
    padding-left: 72px;
}
</style>
