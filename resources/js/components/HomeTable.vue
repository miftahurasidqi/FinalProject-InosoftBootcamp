<template>
    <tr @click="goToDetail" class="container-tb">
        <td>
            <p>{{ instruction.instructionId }}</p>
        </td>
        <td>
            <p v-for="item in instruction.linkTo">
                {{ item }}
            </p>
        </td>
        <td>
            <div style="display: flex">
                <img
                    src="../../assets/svg/plane-solid.svg"
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
            <p>{{ instruction.quotationNo }}</p>
        </td>
        <td>
            <p>{{ instruction.customerPO }}</p>
        </td>
        <td class="i-status">
            <p>{{ instruction.status }}</p>
        </td>
    </tr>
</template>

<script>
export default {
    name: "HomeTable",
    props: {
        instruction: {
            type: Object,
        },
    },
    methods: {
        goToDetail() {
            this.$router.push(`/detail/${this.instruction.id}`);
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
    border-bottom: 1px solid black;
}
.container-tb td {
    border-bottom: 0px;
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
</style>
