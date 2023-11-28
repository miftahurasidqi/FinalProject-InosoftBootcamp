<template>
    <div id="page-body">
        <h1>3rd Party Instruction</h1>
        <div class="card">
            <h2>{{ instruction.instructionId }}</h2>

            <DetailTopPanel
                :status="instruction.status"
                :id="instruction._id"
            />

            <DetailPageInfoPanel :instruction="instruction" />
            <!-- <hr /> -->

            <DetailPageTable />

            <!--  -->
            <div id="vendor-invoice">
                <DetailPageVendorInvoice />
                <DetailPageVendorInvoiceList />
            </div>
            <!--  -->
            <DetailPageInternalPanel />
            <!--  -->
        </div>
    </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import ActionButton from "../ActionButton.vue";

import DetailTopPanel from "../DetailTopPanel.vue";
import DetailPageInfoPanel from "../DetailPageInfoPanel.vue";
import DetailPageTable from "../DetailPageTable.vue";
import DetailPageVendorInvoice from "../DetailPageVendorInvoice.vue";
import DetailPageVendorInvoiceList from "../DetailPageVendorInvoiceList.vue";
import DetailPageInternalPanel from "../DetailPageInternalPanel.vue";

export default {
    name: "DetailPage",
    components: {
        DetailPageInfoPanel,
        DetailPageTable,
        ActionButton,
        DetailTopPanel,
        DetailPageVendorInvoice,
        DetailPageVendorInvoiceList,
        DetailPageInternalPanel,
    },
    mounted() {
        this.getInstructionsById(this.$route.params.id);
    },
    computed: {
        ...mapGetters({
            instruction: "instructionDetail",
        }),
    },
    methods: {
        ...mapActions({
            getInstructionsById: "getInstructionsById",
        }),
    },
};
</script>

<style scoped>
#page-body {
    margin: 2rem;
}

#internal-panel-header {
    background-color: black;
    color: white;
}
</style>
