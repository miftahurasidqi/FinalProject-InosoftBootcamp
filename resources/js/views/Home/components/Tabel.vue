<template>
    <table class="table">
        <thead class="table-h">
            <tr>
                <th><p>Instruction ID</p></th>
                <th>Link To</th>
                <th>Instruction Type</th>
                <th>Assigned Vendor</th>
                <th>Attention Of</th>
                <th>Quotation No.</th>
                <th>Customer PO</th>
                <th class="th-status">Status</th>
            </tr>
        </thead>
        <tbody class="table-b">
            <tr
                v-for="instruction in instructions"
                @click="goToDetail(instruction._id)"
                class="container-tb"
            >
                <td>
                    <p>{{ instruction.instructionID }}</p>
                </td>
                <td>
                    <p v-for="item in instruction.linkTo">
                        {{ item }}
                    </p>
                </td>
                <td>
                    <div style="display: flex">
                        <img
                            src="../../../../assets/svg/plane-solid.svg"
                            alt=""
                            class="icons-img"
                        />
                        <p>{{ instruction.instructionType }}</p>
                    </div>
                </td>
                <td>
                    <p>{{ instruction.assignedVendor }}</p>
                </td>
                <td>
                    <p>{{ instruction.attentionOf }}</p>
                </td>
                <td>
                    <p>{{ instruction.vendorQuotationNo }}</p>
                </td>
                <td>
                    <p>{{ instruction.customerContract }}</p>
                </td>
                <td class="i-status">
                    <p>{{ instruction.status }}</p>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script>
import { mapGetters } from "vuex";

export default {
    name: "HomeTable",

    computed: {
        ...mapGetters({
            instructions: "instructions",
        }),
    },
    methods: {
        goToDetail(id) {
            this.$router.push(`/detail/${id}`);
        },
    },
};
</script>

<style scoped>
.icons-img {
    height: 22px;
    width: 22px;
    margin-right: 1rem;
}
.container-tb {
    border-bottom: 1px solid rgb(200, 200, 200);
}
.container-tb td {
    border-bottom: 0px;
    font-size: small;
    font-weight: 600;
    color: rgb(98, 98, 98);
}
.i-status {
    display: flex;
    justify-content: center;
    align-items: center;
}
.i-status p {
    background: rgb(203, 230, 255);
    color: rgb(100, 100, 100);
    width: 125px;
    height: 25px;
    border-radius: 20px;
    font-size: small;
    font-weight: 500;
    display: flex;
    justify-content: center;
    align-items: center;
}
/*  */
.table-h tr th {
    background: rgb(170, 170, 170);
    height: 35px;
    color: white;
    font-weight: 500;
}
</style>
