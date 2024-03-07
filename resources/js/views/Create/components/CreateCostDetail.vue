<template>
    <div
        style="
            margin: 0rem 2rem;
            padding: 1rem 0rem;
            border-top: 1px solid rgb(210, 210, 210);
        "
    >
        <h6>Cost Detail</h6>
    </div>
    <div id="create-cost-detail">
        <CreateTable />

        <CreateAttachment />
    </div>
</template>

<script>
import CreateTable from "./CreateTable.vue";
import CreateAttachment from "./CreateAttachment.vue";

export default {
    name: "CreateCostDetail",
    components: {
        CreateTable,
        CreateAttachment,
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
    border: 1px solid rgb(210, 210, 210);
}
</style>
