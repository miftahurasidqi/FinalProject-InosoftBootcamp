<template>
    <div id="page-body">
        <h1>{{ instruction.id }}</h1>
        <form @submit.prevent="submitForm">
            <div class="card">
                <div id="info-panel">
                    <div class="d-flex justify-content-between">
                        <select
                            class="form-select info-top-panel"
                            aria-label="Select instruction type"
                            v-model="instruction.instructionType"
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
                                v-model="instruction.assignedVendor"
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
                                v-model="instruction.attentionOf"
                            />
                        </div>
                        <div>
                            <label for="quotation-no">Quotation No.</label>
                            <input
                                name="quotation-no"
                                type="text"
                                placeholder="Enter Quotation"
                                v-model="instruction.vendorQuotationNo"
                            />
                        </div>
                        <div>
                            <label for="invoice-to">Invoice To</label>
                            <select
                                name="invoice-to"
                                id=""
                                v-model="instruction.invoiceTo"
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
                                v-model="instruction.vendorAddress"
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
                                v-for="(item, index) in costItem"
                                :key="index"
                                v-model:description="item.description"
                                v-model:qty="item.qty"
                                v-model:uom="item.uom"
                                v-model:unitPrice="item.unitPrice"
                                v-model:gst="item.gst"
                                v-model:currency="item.currency"
                                v-model:chargeTo="item.chargeTo"
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
import { mapGetters, mapActions } from "vuex";
import EditPageTable from "../EditPageTable.vue";
import ActionButton from "../ActionButton.vue";
export default {
    name: "EditPage",
    components: {
        EditPageTable,
    },
    data() {
        return {
            // costItems: this.instruction.costDetail.costItems,
            // grandTotal: this.instruction.costDetail.grandtotal,
        };
    },
    computed: {
        ...mapGetters({
            instruction: "editIstruction",
            costItem: "editCostItem",
            grandTotal: "editGrandTotal",
        }),
    },
    mounted() {
        this.getInstructionsById(this.$route.params.id);
    },
    methods: {
        ...mapActions({
            getInstructionsById: "getInstructionsById",
        }),
        async submitForm() {
            // pindahkan ke actions nanti
            // berfungsi untuk mengubah data di openInstructions sesuai id
            try {
                const response = await axios.patch(
                    `/api/patchData/${this.formData.id}`,
                    this.formData
                );
                console.log(response);
            } catch (error) {
                console.error(error);
            }
        },
    },
};
</script>
