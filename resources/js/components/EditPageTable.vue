<template>
    <tr>
        <td>
            <input
                type="text"
                placeholder="Enter Description"
                class="table-input"
                :value="description"
                @input="$emit('update:description', $event.target.value)"
            />
        </td>
        <td>
            <input
                type="number"
                placeholder="Enter Qty"
                class="table-input"
                :value="qty"
                @input="$emit('update:qty', $event.target.value)"
            />
        </td>
        <td>
            <select
                class="form-select table-input"
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
                class="table-input"
                :value="unitPrice"
                @input="$emit('update:unitPrice', $event.target.value)"
            />
        </td>
        <td>
            <input
                type="number"
                class="table-input"
                :value="gst"
                @input="$emit('update:gst', $event.target.value)"
            />
        </td>
        <td>
            <select
                class="form-select table-input"
                aria-label="Select currency"
                :value="currency"
                @input="$emit('update:currency', $event.target.value)"
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
                :value="chargeTo"
                @input="$emit('update:chargeTo', $event.target.value)"
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
</template>

<script>
export default {
    name: "EditPageTable",
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
};
</script>

<style scoped>
.table-input {
    max-width: 2rem;
}
</style>
