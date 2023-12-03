<template>
    <div id="info-panel">
        <div class="d-flex justify-content-between h-pilihan">
            <div class="pilihan-left">
                <select
                    class="form-select info-top-panel bg-b"
                    aria-label="Select instruction type"
                    v-model="newIstruction.instructionType"
                >
                    <option disabled value="">Select Instruction</option>
                    <option>Service Instruction</option>
                    <option>Logistic Instruction</option>
                    <!-- Make the option dynamic later -->
                </select>
            </div>
            <div class="info-top-panel pilihan-right">
                <p>Draft</p>
            </div>
        </div>
        <div class="container-content-1">
            <div class="container-content-1-left">
                <div class="content-1-top" style="margin-bottom: 1rem">
                    <div class="pilihan" style="width: 260px">
                        <label>Link To </label>
                        <div @click.prevent="toggleOptions" class="bg-b">
                            <p v-if="newIstruction.linkTo.length == 0">
                                Enter Link To
                            </p>
                            <p v-else class="overflow-h">
                                <span
                                    v-for="(item, i) in newIstruction.linkTo"
                                    :key="i"
                                >
                                    <span>{{ item }}</span
                                    >,
                                </span>
                            </p>
                        </div>
                        <div v-if="isShowLinkTo" class="absolute">
                            <label
                                class="flex"
                                name="linkTo"
                                id="linkTo"
                                v-for="(item, index) in getLinkTo"
                                :key="index"
                            >
                                <p>
                                    {{ item }}
                                </p>
                                <input
                                    type="checkbox"
                                    v-model="newIstruction.linkTo"
                                    :value="item"
                                />
                            </label>
                        </div>
                    </div>

                    <div class="pilihan" style="width: 260px">
                        <label for="assigned-vendor">Assigned Vendor</label>
                        <select
                            class="bg-b"
                            name="assigned-vendor"
                            id=""
                            v-model="newIstruction.assignedVendor"
                        >
                            <option disabled value="">Enter Vendor</option>
                            <option>Machine Shop</option>
                            <option>Symons Group</option>
                        </select>
                    </div>
                    <div class="pilihan" style="width: 260px">
                        <label for="attention-of">Attention Of</label>
                        <input
                            class="bg-b"
                            name="attention-of"
                            type="text"
                            placeholder="Enter Attention Of"
                            v-model="newIstruction.attentionOf"
                            required
                        />
                    </div>
                </div>
                <div class="content-1-top">
                    <div class="pilihan" style="width: 260px">
                        <label for="quotation-no">Quotation No.</label>
                        <input
                            class="bg-b"
                            name="quotation-no"
                            type="text"
                            placeholder="Enter Quotation"
                            v-model="newIstruction.vendorQuotationNo"
                        />
                    </div>
                    <div class="pilihan" style="width: 260px">
                        <label for="invoice-to">Invoice To</label>
                        <select
                            class="bg-b"
                            name="invoice-to"
                            id=""
                            v-model="newIstruction.invoiceTo"
                        >
                            <option disabled value="">Select an Option</option>
                            <option>MITO</option>
                            <option>Something</option>
                        </select>
                    </div>
                    <div class="pilihan" style="width: 260px">
                        <label for="vendor-address">Vendor Address</label>
                        <input
                            class="bg-b"
                            name="vendor-address"
                            type="text"
                            placeholder="Enter Vendor Address"
                            v-model="newIstruction.vendorAddress"
                        />
                    </div>
                </div>
            </div>
            <div class="container-content-1-right">
                <div class="pilihan" style="margin-bottom: 1rem">
                    <label for="customer-contract">Customer - Contract</label>
                    <select
                        name="customer-contract"
                        class="bg-b"
                        v-model="newIstruction.customerContract"
                    >
                        <option disabled value="">Select customer</option>
                        <option>Customer 1</option>
                        <option>Customer 2</option>
                    </select>
                </div>
                <div class="pilihan">
                    <label for="customerPO">Customer PO No.</label>
                    <input
                        class="bg-b"
                        name="customerPO"
                        type="text"
                        placeholder="Enter Customer PO"
                        v-model="newIstruction.NoCustomerPO"
                    />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "CreatePageInfoPanel",
    props: {
        newIstruction: {
            type: Object,
        },
        getLinkTo: {
            type: Array,
        },
        getAssignedVendor: {
            type: Array,
        },
        getCustomer: {
            type: Array,
        },
        getInvoiceTo: {
            type: Array,
        },
    },
    data() {
        return {
            isShowLinkTo: false,
        };
    },
    methods: {
        toggleOptions() {
            this.isShowLinkTo = !this.isShowLinkTo;
        },
    },
};
</script>

<style scoped>
* {
    padding: 0;
    margin: 0;
}

.pilihan-left {
    width: 550px;
}
.h-pilihan {
    padding: 2rem;
}
.pilihan-left select {
    padding-left: 1rem;
}
.pilihan-right {
    display: flex;
    justify-content: flex-end;
}
.pilihan-right p {
    background: rgb(243, 243, 243);
    color: rgb(75, 75, 75);
    padding: 0px 50px;
    border-radius: 25px;
    font-size: small;
    font-weight: 600;
    line-height: 25px;
}
.container-content-1 {
    display: flex;
    margin-bottom: 2rem;
}
.container-content-1-left {
    width: 80%;
    display: flex;
    flex-direction: column;
    padding-left: 16rem;
    padding-right: 10px;
}
.content-1-top {
    display: flex;
    width: 100%;
    justify-content: space-between;
}

.container-content-1-right {
    width: 20%;
    padding-left: 10px;
    padding-right: 2rem;
}
.pilihan {
    display: flex;
    flex-direction: column;
}

.info-top-panel {
    width: 40%;
}

.bg-b {
    background: rgb(243, 243, 243);
    color: rgb(75, 75, 75);
    font-size: small;
    font-weight: 600;
    padding: 4px 6px;
    border: 1px solid rgb(75, 75, 75);
    width: 190px;
}
.flex {
    display: flex;
    justify-content: space-between;
    /* width: 1; */
    border: 1px solid rgb(75, 75, 75);
    padding: 4px 6px;
}

.absolute {
    position: absolute;
    border: 1px solid rgb(75, 75, 75);
    background: rgb(243, 243, 243);
    color: rgb(75, 75, 75);
    font-size: small;
    font-weight: 600;
    width: 190px;
    margin-top: 55px;
    max-height: 400px;
    overflow-y: scroll;
}

.is-close {
    display: none;
}

.overflow-h {
    height: 20px;
    overflow: hidden;
}
</style>
