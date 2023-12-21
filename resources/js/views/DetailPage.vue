<template>
    <div id="page-body">
        <h1>3rd Party Instruction</h1>
        <div class="card container-d-p">
            <h2>{{ instruction.instructionId }}</h2>

            <DetailTopPanel
                :status="instruction.status"
                :id="instruction._id"
            />

            <DetailPageInfoPanel :instruction="instruction" />
            <!-- <hr /> -->

            <DetailPageTable />

            <!--  -->
            <div v-if="isShowVendorInvoice" id="vendor-invoice">
                <DetailPageVendorInvoice :status="instruction.status" />
                <DetailPageVendorInvoiceList :status="instruction.status" />
            </div>
            <!--  -->
            <DetailPageInternalPanel />
            <!--  -->
        </div>
    </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import ActionButton from "../components/ActionButton.vue";

import DetailTopPanel from "../components/DetailTopPanel.vue";
import DetailPageInfoPanel from "../components/DetailPageInfoPanel.vue";
import DetailPageTable from "../components/DetailPageTable.vue";
import DetailPageVendorInvoice from "../components/DetailPageVendorInvoice.vue";
import DetailPageVendorInvoiceList from "../components/DetailPageVendorInvoiceList.vue";
import DetailPageInternalPanel from "../components/DetailPageInternalPanel.vue";

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
        isShowVendorInvoice() {
            if (this.instruction.status == "cancelled") {
                return false;
            } else if (this.instruction.status == "draft") {
                return false;
            }
            return true;
        },
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
.container-d-p {
    border: 1px solid rgb(210, 210, 210);
}

#internal-panel-header {
    background-color: black;
    color: white;
}
</style>
