<template>
    <nav id="container-navbar" class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <router-link class="navbar-brand b-nav" to="/">Home</router-link>
            <!-- <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button> -->
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <router-link
                        class="nav-link b-nav"
                        aria-current="page"
                        to="/create"
                        >Create</router-link
                    >
                    <router-link class="nav-link b-nav" to="/detail/1"
                        >Detail</router-link
                    >
                    <router-link class="nav-link b-nav" to="/edit/1"
                        >Edit</router-link
                    >
                </div>
            </div>
        </div>
    </nav>
</template>

<script>
export default {
    name: "TheNavbar",
};
</script>

<style scoped>
#container-navbar {
    background: rgb(20, 20, 20);
    position: fixed;
    width: 100%;
    height: 60px;
    border-bottom: 3px solid rgb(95, 190, 155);
    z-index: 9999;
}

.b-nav {
    color: white;
}
</style>
