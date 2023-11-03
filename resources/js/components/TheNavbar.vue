<template>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <router-link class="navbar-brand" to="/">Home</router-link>
            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <router-link
                        class="nav-link active"
                        aria-current="page"
                        to="/create"
                        >create</router-link
                    >
                    <router-link class="nav-link" to="/detail/1"
                        >Detail</router-link
                    >
                    <router-link class="nav-link" to="/edit/1"
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
