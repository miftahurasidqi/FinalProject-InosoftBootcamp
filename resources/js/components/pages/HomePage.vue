<template>
    <div id="page-body">
        <h1>home</h1>
        <div class="card">
            <div class="card-body">
                <div id="card-header">
                    <div class="my-4 mx-2 d-flex justify-content-between">
                        <div>
                            <ActionButton @click="isOpenSwitcher" text="Open" />
                            <ActionButton @click="isCloseSwitcher" text="Completed" />
                        </div>
                        <div>
                            <ActionButton text="Search" />
                            <ActionButton text="Export" />
                        </div>
                    </div>
                    <div class="my-4 mx-2 d-flex justify-content-end">
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
                        <template v-if="isOpen === true">
                            <HomeTable v-for="instruction in openInstructions" :instruction="instruction" />
                        </template>
                        <template v-else-if="isOpen === false">
                            <HomeTable v-for="instruction in closeInstructions" :instruction="instruction" />
                        </template>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters } from "vuex";
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
    computed: {
        ...mapGetters({
            openInstructions: "getOpenInstructions",
            closeInstructions: "getCloseInstructions",
        }),
    },
    methods: {
        isOpenSwitcher() {
            this.isOpen = true;
        },
        isCloseSwitcher() {
            this.isOpen = false;
        },
    },
};
</script>

<style scoped>
#page-body {
    margin: 2rem;
}
</style>
