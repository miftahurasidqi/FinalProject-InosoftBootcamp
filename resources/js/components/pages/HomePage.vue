<template>
    <div id="page-body">
        <h1>Home</h1>
        <div class="card card-styling">
            <div class="card-body">
                <div id="card-header">
                    <div class="container-card-top">
                        <div class="container-o-c">
                            <ActionButton
                                @click="isOpenSwitcher"
                                text="Open"
                                class="b-open"
                            />
                            <ActionButton
                                @click="isCloseSwitcher"
                                text="Completed"
                                class="b-completed"
                            />
                        </div>

                        <div class="container-s-e">
                            <input
                                name="attention-of"
                                type="text"
                                placeholder="Search Instruction"
                                v-model="searchKeyword"
                                @input="search"
                            />
                            <ActionButton text="Export" class="border" />
                        </div>
                    </div>
                    <div class="conatiner-b-intruction">
                        <p>
                            show {{ pageInfo.size }} of
                            {{ pageInfo.totalData }} data
                        </p>

                        <div style="position: relative">
                            <ActionButton
                                @click="toggleList"
                                text="Create 3rd Party Instruction"
                                class="b-intruction"
                            />
                            <div :class="listClass" style="transition: 0.3s">
                                <button class="logistic">
                                    Logistic Instruction
                                </button>
                                <button class="service">
                                    Service Intruction
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <table class="table my-4">
                <thead class="table-h">
                    <tr>
                        <th>Instruction ID</th>
                        <th>Link To</th>
                        <th>Instruction Type</th>
                        <th>Assigned Vendor</th>
                        <th>Attention Of</th>
                        <th>Quotation No.</th>
                        <th>Customer PO</th>
                        <th class="th-status">Status</th>
                    </tr>
                </thead>
                <tbody class="table-b">
                    <HomeTable
                        v-for="instruction in instructions"
                        :instruction="instruction"
                        style="height: auto"
                    />
                </tbody>
            </table>

            <ActionButton @click="loadNextInstructions" text="Load Next Data" />
        </div>
    </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import HomeTable from "../HomeTable.vue";
import ActionButton from "../ActionButton.vue";

export default {
    name: "HomePage",
    components: {
        HomeTable,
        ActionButton,
    },
    data() {
        return {
            isOpen: true, // Secara default menunjukkan halaman 'Open'
            isListOpen: false,
            searchKeyword: "",
            loading: false,
        };
    },
    mounted() {
        // menjalankan function saat renderan awal
        this.getOpenInstructions(0);
        window.addEventListener("scroll", this.handleScroll);
    },
    computed: {
        ...mapGetters({
            instructions: "instructions",
            pageInfo: "pageInfo",
        }),
        listClass() {
            return this.isListOpen ? "open" : "close";
        },
    },
    methods: {
        // mengakses function dari store  (store/actions.js)
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
        search() {
            let status = this.isOpen ? "open" : "completed";
            const reqData = {
                status,
                keyWord: this.searchKeyword,
                currrentPage: 0,
            };
            if (this.searchKeyword) {
                console.log(reqData);
                this.searchInstructions(reqData);
            } else {
                console.log(status, "str 0");
                this.isOpen
                    ? this.getOpenInstructions(0)
                    : this.getCompletedInstructions(0);
            }
        },

        loadNextInstructions() {
            if (this.loading) return;
            this.loading = true;

            // memeriksa tab apakah open atau completed
            if (this.pageInfo.currrentPage !== this.pageInfo.totalPages) {
                let status = this.isOpen ? "open" : "completed";
                const reqData = {
                    status,
                    keyWord: this.searchKeyword,
                    currrentPage: this.pageInfo.currrentPage,
                };
                if (this.searchKeyword) {
                    console.log(reqData);
                    this.searchInstructions(reqData);
                } else {
                    console.log(status, "str 0");

                    this.isOpen
                        ? this.getOpenInstructions(this.pageInfo.currrentPage)
                        : this.getCompletedInstructions(
                              this.pageInfo.currrentPage
                          );
                }
            } else {
                console.log("semua data telah diambil");
            }
            this.loading = false;
        },
        handleScroll() {
            // Jika pengguna telah mencapai bagian bawah
            if (
                window.innerHeight + window.scrollY >=
                document.body.offsetHeight
            ) {
                if (this.$route.fullPath === "/") {
                    this.loadNextInstructions();
                }
            }
        },
        toggleList() {
            this.isListOpen = !this.isListOpen;
        },
    },
};
</script>

<style scoped>
#page-body {
    margin: 2rem;
}

.card-styling {
    box-shadow: 0px 0px 10px -5px black;
}

.container-card-top {
    display: flex;
    justify-content: space-between;
    align-items: center;
    height: 50px;
    margin-top: 1rem;
    margin-bottom: 2rem;
    border-bottom: 3px solid rgb(224, 224, 224);
    box-sizing: border-box;
}

.b-open,
.b-completed {
    font-weight: 600;
    font-size: 1.2rem;
    height: calc(100% + 3px);
    color: gray;
    border-radius: 0;
    box-sizing: border-box;
}
.b-open:hover,
.b-completed:hover {
    background: none;
    color: rgb(95, 190, 155);
    border-bottom: 3px solid rgb(95, 190, 155);
}

.conatiner-b-intruction {
    display: flex;
    justify-content: space-between;
}

.close {
    position: absolute;
    left: 0;
    top: 0;
    overflow: hidden;
    height: 0px;
    transform: translateY(36px);
    display: flex;
    flex-direction: column;
}

.open {
    position: absolute;
    left: 0;
    top: 0;
    overflow: hidden;
    height: 72px;
    transform: translateY(36px);
    display: flex;
    flex-direction: column;
}

/* .open-intruction:hover {
    height: 72px;
    transition: 0.3s;
} */
.logistic,
.service {
    width: 216px;
    height: 36px;
    border: none;
    border-radius: 4px;
    color: black;
    background: rgb(244, 244, 244);
}

.logistic:hover,
.service:hover {
    background: rgb(211, 211, 211);
    transition: 0.3s;
}
.b-intruction {
    background: rgb(95, 190, 155);
    color: white;
}
.b-intruction:hover {
    background: rgb(70, 140, 115);
    transition: 0.3s;
}

.container-o-c {
    height: 100%;
}
.container-s-e {
    display: flex;
    align-items: center;
    height: 100%;
}

.table-h tr th {
    background: slategray;
    color: white;
    font-weight: 500;
}

.table-b {
}

.th-status {
    display: flex;
    justify-content: center;
    align-items: center;
}
</style>
