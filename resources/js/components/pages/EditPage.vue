<template>
    <div id="page-body">
        <h1>{{ formData.id }}</h1>
        <form @submit.prevent="submitForm">
            <div class="card">
                <div id="info-panel">
                    <div class="d-flex justify-content-between">
                        <select
                            class="form-select info-top-panel"
                            aria-label="Select instruction type"
                            v-model="formData.instructionType"
                            disabled
                        >
                            <option>
                                {{ instruction.instructionType }}
                            </option>
                        </select>
                        <div class="info-top-panel">
                            <p>{{ instruction.status }}</p>
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
                            <EditPageTable
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
                                    <button
                                        type="button"
                                        @click="addCostDetail"
                                    >
                                        +
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card">
                <button type="submit">submit</button>
            </div>
        </form>
    </div>
</template>

<script>
import EditPageTable from "../EditPageTable.vue";

export default {
    name: "EditPage",
    components: {
        EditPageTable,
    },
    data() {
        return {
            formData: {
                id: "",
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
    computed: {
        instruction() {
            return this.$store.getters.getInstructionById(
                this.$route.params.id,
            );
        },
    },
    mounted() {
        // menginput data dari computed ke formData
        this.formData = { ...this.instruction };
    },
    methods: {
        async submitForm() {
            // pindahkan ke actions nanti
            // berfungsi untuk mengubah data di openInstructions sesuai id
            try {
                const response = await axios.patch(
                    `/api/patchData/${this.formData.id}`,
                    this.formData,
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
</script>
