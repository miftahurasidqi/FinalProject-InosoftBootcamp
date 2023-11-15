<template>
    <tr>
        <td>
            <input
                type="text"
                placeholder="Enter Description"
                class="table-input-large"
                :value="description"
                @input="$emit('update:description', $event.target.value)"
            />
        </td>
        <td>
            <input
                type="number"
                placeholder="Enter Qty"
                class="table-input-large"
                :value="qty"
                @input="updateQTY($event.target.value)"
            />
        </td>
        <td>
            <select
                class="form-select"
                style="width: 80px"
                aria-label="Select UOM"
                :value="uom"
                @input="$emit('update:uom', $event.target.value)"
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
                :value="unitPrice"
                @input="updateUnitPrice($event.target.value)"
            />
        </td>
        <td>
            <input
                type="number"
                class="table-input-large"
                :value="gst"
                @input="updateGST($event.target.value)"
            />
        </td>
        <td>
            <select
                class="form-select"
                aria-label="Select currency"
                :value="currency"
                @input="$emit('update:currency', $event.target.value)"
            >
                <option>USD</option>
                <option>IDR</option>
                <option>SGD</option>
            </select>
        </td>
        <td>
            <p>{{ vatAmount }}</p>
        </td>
        <td>
            <p>{{ subTotal }}</p>
        </td>
        <td>
            <p>{{ total }}</p>
        </td>
        <td>
            <select
                class="form-select table-input"
                aria-label="Select an option"
                :value="chargeTo"
                @input="$emit('update:chargeTo', $event.target.value)"
            >
                <option>1</option>
                <option>2</option>
                <option>3</option>
            </select>
        </td>
        <td>
            <button class="b-min" @click.prevent="minCostDetail(this.index)">
                <p style="transform: translateY(-4px)">_</p>
            </button>
        </td>
    </tr>
</template>

<script>
import { mapActions } from "vuex";
export default {
    name: "CreatePageTable",
    props: {
        description: String,
        qty: Number,
        uom: String,
        unitPrice: Number,
        gst: Number,
        currency: String,
        vatAmount: Number,
        subTotal: Number,
        total: Number,
        chargeTo: String,
        index: Number,
    },
    emits: [
        "update:description",
        "update:qty",
        "update:uom",
        "update:unitPrice",
        "update:gst",
        "update:currency",
        "update:vatAmount",
        "update:subTotal",
        "update:total",
        "update:chargeTo",
    ],
    methods: {
        ...mapActions({
            minCostDetail: "minCostDetail",
        }),
        calculate(qty, unitPrice, gst) {
            const subTotal = qty * unitPrice;
            const vatAmount = (subTotal * gst) / 100;
            const total = subTotal + vatAmount;

            this.$emit("update:subTotal", subTotal);
            this.$emit("update:vatAmount", vatAmount);
            this.$emit("update:total", total);
        },
        strToInt(str) {
            return str === "" ? 0 : parseInt(str);
        },
        updateQTY(value) {
            const qty = this.strToInt(value);

            this.$emit("update:qty", qty);
            this.calculate(qty, this.unitPrice, this.gst);
        },
        updateUnitPrice(value) {
            const unitPrice = this.strToInt(value);

            this.$emit("update:unitPrice", unitPrice);
            this.calculate(this.qty, unitPrice, this.gst);
        },
        updateGST(value) {
            const gst = this.strToInt(value);

            this.$emit("update:gst", gst);
            this.calculate(this.qty, this.unitPrice, gst);
        },
    },
};
</script>

<style scoped>
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
</style>
