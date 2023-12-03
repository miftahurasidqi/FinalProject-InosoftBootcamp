<template>
    <div id="page-body">
        <h1 style="margin-bottom: 8px">Home</h1>
        <div class="card card-styling">
            <div class="card-body">
                <div id="card-header">
                    <div class="container-card-top">
                        <div class="container-o-c">
                            <ActionButton
                                @click="isOpenSwitcher"
                                text="Open"
                                class="b-open terbuka"
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
                                placeholder="Search"
                                v-model="searchKeyword"
                                @input="search"
                            />
                            <ActionButton text="Export" class="export" />
                        </div>
                    </div>
                    <div class="conatiner-b-intruction">
                        <p class="show-data">
                            {{ pageInfo.size }} of
                            {{ pageInfo.totalData }} entries displayed
                        </p>

                        <div style="position: relative">
                            <ActionButton
                                @click="toggleList"
                                text="Create 3rd Party Instruction"
                                class="b-intruction"
                            />
                            <div :class="listClass" style="transition: 0.3s">
                                <button
                                    class="logistic"
                                    @click="goCreateLogistic"
                                >
                                    Logistic Instruction
                                </button>
                                <button
                                    class="service"
                                    @click="goCreateService"
                                >
                                    Service Intruction
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <table class="table">
                <thead class="table-h">
                    <tr>
                        <th><p>Instruction ID</p></th>
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
            isOpen: true,
            isListOpen: false,
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
        listClass() {
            return this.isListOpen ? "open" : "close";
        },
    },
    methods: {
        ...mapActions({
            getOpenInstructions: "getOpenInstructions",
            getCompletedInstructions: "getCompletedInstructions",
            searchInstructions: "searchInstructions",
        }),
        goCreateService() {
            this.$router.push("/create");
        },
        goCreateLogistic() {
            this.$router.push("/create");
        },
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
            if (this.pageInfo.currrentPage < this.pageInfo.totalPages) {
                let status = this.isOpen ? "open" : "completed";
                const reqData = {
                    status,
                    keyWord: this.searchKeyword,
                    currrentPage: this.pageInfo.currrentPage,
                };
                if (this.searchKeyword) {
                    this.searchInstructions(reqData);
                } else {
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

.container-card-top {
    display: flex;
    justify-content: space-between;
    align-items: center;
    height: 50px;
    margin-top: 1rem;
    margin-bottom: 1.5rem;
    border-bottom: 2px solid rgb(230, 230, 230);
    box-sizing: border-box;
}

.b-open,
.b-completed {
    font-weight: 600;
    font-size: 1.2rem;
    height: calc(100% + 3px);
    color: rgb(160, 160, 160);
    padding: 0rem 1rem;
    border-radius: 0;
    box-sizing: border-box;
}
.b-open:hover,
.b-completed:hover {
    background: none;
    color: rgb(0, 190, 190);
    border-bottom: 4px solid rgb(0, 190, 190);
}

.conatiner-b-intruction {
    display: flex;
    justify-content: space-between;
    height: 60px;
    margin-bottom: 10px;
}

.show-data {
    align-self: end;
    font-size: medium;
    font-weight: 500;
    color: rgb(170, 170, 170);
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
.logistic,
.service {
    width: 228px;
    height: 36px;
    border: none;
    font-size: small;
    font-weight: 600;
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
    background: rgb(0, 190, 190);
    color: white;
    font-size: small;
    font-weight: 600;
    height: 36px;
    padding: 0rem 2rem;
}
.b-intruction:hover {
    background: rgb(0, 170, 170);
    transition: 0.3s;
}

.container-o-c {
    height: 100%;
}
.container-s-e {
    display: flex;
    align-items: center;
    height: 100%;
    padding-bottom: 5px;
}

.container-s-e input {
    height: 35px;
    width: 230px;
    border: 1px solid rgb(230, 230, 230);
    font-size: small;
    font-weight: 500;
    padding-left: 10px;
}

.export {
    padding: 3px 1rem;
    height: 35px;
    width: 80px;
    border: 1px solid rgb(230, 230, 230);
    border-radius: 3px;
    margin-left: 1rem;
    font-size: small;
    font-weight: 600;
}

.table-h tr th {
    background: rgb(170, 170, 170);
    height: 35px;
    color: white;
    font-weight: 500;
}
</style>
