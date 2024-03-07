<template>
    <table class="table">
        <thead>
            <tr>
                <th><p>Description</p></th>
                <th><p>QTY</p></th>
                <th><p>UOM</p></th>
                <th><p>Unit Price</p></th>
                <th><p>GST(%)</p></th>
                <th><p>Currency</p></th>
                <th class="table-detail-hasil"><p>Vat Amount</p></th>
                <th class="table-detail-hasil"><p>Sub Total</p></th>
                <th class="table-detail-hasil"><p>Total</p></th>
                <!-- <th>Charge To</th> -->
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody class="table-isi">
            <tr v-for="(costItem, index) in newCostItems" :key="index">
                <td class="table-isi-input">
                    <input
                        type="text"
                        placeholder="Enter Description"
                        v-model="costItem.description"
                    />
                </td>
                <td class="table-isi-input">
                    <input
                        type="number"
                        placeholder="Enter Qty"
                        v-model="costItem.qty"
                        @input="updateQTY(index)"
                    />
                </td>
                <td class="table-isi-select">
                    <select
                        class="form-select"
                        aria-label="Select UOM"
                        v-model="costItem.uom"
                    >
                        <option>SHP</option>
                        <option>Two</option>
                        <option>Three</option>
                    </select>
                </td>
                <td class="table-isi-input">
                    <input
                        type="number"
                        placeholder="Enter Unit Price"
                        v-model="costItem.unitPrice"
                        @input="updateUnitPrice(index)"
                    />
                </td>
                <td class="table-isi-input">
                    <input
                        type="number"
                        v-model="costItem.gst"
                        @input="updateGST(index)"
                    />
                </td>
                <td class="table-isi-select">
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
                <td class="px-3 table-isi-hasil">
                    <p>{{ costItem.vatAmount }}</p>
                </td>
                <td class="px-3 table-isi-hasil">
                    <p>{{ costItem.subTotal }}</p>
                </td>
                <td class="px-3 table-isi-hasil">
                    <p>{{ costItem.total }}</p>
                </td>

                <td style="width: 40px">
                    <button class="b-min" @click.prevent="minCostItem(index)">
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
                    <button type="button" @click="addCostItem" class="b-plus">
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
            <tr></tr>
            <tr v-for="(grandTotal, index) in newGrandTotal" :key="index">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td class="table-hasil">
                    <p>{{ grandTotal.currency }} <span> (total)</span></p>
                </td>
                <td class="table-hasil">
                    <p>{{ grandTotal.vatAmount }}</p>
                </td>
                <td class="table-hasil">
                    <p>{{ grandTotal.subTotal }}</p>
                </td>
                <td class="table-hasil">
                    <p>{{ grandTotal.total }}</p>
                </td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

export default {
    name: "CreateTable",
    computed: {
        ...mapGetters({
            newCostItems: "newCostItems",
            newGrandTotal: "newGrandTotal",
        }),
    },
    methods: {
        ...mapActions({
            addCostItem: "addCostItem",
            minCostItem: "minCostItem",
            calculateCostItem: "calculateCostItem",
            calculateGrandTotal: "calculateGrandTotal",
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
    },
};
</script>

<style scoped>
* {
    padding: 0px;
    margin: 0px;
}

thead tr th p {
    padding-left: 5px;
    width: 100px;
    /* color: red; */
}

.table-detail-hasil p {
    display: flex;
    justify-content: flex-end;
}

#create-cost-detail {
    margin: 0rem 2rem;
    border: 1px solid rgb(210, 210, 210);
}

.table-isi-input input {
    height: 35px;
    font-size: small;
    font-weight: 500;
    padding-left: 12px;
    border-radius: 3px;
    border: 1px solid rgb(165, 165, 165);
    background: rgb(250, 250, 250);
    max-width: 100px;
    /* color: rgb(165, 165, 165); */
}
.table-isi-input input::placeholder {
    color: rgb(165, 165, 165);
}

.table-isi-select select {
    height: 35px;
    font-size: small;
    font-weight: 500;
    padding-left: 12px;
    border-radius: 3px;
    border: 1px solid rgb(165, 165, 165);
    min-width: 80px;
}
.table-isi-hasil p {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    font-size: small;
    font-weight: 500;
    height: 35px;
}

.table-hasil {
    padding: 8px 16px;
}
.table-hasil p {
    display: flex;
    align-items: center;
    font-size: small;
    font-weight: 500;
    height: 20px;
    justify-content: flex-end;
    background: rgb(250, 250, 250);
}
.table-hasil span {
    padding-left: 5px;
    font-weight: 400;
    color: rgb(100, 100, 100);
}
.b-min {
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: x-large;
    height: 35px;
    width: 35px;
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
    height: 35px;
    width: 35px;
    border-radius: 5px;
    border: none;
    background: rgb(0, 190, 190);
    color: white;
}
</style>
