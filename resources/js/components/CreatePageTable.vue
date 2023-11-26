<template>
    <div
        style="
            margin: 0rem 2rem;
            padding: 1rem 0rem;
            border-top: 1px solid gray;
        "
    >
        <h6>Cost Detail</h6>
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
                    <!-- <th>Charge To</th> -->
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(costItem, index) in newCostItems" :key="index">
                    <td>
                        <input
                            type="text"
                            placeholder="Enter Description"
                            class="table-input-large"
                            v-model="costItem.description"
                        />
                    </td>
                    <td>
                        <input
                            type="number"
                            placeholder="Enter Qty"
                            class="table-input-large"
                            v-model="costItem.qty"
                            @input="updateQTY(index)"
                        />
                    </td>
                    <td>
                        <select
                            class="form-select"
                            style="width: 80px"
                            aria-label="Select UOM"
                            v-model="costItem.uom"
                        >
                            <option>SHP</option>
                            <option>Two</option>
                            <option>Three</option>
                        </select>
                    </td>
                    <td>
                        <input
                            type="number"
                            placeholder="Enter Unit Price"
                            class="table-input-large"
                            v-model="costItem.unitPrice"
                            @input="updateUnitPrice(index)"
                        />
                    </td>
                    <td>
                        <input
                            type="number"
                            class="table-input-large"
                            v-model="costItem.gst"
                            @input="updateGST(index)"
                        />
                    </td>
                    <td>
                        <select
                            class="form-select"
                            aria-label="Select currency"
                            v-model="costItem.currency"
                            @change="updateCurrency()"
                        >
                            <option>USD</option>
                            <option>IDR</option>
                            <option>SGD</option>
                        </select>
                    </td>
                    <td>
                        <p>{{ costItem.vatAmount }}</p>
                    </td>
                    <td>
                        <p>{{ costItem.subTotal }}</p>
                    </td>
                    <td>
                        <p>{{ costItem.total }}</p>
                    </td>
                    <!-- <td>
                        <select
                            class="form-select table-input"
                            aria-label="Select an option"
                            v-model="costItem.chargeTo"
                        >
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                        </select>
                    </td> -->
                    <td style="width: 40px">
                        <button
                            class="b-min"
                            @click.prevent="minCostItem(index)"
                        >
                            <p
                                style="
                                    transform: translateY(-12px);
                                    font-weight: 800;
                                "
                            >
                                _
                            </p>
                        </button>
                    </td>
                    <td style="width: 40px">
                        <button
                            type="button"
                            @click="addCostItem"
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
                <tr>
                    <!-- <td>
                        <button
                            type="button"
                            @click="addCostItem"
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
                    </td> -->
                </tr>
                <tr v-for="(grandTotal, index) in newGrandTotal" :key="index">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        <p>{{ grandTotal.currency }} (total)</p>
                    </td>
                    <td>
                        <p>{{ grandTotal.vatAmount }}</p>
                    </td>
                    <td>
                        <p>{{ grandTotal.subTotal }}</p>
                    </td>
                    <td>
                        <p>{{ grandTotal.total }}</p>
                    </td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
        <div id="attachment-panel" class="container-a">
            <div class="a-l">
                <p>Attachment</p>
                <div
                    v-for="(file, index) in newAttacmentFile"
                    class="file-item"
                >
                    <p>{{ file.name }}</p>
                    <p>by user 13/11/2023</p>
                    <button @click.prevent="removeAttachmentFile(index)">
                        Remove
                    </button>
                </div>
                <label for="add-attachment-file" class="buttons"
                    >+ Add Attachment</label
                >
                <input
                    hidden
                    id="add-attachment-file"
                    type="file"
                    @change="handleInputFile"
                />
            </div>
            <div class="a-r">
                <label for="notes">Notes</label>
                <textarea
                    v-model="newNote"
                    @input="updateNewNote"
                    name="notes"
                    id="notes"
                ></textarea>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
export default {
    name: "CreatePageTable",
    data() {
        return {
            newNote: "",
        };
    },
    props: {
        newCostItems: Array,
        newGrandTotal: Array,
    },
    computed: {
        ...mapGetters({
            newAttacmentFile: "newAttacmentFile",
            Note: "newNote",
        }),
    },
    methods: {
        ...mapActions({
            addCostItem: "addCostItem",
            minCostItem: "minCostItem",
            calculateCostItem: "calculateCostItem",
            calculateGrandTotal: "calculateGrandTotal",
            addAttacmentFile: "addAttacmentFile",
            minAttachmentFile: "minAttachmentFile",
        }),
        strToInt(str) {
            return str === "" ? 0 : parseInt(str);
        },
        updateQTY(index) {
            this.calculateCostItem(index);
        },
        updateUnitPrice(index) {
            this.calculateCostItem(index);
        },
        updateGST(index) {
            this.calculateCostItem(index);
        },
        updateCurrency() {
            this.calculateGrandTotal();
        },
        handleInputFile(e) {
            this.addAttacmentFile(e.target.files[0]);
        },
        removeAttachmentFile(i) {
            this.minAttachmentFile(i);
        },
        updateNewNote() {
            this.$store.commit("updateNewNote", this.newNote);
        },
    },
};
</script>

<style scoped>
* {
    padding: 0px;
    margin: 0px;
}
#create-cost-detail {
    margin: 0rem 2rem;
    border: 1px solid rgb(165, 165, 165);
}

.table-input-large {
    max-width: 150px;
}

.b-min {
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: x-large;
    height: 30px;
    width: 30px;
    border-radius: 5px;
    border: none;
}
.table thead tr th {
    font-size: small;
    line-height: 26px;
    padding: 5px;
    background: rgb(165, 165, 165);
    color: white;
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

.container-a {
    display: flex;
    margin: 2rem 10px;
}
.buttons {
    background: rgb(0, 162, 162);
    padding: 0.3rem 2rem;
    border: none;
    border-radius: 4px;
    color: white;
    font-weight: 600;
    cursor: pointer;
    margin-top: 1rem;
}

.a-l {
    width: 40%;
}
.a-l p {
    font-weight: 500;
    color: rgb(98, 98, 98);
}
.a-r {
    display: flex;
    flex-direction: column;
    width: 60%;
}

.a-r label {
    font-size: medium;
    font-weight: 500;
    color: rgb(98, 98, 98);
}

.a-r textarea {
    border: none;
    height: 100px;
    background: rgb(245, 245, 245);
}
</style>
