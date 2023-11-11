<template>
    <div>
        <h1>Create</h1>
        <!-- <SendMail />
        <InternalNote />
        <ReasonCancellation />
        <VendorInvoice /> -->
        <!-- <AddInvoiceTarget /> -->
    </div>
</template>

<script>
import InternalNote from "../modal/InternalNote.vue";
import VendorInvoice from "../modal/VendorInvoice.vue";
import ReasonCancellation from "../modal/ReasonCancellation.vue";
import SendMail from "../modal/SendMail.vue";
import AddInvoiceTarget from "../modal/AddInvoiceTarget.vue";
export default {
    name: "CreatePage",
    components: {
        InternalNote,
        VendorInvoice,
        ReasonCancellation,
        SendMail,
        AddInvoiceTarget,
    },
};
</script>
