<template>
    <div id="page-body">
        <h1>home</h1>
        <div class="card">
            <div class="card-body">
                <div id="card-header">
                    <div class="my-4 mx-2 d-flex justify-content-between">
                        <div>
                            <ActionButton @click="isOpenSwitcher" text="Open" />
                            <ActionButton
                                @click="isCloseSwitcher"
                                text="Completed"
                            />
                        </div>
                        <div>
                            <ActionButton text="Search" />
                            <ActionButton
                                text="Export"
                                @click="getOpenInstructions(1)"
                            />
                        </div>
                    </div>
                    <div class="my-4 mx-2 d-flex justify-content-between">
                        <p>
                            show {{ pageInfo.size }} of
                            {{ pageInfo.totalData }} data
                        </p>
                        <ActionButton text="Create 3rd Party Instruction" />
                    </div>
                </div>

                <table class="table my-4 mx-2">
                    <thead>
                        <tr>
                            <th>Instruction ID</th>
                            <th>Link To</th>
                            <th>Instruction Type</th>
                            <th>Assigned Vendor</th>
                            <th>Attention Of</th>
                            <th>Quotation No.</th>
                            <th>Customer PO</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <HomeTable
                            v-for="instruction in instructions"
                            :instruction="instruction"
                        />
                    </tbody>
                </table>

                <ActionButton
                    @click="loadNextInstructions"
                    text="Load Next Data"
                />
            </div>
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
        };
    },
    mounted() {
        // menjalankan function saat renderan awal
        this.getOpenInstructions(0);
    },
    computed: {
        ...mapGetters({
            instructions: "instructions",
            openInstructions: "openInstructions",
            completedInstructions: "completedInstructions",
            pageInfo: "pageInfo",
        }),
    },
    methods: {
        // mengakses function dari store  (store/actions.js)
        ...mapActions({
            getOpenInstructions: "getOpenInstructions",
            getCompletedInstructions: "getCompletedInstructions",
        }),
        isOpenSwitcher() {
            this.isOpen = true;
            this.getOpenInstructions(0);
        },
        isCloseSwitcher() {
            this.isOpen = false;
            this.getCompletedInstructions(0);
        },
        loadNextInstructions() {
            // memeriksa tab apakah open atau completed
            if (this.isOpen) {
                this.getOpenInstructions(this.pageInfo.currrentPage);
            } else {
                this.getCompletedInstructions(this.pageInfo.currrentPage);
            }
        },
    },
};
</script>

<style scoped>
#page-body {
    margin: 2rem;
}
</style>
