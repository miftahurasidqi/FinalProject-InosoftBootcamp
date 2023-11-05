<template>
    <table class="table">
        <thead>
            <tr>
                <th>Description</th>
                <th>QTY</th>
                <th>UOM</th>
                <th>Unit Price</th>
                <th>Discount</th>
                <th>GST(%)</th>
                <th>Currency</th>
                <th>Vat Amount</th>
                <th>Sub Total</th>
                <th>Total</th>
                <th>Charge To</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="detail in instruction.costDetails">
                <td>{{ detail.description }}</td>
                <td>{{ detail.qty }}</td>
                <td>{{ detail.uom }}</td>
                <td>{{ detail.unitPrice }}</td>
                <td>{{ detail.discount }}</td>
                <td>{{ detail.gst }}</td>
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
export default {
    name: "DetailPageTable",
    props: {
        instruction: {
            type: Object,
        },
    },
};
</script>
