<template>
    <div class="card">
        <h2>{{ instruction.instructionId }}</h2>
        <div class="d-flex justify-content-between">
            <div>
                <p>Back</p>
            </div>
            <div class="d-flex fles-row">
                <p>Terminate</p>
                <p>Modify</p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "DetailPageContent",
    computed: {
        instruction() {
            return this.$store.getters["getInstructionById"](
                this.$route.params.id,
            );
        },
    },
};
</script>
