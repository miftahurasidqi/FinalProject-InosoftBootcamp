<template>
    <div id="info-panel">
        <div class="d-flex justify-content-between h-pilihan">
            <div class="pilihan-left">
                <select
                    class="info-top-panel"
                    aria-label="Select instruction type"
                    v-model="newIstruction.instructionType"
                >
                    <option disabled value="">Select Instruction</option>
                    <option>Service Instruction</option>
                    <option>Logistic Instruction</option>
                    <!-- Make the option dynamic later -->
                </select>
            </div>
            <div class="pilihan-right">
                <p>Draft</p>
            </div>
        </div>

        <div class="container-content-1">
            <div class="container-content-1-left">
                <div class="content-1-top" style="margin-bottom: 1rem">
                    <div class="pilihan">
                        <label>Link To </label>
                        <div @click.prevent="toggleOptions" class="link-to">
                            <p
                                v-if="newIstruction.linkTo.length == 0"
                                class="select-placeholder"
                            >
                                Select Link To
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
                    <div class="pilihan">
                        <label for="attention-of">Attention Of</label>
                        <input
                            class="link-to"
                            name="attention-of"
                            type="text"
                            placeholder="Enter Attention Of"
                            v-model="newIstruction.attentionOf"
                            required
                        />
                    </div>
                    <div class="pilihan">
                        <label for="invoice-to">Invoice To</label>
                        <select
                            class="link-to"
                            name="invoice-to"
                            id=""
                            v-model="newIstruction.invoiceTo"
                        >
                            <option
                                class="select-placeholder"
                                disabled
                                value=""
                            >
                                Select an Option
                            </option>
                            <option>MITO</option>
                            <option>Something</option>
                        </select>
                    </div>
                </div>
                <div class="content-1-top">
                    <div class="pilihan">
                        <label for="assigned-vendor">Assigned Vendor</label>
                        <select
                            class="link-to"
                            name="assigned-vendor"
                            id=""
                            v-model="newIstruction.assignedVendor"
                        >
                            <option disabled value="">
                                Select Assigned Vendor
                            </option>
                            <option>Machine Shop</option>
                            <option>Symons Group</option>
                        </select>
                    </div>
                    <div class="pilihan">
                        <label for="vendor-address">Vendor Address</label>
                        <input
                            class="link-to"
                            name="vendor-address"
                            type="text"
                            placeholder="Select Vendor Address"
                            v-model="newIstruction.vendorAddress"
                        />
                    </div>
                    <div class="pilihan">
                        <label for="quotation-no">Vendor Quotation No.</label>
                        <input
                            class="link-to"
                            name="quotation-no"
                            type="text"
                            placeholder="Enter Vendor Quotation No."
                            v-model="newIstruction.vendorQuotationNo"
                        />
                    </div>
                </div>
            </div>
            <div class="container-content-1-right">
                <div class="pilihan-p-l" style="margin-bottom: 1rem">
                    <label for="customer-contract">Customer - Contract</label>
                    <select
                        name="customer-contract"
                        class="link-to"
                        v-model="newIstruction.customerContract"
                    >
                        <option disabled value="">Select customer</option>
                        <option>Customer 1</option>
                        <option>Customer 2</option>
                    </select>
                </div>
                <div class="pilihan-p-l">
                    <label for="customerPO">Customer PO No.</label>
                    <input
                        class="link-to"
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
import { mapGetters } from "vuex";

export default {
    name: "CreateInfoPanel",

    computed: {
        ...mapGetters({
            newIstruction: "newIstruction",
            getAssignedVendor: "getAssignedVendor",
            getInvoiceTo: "getInvoiceTo",
            getCustomer: "getCustomer",
            getLinkTo: "getLinkTo",
        }),
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

#info-panel {
    border: 1px solid rgb(210, 210, 210);
    margin: 0rem 2rem;
    border-radius: 3px;
    margin-top: 2rem;
    margin-bottom: 1rem;
}
.h-pilihan {
    padding: 0rem 2rem;
    padding-top: 2rem;
    margin-bottom: 15px;
}

.link-to {
    display: flex;
    align-items: center;
    height: 35px;
    background: rgb(250, 250, 250);
    cursor: pointer;
    font-size: small;
    font-weight: 400;
    padding: 4px 6px;
    border: 1px solid rgb(210, 210, 210);
    border-radius: 3px;
    padding-left: 10px;
    max-width: 180px;
}
.link-to option {
    color: black;
}
.pilihan-left select {
    padding-left: 1rem;
    height: 35px;
    width: 240px;
    border-radius: 3px;
    background: rgb(250, 250, 250);
    border: 1px solid rgb(210, 210, 210);
}

.pilihan-right {
    display: flex;
    align-items: center;
}
.pilihan-right p {
    display: flex;
    width: 130px;
    height: 25px;
    justify-content: center;
    align-items: center;
    background: rgb(240, 240, 240);
    color: rgb(75, 75, 75);
    border: 1px solid rgb(210, 210, 210);
    border-radius: 25px;
    font-size: small;
    font-weight: 600;
}
.container-content-1 {
    display: flex;
    margin-bottom: 2rem;
}
.container-content-1-left {
    width: 80%;
    display: flex;
    flex-direction: column;
    padding-left: 15.5rem;
    padding-bottom: 1rem;
    border-right: 1px dashed rgb(160, 160, 160);
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
    width: 280px;
    font-size: small;
    margin-left: 2rem;
}

.pilihan label {
    margin-bottom: 3px;
}

.pilihan-p-l {
    display: flex;
    flex-direction: column;
    font-size: small;
    width: 255px;
}
.pilihan-p-l label {
    margin-bottom: 3px;
}
.pilihan-p-l input::placeholder {
    color: rgb(165, 165, 165);
}
.pilihan input::placeholder {
    color: rgb(165, 165, 165);
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

.select-placeholder {
    color: rgb(165, 165, 165);
}
</style>
