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
                                type="text"
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
                            <tr>
                                <td>
                                    <input
                                        type="text"
                                        placeholder="Enter Description"
                                        class="table-input"
                                        v-model="
                                            formData.costDetails.description
                                        "
                                    />
                                </td>
                                <td>
                                    <input
                                        type="text"
                                        placeholder="Enter Qty"
                                        class="table-input"
                                        v-model="formData.costDetails.qty"
                                    />
                                </td>
                                <td>
                                    <select
                                        class="form-select table-input"
                                        aria-label="Select UOM"
                                        v-model="formData.costDetails.uom"
                                    >
                                        <option>SHP</option>
                                        <option>Two</option>
                                        <option>Three</option>
                                    </select>
                                </td>
                                <td>
                                    <input
                                        type="text"
                                        placeholder="Enter Unit Price"
                                        class="table-input"
                                        v-model="formData.costDetails.unitPrice"
                                    />
                                </td>
                                <td>
                                    <input
                                        type="text"
                                        class="table-input"
                                        v-model="formData.costDetails.gst"
                                    />
                                </td>
                                <td>
                                    <select
                                        class="form-select table-input"
                                        aria-label="Select currency"
                                        v-model="formData.costDetails.currency"
                                    >
                                        <option>USD</option>
                                        <option>IDR</option>
                                        <option>SGD</option>
                                    </select>
                                </td>
                                <td><p>0</p></td>
                                <td><p>0</p></td>
                                <td><p>0</p></td>
                                <td>
                                    <select
                                        class="form-select table-input"
                                        aria-label="Select an option"
                                        v-model="formData.costDetails.chargeTo"
                                    >
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                    </select>
                                </td>
                                <td>
                                    <button>-</button>
                                </td>
                            </tr>
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
export default {
    name: "CreatePage",
    data() {
        return {
            formData: {
                // bagian dari v-model
                // sesuaikan dengan database
                id: 5000,
                instructionType: "",
                assignedVendor: "",
                attentionOf: "",
                quotationNo: "",
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
