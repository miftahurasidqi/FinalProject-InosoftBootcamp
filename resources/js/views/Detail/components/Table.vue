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
    name: "Table",
    computed: {
        ...mapGetters({
            costDetail: "costDetail",
        }),
    },
};
</script>

<style scoped>
.container-cd {
    margin: 0rem 2rem;
    border: none;
    border-top: 1px solid rgb(200, 200, 200);
    border-radius: 0px;
    padding-top: 1rem;
}

.container-table-cd {
    border: 1px solid rgb(189, 189, 189);
}

.container-cd p {
    font-weight: 700;
}

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

#attachment-panel {
    height: auto;
    display: flex;
    padding: 0px 10px;
    padding-bottom: 10px;
}
.a-l {
    width: 40%;
}
.a-l p {
    font-weight: 500;
    color: rgb(98, 98, 98);
}
.a-l button {
    background: rgb(0, 162, 162);
    padding: 0.3rem 2rem;
    border: none;
    border-radius: 4px;
    color: white;
    font-weight: 600;
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
.download {
    margin-right: 5px;
}
</style>
