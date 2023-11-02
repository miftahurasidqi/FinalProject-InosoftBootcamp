<template>
    <div id="page-body">
        <h1>3rd Party Instruction</h1>
        <!-- <DetailPageContent /> -->
        <div class="card">
            <h2>{{ instruction.instructionId }}</h2>
            <div id="top-panel" class="flex-wrap d-flex justify-content-between">
                <div>
                    <p>Back</p>
                </div>
                <div class="d-flex fles-row">
                    <p>Terminate</p>
                    <p>Modify</p>
                </div>
            </div>
            <div id="info-panel" class="flex-row card d-flex justify-content-evenly">
                <div>
                    <p>Type</p>
                    <p>{{ instruction.instructionType }}</p>
                </div>
                <div>
                    <p>LI No.</p>
                    <p>{{ instruction.instructionId }}</p>
                </div>
                <div>
                    <p>Transfer No.</p>
                    <p>{{ instruction.linkTo }}</p>
                </div>
                <div>
                    <p>Customer</p>
                    <p>no data yet</p>
                </div>
                <div>
                    <p>Customer PO</p>
                    <p>{{ instruction.customerPO }}</p>
                </div>
                <div>
                    <p>Statsu</p>
                    <p>{{ instruction.status }}</p>
                </div>
                <div>
                    <p>Attention Of</p>
                    <p>{{ instruction.attentionOf }}</p>
                </div>
                <div>
                    <p>Assigned Vendor</p>
                    <p>{{ instruction.assignedVendor }}</p>
                </div>
                <div>
                    <p>Vendor Address</p>
                    <p>no data yet</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
// import DetailPageContent from "../DetailPageContent.vue";

export default {
    name: "DetailPage",
    //components: {
    //    DetailPageContent,
    //},
    computed: {
        instruction() {
            return this.$store.getters["getInstructionById"](
                this.$route.params.id,
            );
        },
    },
};
</script>

<style scoped>
#page-body {
    margin: 2rem;
}
</style>
