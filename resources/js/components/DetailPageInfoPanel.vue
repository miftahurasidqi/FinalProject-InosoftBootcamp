<template>
    <div
        id="info-panel"
        class="flex-row p-3 m-4 card d-flex justify-content-evenly"
    >
        <div class="container-detail-left">
            <div class="container-detail">
                <div class="detail">
                    <p class="head-d-s">Type</p>
                    <p class="isi-d">{{ instruction.instructionType }}</p>
                </div>
                <div class="detail">
                    <p class="head-d-s">LI No.</p>
                    <p class="isi-d">{{ instruction.instructionID }}</p>
                </div>
                <div class="detail">
                    <p class="head-d-s">Transfer No.</p>
                    <p class="isi-d">{{ instruction.linkTo }}</p>
                </div>
                <div class="detail">
                    <p class="head-d-s">Attention Of</p>
                    <p class="isi-d">{{ instruction.attentionOf }}</p>
                </div>
            </div>
            <div class="container-detail">
                <div class="detail">
                    <p class="head-d-s">Assigned Vendor</p>
                    <p class="isi-d">{{ instruction.assignedVendor }}</p>
                </div>
                <div class="detail">
                    <p class="head-d-s">Vendor Address</p>
                    <p class="isi-d">{{ instruction.vendorAddress }}</p>
                </div>
            </div>
            <div>
                <div>
                    <p class="head-d-s">Invoice To</p>
                    <p class="isi-d">MITO</p>
                </div>
            </div>
        </div>
        <div class="container-status-right">
            <div class="status">
                <div class="detail-status">
                    <p class="head-d-s">Customer</p>
                    <p class="isi-d">{{ instruction.customerContract }}</p>
                </div>
                <div class="detail-status">
                    <p class="head-d-s">Customer PO</p>
                    <p class="isi-d">{{ instruction.NoCustomerPO }}</p>
                </div>
            </div>
            <div class="status">
                <p class="head-d-s">Status</p>
                <p class="isi-status">{{ instruction.status }}</p>
            </div>
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

<style scoped>
* {
    padding: 0px;
    margin: 0px;
}
.head-d-s {
    font-size: small;
    font-weight: 500;
    color: rgb(130, 130, 130);
}

.isi-d {
    font-weight: 700;
}

.isi-status {
    display: flex;
    width: 110px;
    justify-content: center;
    background: rgb(229, 235, 255);
    padding: 0px 20px;
    padding-bottom: 3px;
    border-radius: 10px;
    font-size: small;
    font-weight: 500;
    color: rgb(100, 100, 100);
    /* line-height: 10px; */
}
.container-detail-left {
    display: flex;
    width: 60%;
    flex-direction: column;
    justify-content: flex-start;
}
.container-detail {
    display: flex;
    margin-bottom: 2rem;
}

.container-status-right {
    display: flex;
    width: 40%;
    flex-direction: row;
    justify-content: flex-start;
    border-left: 1px dashed rgb(191, 191, 191);
    padding-left: 10px;
}
.detail {
    width: 25%;
}

.status {
    width: 50%;
}

.detail-status {
    width: 100%;
    margin-bottom: 2rem;
}
</style>
e
