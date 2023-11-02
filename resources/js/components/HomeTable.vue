<template>
    <tr @click="goToDetail">
        <th>{{ instruction.instructionId }}</th>
        <td>{{ instruction.linkTo }}</td>
        <td>{{ instruction.instructionType }}</td>
        <td>{{ instruction.assignedVendor }}</td>
        <td>{{ instruction.attentionOf }}</td>
        <td>{{ instruction.quotationNo }}</td>
        <td>{{ instruction.customerPO }}</td>
        <td>{{ instruction.status }}</td>
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
            this.$router.push(`/${this.instruction.instructionId}`);
        },
    },
};
</script>
