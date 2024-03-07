<template>
    <div id="page-body">
        <h1 style="margin-bottom: 8px">Home</h1>
        <div class="card card-styling">
            <TopComponent
                :isOpen="isOpen"
                @openSwitcher="isOpenSwitcher"
                @closeSwitcher="isCloseSwitcher"
                @search="search"
            />

            <HomeTable style="height: auto" />
        </div>
    </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import TopComponent from "./components/TopComponent.vue";
import HomeTable from "./components/Tabel.vue";

export default {
    name: "HomePage",
    components: {
        TopComponent,
        HomeTable,
    },
    data() {
        return {
            isOpen: true,
            searchKeyword: "",
            loading: false,
        };
    },
    mounted() {
        this.getOpenInstructions(0);
        window.addEventListener("scroll", this.handleScroll);
    },
    computed: {
        ...mapGetters({
            instructions: "instructions",
            pageInfo: "pageInfo",
        }),
    },
    methods: {
        ...mapActions({
            getOpenInstructions: "getOpenInstructions",
            getCompletedInstructions: "getCompletedInstructions",
            searchInstructions: "searchInstructions",
        }),
        isOpenSwitcher() {
            this.isOpen = true;
            this.getOpenInstructions(0);
        },
        isCloseSwitcher() {
            this.isOpen = false;
            this.getCompletedInstructions(0);
        },
        search(searchKeyword) {
            this.searchKeyword = searchKeyword;
            this.handleSearch(0);
        },
        handleSearch(page) {
            let status = this.isOpen ? "open" : "completed";
            const reqData = {
                status,
                keyWord: this.searchKeyword,
                currrentPage: page,
            };

            if (this.searchKeyword) {
                this.searchInstructions(reqData);
            } else {
                this.isOpen
                    ? this.getOpenInstructions(page)
                    : this.getCompletedInstructions(page);
            }
        },
        loadNextInstructions() {
            if (this.loading) return;
            this.loading = true;

            // memeriksa tab apakah open atau completed
            if (this.pageInfo.currrentPage < this.pageInfo.totalPages) {
                this.handleSearch(this.pageInfo.currrentPage);
            } else {
                console.log("semua data telah diambil");
            }
            this.loading = false;
        },
        handleScroll() {
            if (
                window.innerHeight + window.scrollY >=
                document.body.offsetHeight
            ) {
                if (this.$route.fullPath === "/") {
                    this.loadNextInstructions();
                }
            }
        },
    },
};
</script>

<style scoped>
* {
    padding: 0;
    margin: 0;
}

#page-body {
    margin: 2rem;
}

.card-styling {
    padding: 1.5rem;
}

.table-h tr th {
    background: rgb(170, 170, 170);
    height: 35px;
    color: white;
    font-weight: 500;
}
</style>
