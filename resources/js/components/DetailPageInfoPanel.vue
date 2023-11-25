<template>
    <div id="info-panel" class="flex-row card d-flex justify-content-evenly">
        <div>
            <p>Type</p>
            <p>{{ instruction.instructionType }}</p>
        </div>
        <div>
            <p>LI No.</p>
            <p>{{ instruction.instructionID }}</p>
        </div>
        <div>
            <p>Transfer No.</p>
            <p>{{ instruction.linkTo }}</p>
        </div>
        <div>
            <p>Customer</p>
            <p>{{ instruction.customerContract }}</p>
        </div>
        <div>
            <p>Customer PO</p>
            <p>{{ instruction.NoCustomerPO }}</p>
        </div>
        <div>
            <p>Statsu</p>
            <p>{{ instruction.status }}</p>
        </div>
        <div>
            <p>Attention Of</p>
            <p>{{ instruction.attentionOf }}</p>
        </div>
        <div>
            <p>Assigned Vendor</p>
            <p>{{ instruction.assignedVendor }}</p>
        </div>
        <div>
            <p>Vendor Address</p>
            <p>{{ instruction.vendorAddress }}</p>
        </div>
    </div>
</template>

<script>
export default {
    name: "DetailPageInfoPanel",
    props: {
        instruction: {
            type: Object,
        },
    },
};
</script>
