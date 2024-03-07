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

            <CostDetail />

            <div v-if="isShowVendorInvoice" id="vendor-invoice">
                <DetailPageVendorInvoice :status="instruction.status" />
                <DetailPageVendorInvoiceList :status="instruction.status" />
            </div>

            <DetailPageInternalPanel />
        </div>
    </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

import DetailTopPanel from "./components/TopPanel.vue";
import DetailPageInfoPanel from "./components/InfoPanel.vue";
import CostDetail from "./components/CostDetail.vue";
import DetailPageVendorInvoice from "./components/VendorInvoice.vue";
import DetailPageVendorInvoiceList from "./components/VendorInvoiceList.vue";
import DetailPageInternalPanel from "./components/InternalPanel.vue";
// CostDetail
export default {
    name: "DetailPage",
    components: {
        DetailTopPanel,
        DetailPageInfoPanel,
        CostDetail,
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
