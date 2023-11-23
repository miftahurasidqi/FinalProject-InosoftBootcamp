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
            <div id="cost-detail-panel" class="card">
                <h2>Cost Detail</h2>
                <DetailPageTable :instruction="instruction" />
            </div>
            <div id="attachment-panel" class="d-flex justify-content-between">
                <div>
                    <h2>Attachment</h2>
                    <button>Add Attachment</button>
                </div>
                <div>
                    <label for="notes">Notes</label>
                    <textarea name="notes" id="" cols="10" rows="10"></textarea>
                </div>
            </div>
            <!--  -->
            <DetailPageVendorInvoice />
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
import DetailPageInternalPanel from "../DetailPageInternalPanel.vue";

export default {
    name: "DetailPage",
    components: {
        DetailPageInfoPanel,
        DetailPageTable,
        ActionButton,
        DetailTopPanel,
        DetailPageVendorInvoice,
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

#attachment-panel {
    height: 300px;
}

#internal-panel-header {
    background-color: black;
    color: white;
}

textarea {
    max-height: 50%;
}
</style>
