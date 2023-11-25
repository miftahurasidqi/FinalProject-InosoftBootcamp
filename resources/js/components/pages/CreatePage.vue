<template>
    <div id="page-body">
        <h1>3rd Party Instruction</h1>
        <form class="container-create">
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

            <div class="card">
                <button @click.prevent="saveAsDraft">Save as Daft</button>
                <button @click.prevent="submit">submit</button>
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
        saveAsDraft() {
            this.saveNewInstruction("draft");
        },
        submit() {
            this.saveNewInstruction("in progres");
        },
    },
};
// import InternalNote from "../modal/InternalNote.vue";
// import VendorInvoice from "../modal/VendorInvoice.vue";
// import ReasonCancellation from "../modal/ReasonCancellation.vue";
// import SendMail from "../modal/SendMail.vue";
// import AddInvoiceTarget from "../modal/AddInvoiceTarget.vue";
// export default {
//     name: "CreatePage",
//     components: {
//         InternalNote,
//         VendorInvoice,
//         ReasonCancellation,
//         SendMail,
//         AddInvoiceTarget,
//     },
// };
</script>

<style scoped>
* {
    padding: 0;
    margin: 0;
}
.container-create {
    background: white;
    box-shadow: 0px 0px 10px -5px black;
    border-radius: 10px;
    overflow: hidden;
}

#page-body {
    margin: 2rem;
}
</style>
