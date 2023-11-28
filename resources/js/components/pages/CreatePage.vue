<template>
    <div id="page-body">
        <h1 style="margin-bottom: 8px">3rd Party Instruction</h1>
        <form
            class="card"
            style="padding-bottom: 2rem"
            @submit.prevent="handleSubmit"
        >
            <CreatePageInfoPanel
                :newIstruction="newIstruction"
                :getLinkTo="getLinkTo"
                :getAssignedVendor="getAssignedVendor"
                :getCustomer="getCustomer"
                :getInvoiceTo="getInvoiceTo"
            />
            <CreatePageTable
                :newCostItems="newCostItems"
                :newGrandTotal="newGrandTotal"
            />
            <div class="container-button-bottom">
                <button type="button" @click="handleCancel">Cancel</button>
                <button type="submit" @click="handleForDraft">
                    Save as Daft
                </button>
                <button type="submit" @click="handleForSubmit">Submit</button>
            </div>
        </form>
        <!-- <div> -->
        <!-- <SendMail />
        <InternalNote />
        <ReasonCancellation />
        <VendorInvoice /> -->
        <!-- <AddInvoiceTarget /> -->
    </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import CreatePageInfoPanel from "../CreatePageInfoPanel.vue";
import CreatePageTable from "../CreatePageTable.vue";
import InternalNote from "../modal/InternalNote.vue";
import VendorInvoice from "../modal/VendorInvoice.vue";
import ReasonCancellation from "../modal/ReasonCancellation.vue";
import SendMail from "../modal/SendMail.vue";
import AddInvoiceTarget from "../modal/AddInvoiceTarget.vue";

export default {
    name: "CreatePage",
    components: {
        CreatePageInfoPanel,
        CreatePageTable,
        InternalNote,
        VendorInvoice,
        ReasonCancellation,
        SendMail,
        AddInvoiceTarget,
    },
    data() {
        return {
            forDraft: false,
            forSubmit: false,
        };
    },
    computed: {
        ...mapGetters({
            newIstruction: "newIstruction",
            newCostItems: "newCostItems",
            newGrandTotal: "newGrandTotal",
            getLinkTo: "getLinkTo",
            getAssignedVendor: "getAssignedVendor",
            getCustomer: "getCustomer",
            getInvoiceTo: "getInvoiceTo",
        }),
    },
    methods: {
        ...mapActions({
            saveNewInstruction: "saveNewInstruction",
        }),
        handleCancel() {
            this.$router.push("/");
        },
        handleForDraft() {
            this.forDraft = true;
        },
        handleForSubmit() {
            this.forSubmit = true;
        },

        async saveAsDraft() {
            const response = await this.saveNewInstruction("draft");
            await this.$router.push(`/detail/${response}`);
        },
        async submit() {
            const response = await this.saveNewInstruction("in progres");
            await this.$router.push(`/detail/${response}`);
        },
        handleSubmit() {
            if ((this.forDraft = true)) {
                this.saveAsDraft();
            } else if ((this.forSubmit = true)) {
                this.submit();
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

.container-button-bottom {
    display: flex;
    justify-content: end;
    margin-top: 2rem;
    margin-right: 2rem;
}

.container-button-bottom button:nth-child(1) {
    padding: 0.4rem 2rem;
    border: none;
    border-radius: 5px;
    font-weight: 600;
}
.container-button-bottom button:nth-child(2) {
    padding: 0.4rem 2rem;
    margin-left: 1rem;
    border: 0.6px solid black;
    border-radius: 5px;
    font-weight: 600;
}
.container-button-bottom button:nth-child(3) {
    padding: 0.4rem 4rem;
    margin-left: 1rem;
    border-radius: 5px;
    font-weight: 600;
    border: none;
    background: rgb(0, 162, 162);
    color: white;
}

#page-body {
    margin: 2rem;
}
</style>
