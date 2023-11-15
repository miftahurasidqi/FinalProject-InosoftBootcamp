<template>
    <div id="page-body">
        <h1>3rd Party Instruction</h1>
        <form class="container-create">
            <div id="info-panel">
                <div class="d-flex justify-content-between h-pilihan">
                    <div class="pilihan-left">
                        <select
                            class="form-select info-top-panel bg-b"
                            aria-label="Select instruction type"
                            v-model="newIstruction.instructionType"
                        >
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
                            <!--  -->
                            <div class="pilihan" style="width: 190px">
                                <label @click="toggleOptions">
                                    > link To
                                </label>
                                <div>
                                    <label
                                        class="bg-b"
                                        name="linkTo"
                                        id="linkTo"
                                        v-for="(item, index) in getLinkTo"
                                        :key="index"
                                    >
                                        <input
                                            type="checkbox"
                                            v-model="newIstruction.linkTo"
                                            :value="item"
                                        />
                                        {{ item }}
                                    </label>
                                </div>
                            </div>

                            <div class="pilihan" style="width: 190px">
                                <label for="assigned-vendor"
                                    >Assigned Vendor</label
                                >
                                <select
                                    class="bg-b"
                                    name="assigned-vendor"
                                    id=""
                                    v-model="newIstruction.assignedVendor"
                                >
                                    <option disabled value="">
                                        Enter Vendor
                                    </option>
                                    <option>Machine Shop</option>
                                    <option>Symons Group</option>
                                </select>
                            </div>
                            <div class="pilihan" style="width: 190px">
                                <label for="attention-of">Attention Of</label>
                                <input
                                    class="bg-b"
                                    name="attention-of"
                                    type="text"
                                    placeholder="Enter Attention Of"
                                    v-model="newIstruction.attentionOf"
                                />
                            </div>
                        </div>
                        <div class="content-1-top">
                            <div class="pilihan" style="width: 190px">
                                <label for="quotation-no">Quotation No.</label>
                                <input
                                    class="bg-b"
                                    name="quotation-no"
                                    type="number"
                                    placeholder="Enter Quotation"
                                    v-model="newIstruction.vendorQuotationNo"
                                />
                            </div>
                            <div class="pilihan" style="width: 190px">
                                <label for="invoice-to">Invoice To</label>
                                <select
                                    class="bg-b"
                                    name="invoice-to"
                                    id=""
                                    v-model="newIstruction.invoiceTo"
                                >
                                    <option disabled value="">
                                        Select an Option
                                    </option>
                                    <option>MITO</option>
                                    <option>Something</option>
                                </select>
                            </div>
                            <div class="pilihan" style="width: 190px">
                                <label for="vendor-address"
                                    >Vendor Address</label
                                >
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
                            <label for="customer-contract"
                                >Customer - Contract</label
                            >
                            <select
                                name="customer-contract"
                                class="bg-b"
                                v-model="newIstruction.customer"
                            >
                                <option disabled value="">
                                    Select customer
                                </option>
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
            <div
                style="
                    margin: 0rem 2rem;
                    padding: 1rem 0rem;
                    border-top: 1px solid gray;
                "
            >
                <h6>Cost Detail</h6>
            </div>
            <div id="create-cost-detail" style="margin: 0rem 2rem">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Description</th>
                            <th>QTY</th>
                            <th>UOM</th>
                            <th>Unit Price</th>
                            <th>GST(%)</th>
                            <th>Currency</th>
                            <th>Vat Amount</th>
                            <th>Sub Total</th>
                            <th>Total</th>
                            <th>Charge To</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <CreatePageTable
                            v-for="(costDetail, index) in newCostDetail"
                            :key="index"
                            v-model:description="costDetail.description"
                            v-model:qty="costDetail.qty"
                            v-model:uom="costDetail.uom"
                            v-model:unitPrice="costDetail.unitPrice"
                            v-model:gst="costDetail.gst"
                            v-model:currency="costDetail.currency"
                            v-model:vatAmount="costDetail.vatAmount"
                            v-model:subTotal="costDetail.subTotal"
                            v-model:total="costDetail.total"
                            v-model:chargeTo="costDetail.chargeTo"
                            :index="index"
                        />
                        <tr>
                            <td>
                                <button
                                    type="button"
                                    @click="addCostDetail"
                                    class="b-plus"
                                >
                                    <p
                                        style="
                                            transform: translateY(-3px);
                                            font-weight: 700;
                                        "
                                    >
                                        +
                                    </p>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
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
import CreatePageTable from "../CreatePageTable.vue";
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
        CreatePageTable,
    },
    computed: {
        ...mapGetters({
            newIstruction: "newIstruction",
            newCostDetail: "newCostDetail",
            getLinkTo: "getLinkTo",
            getAssignedVendor: "getAssignedVendor",
            getCustomer: "getCustomer",
            getInvoiceTo: "getInvoiceTo",
        }),
    },
    methods: {
        ...mapActions({
            saveNewInstruction: "saveNewInstruction",
            addCostDetail: "addCostDetail",
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
    align-items: flex-end;
    padding-left: 8rem;
    padding-right: 10px;
}
.content-1-top {
    display: flex;
    width: 100%;
    justify-content: space-between;
}

.content-1-bot {
    display: flex;
    flex-direction: column;
    width: 100%;
}

.container-content-1-right {
    width: 20%;
    padding-left: 10px;
    padding-right: 2rem;
}

.table thead tr th {
    font-size: small;
    padding: 5px;
    background: slategray;
    color: white;
}

.pilihan {
    display: flex;
    flex-direction: column;
}
.b-plus {
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: x-large;
    height: 30px;
    width: 30px;
    border-radius: 5px;
    border: none;
    background: rgb(95, 190, 155);
    color: white;
}

.info-top-panel {
    width: 40%;
}

#page-body {
    margin: 2rem;
}

.table-input {
    max-width: 2rem;
}

.bg-b {
    background: rgb(243, 243, 243);
    color: rgb(75, 75, 75);
    font-size: small;
    font-weight: 600;
    padding: 4px 6px;
    border: 1px solid rgb(75, 75, 75);
}
</style>
