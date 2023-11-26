<template>
    <table class="table">
        <thead class="table-head">
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
            </tr>
        </thead>
        <tbody class="table-body">
            <tr v-for="(detail, index) in costDetail.costItems" :key="index">
                <td>{{ detail.description }}</td>
                <td>{{ detail.qty }}</td>
                <td>{{ detail.uom }}</td>
                <td>{{ detail.unitPrice }}</td>
                <td>{{ detail.gst }}</td>
                <td>{{ detail.currency }}</td>
                <td>{{ detail.vatAmount }}</td>
                <td>{{ detail.subTotal }}</td>
                <td>{{ detail.total }}</td>
                <td>{{ detail.chargeTo }}</td>
            </tr>
            <tr
                v-for="(detail, index) in costDetail.grandTotal"
                :key="index"
                class="table-body-2"
            >
                <td class="bg-white"></td>
                <td class="bg-white"></td>
                <td class="bg-white"></td>
                <td class="bg-white"></td>
                <td>Grand Total</td>
                <td>{{ detail.currency }}</td>
                <td>{{ detail.vatAmount }}</td>
                <td>{{ detail.subTotal }}</td>
                <td>{{ detail.total }}</td>
                <td>{{ detail.chargeTo }}</td>
            </tr>
        </tbody>
    </table>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

export default {
    name: "DetailPageTable",
    computed: {
        ...mapGetters({
            costDetail: "costDetail",
        }),
    },
    methods: {
        ...mapActions({
            getInstructionsById: "getInstructionsById",
        }),
    },
};
</script>

<style scoped>
.table-head tr th {
    background: rgb(165, 165, 165);
    color: white;
    font-size: small;
}

.table-body tr td {
    font-size: small;
    font-weight: 600;
    color: rgb(120, 120, 120);
    background: rgb(250, 250, 250);
}
.table-body-2 td {
    border: none;
}
</style>
