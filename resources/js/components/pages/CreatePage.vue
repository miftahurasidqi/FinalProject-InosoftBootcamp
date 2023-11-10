<template>
    <div id="page-body">
        <h1>3rd Party Instruction</h1>
        <form @submit.prevent="submitForm">
            <div class="card">
                <div id="info-panel">
                    <div class="d-flex justify-content-between">
                        <select
                            class="form-select info-top-panel"
                            aria-label="Select instruction type"
                            v-model="formData.instructionType"
                        >
                            <option>Service Instruction</option>
                            <option>Logistic Instruction</option>
                            <!-- Make the option dynamic later -->
                        </select>
                        <div class="info-top-panel">
                            <p>Draft</p>
                        </div>
                    </div>
                    <div>
                        <div>
                            <label for="assigned-vendor">Assigned Vendor</label>
                            <select
                                name="assigned-vendor"
                                id=""
                                v-model="formData.assignedVendor"
                            >
                                <option disabled value="">Enter Vendor</option>
                                <option>Machine Shop</option>
                                <option>Symons Group</option>
                            </select>
                        </div>
                        <div>
                            <label for="attention-of">Attention Of</label>
                            <input
                                name="attention-of"
                                type="text"
                                placeholder="Enter Attention Of"
                                v-model="formData.attentionOf"
                            />
                        </div>
                        <div>
                            <label for="quotation-no">Quotation No.</label>
                            <input
                                name="quotation-no"
                                type="number"
                                placeholder="Enter Quotation"
                                v-model="formData.quotationNo"
                            />
                        </div>
                        <div>
                            <label for="invoice-to">Invoice To</label>
                            <select
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
                        <div>
                            <label for="vendor-address">Vendor Address</label>
                            <input
                                name="vendor-address"
                                type="text"
                                placeholder="Enter Vendor Address"
                                v-model="formData.vendorAddress"
                            />
                        </div>
                    </div>
                </div>
                <div id="create-cost-detail">
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
                                v-for="(
                                    costDetail, index
                                ) in formData.costDetails"
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
                                    <button>+</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card">
                <button>submit</button>
            </div>
        </form>
    </div>
</template>

<script>
import CreatePageTable from "../CreatePageTable.vue";

export default {
    name: "CreatePage",
    components: {
        CreatePageTable,
    },
    data() {
        return {
            formData: {
                // bagian dari v-model
                // sesuaikan dengan database
                id: "500",
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
            try {
                const response = await axios.post(
                    "/api/postData",
                    this.formData,
                );
                console.log(response);
            } catch (error) {
                console.error(error);
            }
        },
    },
};
</script>

<style scoped>
.info-top-panel {
    width: 40%;
}

#page-body {
    margin: 2rem;
}

.table-input {
    max-width: 2rem;
}
</style>
