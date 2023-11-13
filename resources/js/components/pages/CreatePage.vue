<template>
    <div id="page-body">
        <h1>3rd Party Instruction</h1>
        <form @submit.prevent="submitForm" class="container-create">
            <div id="info-panel">
                <div class="d-flex justify-content-between h-pilihan">
                    <div class="pilihan-left">
                        <select
                            class="form-select info-top-panel bg-b"
                            aria-label="Select instruction type"
                            v-model="formData.instructionType"
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
                            <div class="pilihan" style="width: 190px">
                                <label for="assigned-vendor"
                                    >Assigned Vendor</label
                                >
                                <select
                                    class="bg-b"
                                    name="assigned-vendor"
                                    id=""
                                    v-model="formData.assignedVendor"
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
                                    v-model="formData.attentionOf"
                                />
                            </div>
                            <div class="pilihan" style="width: 190px">
                                <label for="quotation-no">Quotation No.</label>
                                <input
                                    class="bg-b"
                                    name="quotation-no"
                                    type="number"
                                    placeholder="Enter Quotation"
                                    v-model="formData.quotationNo"
                                />
                            </div>
                            <div class="pilihan" style="width: 190px">
                                <label for="invoice-to">Invoice To</label>
                                <select
                                    class="bg-b"
                                    name="invoice-to"
                                    id=""
                                    v-model="formData.invoiceTo"
                                >
                                    <option disabled value="">
                                        Select an Option
                                    </option>
                                    <option>MITO</option>
                                    <option>Something</option>
                                </select>
                            </div>
                        </div>
                        <div class="content-1-bot pilihan">
                            <label for="vendor-address">Vendor Address</label>
                            <input
                                class="bg-b"
                                name="vendor-address"
                                type="text"
                                placeholder="Enter Vendor Address"
                                v-model="formData.vendorAddress"
                            />
                        </div>
                    </div>
                    <div class="container-content-1-right">
                        <div class="pilihan" style="margin-bottom: 1rem">
                            <label for="customer-contract"
                                >Customer - Contract</label
                            >
                            <select name="customer-contract" class="bg-b">
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
                            v-for="(costDetail, index) in formData.costDetails"
                            :key="index"
                            v-model:description="
                                formData.costDetails[index].description
                            "
                            v-model:qty="formData.costDetails[index].qty"
                            v-model:uom="formData.costDetails[index].uom"
                            v-model:unitPrice="
                                formData.costDetails[index].unitPrice
                            "
                            v-model:gst="formData.costDetails[index].gst"
                            v-model:currency="
                                formData.costDetails[index].currency
                            "
                            v-model:chargeTo="
                                formData.costDetails[index].chargeTo
                            "
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
                <button type="submit">submit</button>
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
    data() {
        return {
            formData: {
                // bagian dari v-model
                // sesuaikan dengan database
                // formdata ini adalah object yang bakal didorong ke openInstructions
                id: "5010",
                instructionType: "",
                assignedVendor: "",
                attentionOf: "",
                quotationNo: 0,
                invoiceTo: "",
                vendorAddress: "",
                costDetails: [
                    {
                        description: "",
                        qty: 0,
                        uom: "",
                        unitPrice: 0,
                        gst: 0,
                        currency: "",
                        vatAmount: 0,
                        subTotal: 0,
                        total: 0,
                        chargeTo: "",
                    },
                ],
                status: "In Progress",
            },
        };
    },
    methods: {
        async submitForm() {
            // pindahkan ke actions nanti
            // berfungsi untuk menambah data ke openInstructions
            try {
                const response = await axios.post(
                    "/api/postData",
                    this.formData
                );
                console.log(response);
            } catch (error) {
                console.error(error);
            }
        },
        addCostDetail() {
            // berfungsi untuk mendorong object ini
            // biarin aja gini, udah dicoba dimasukin ke data
            // hasilnya malah table 2 dan seterusnya sama
            this.formData.costDetails.push({
                description: "",
                qty: 0,
                uom: "",
                unitPrice: 0,
                gst: 0,
                currency: "",
                vatAmount: 0,
                subTotal: 0,
                total: 0,
                chargeTo: "",
            });
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
    justify-content: end;
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
    align-items: end;
    padding-left: 16rem;
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
