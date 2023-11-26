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
            <div id="cost-detail-panel" class="card container-cd">
                <div>
                    <p>Cost Detail</p>
                </div>
                <div class="container-table-cd">
                    <DetailPageTable />
                    <div id="attachment-panel">
                        <div class="a-l">
                            <p>Attachment</p>
                            <button>Add Attachment</button>
                        </div>
                        <div class="a-r">
                            <label for="notes">Notes</label>
                            <textarea name="notes" id=""></textarea>
                        </div>
                    </div>
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

.container-cd {
    margin: 0rem 1.5rem;
    border: none;
    border-top: 1px solid rgb(200, 200, 200);
    border-radius: 0px;
    padding-top: 1rem;
}

.container-table-cd {
    border: 1px solid rgb(189, 189, 189);
}

.container-cd p {
    font-weight: 700;
}

#attachment-panel {
    height: auto;
    display: flex;
    padding: 0px 10px;
    padding-bottom: 10px;
}
.a-l {
    width: 40%;
}
.a-l p {
    font-weight: 500;
    color: rgb(98, 98, 98);
}
.a-l button {
    background: rgb(0, 162, 162);
    padding: 0.3rem 2rem;
    border: none;
    border-radius: 4px;
    color: white;
    font-weight: 600;
}
.a-r {
    display: flex;
    flex-direction: column;
    width: 60%;
}

.a-r label {
    font-size: medium;
    font-weight: 500;
    color: rgb(98, 98, 98);
}

.a-r textarea {
    border: none;
    height: 100px;
    background: rgb(245, 245, 245);
}

#internal-panel-header {
    background-color: black;
    color: white;
}
</style>
