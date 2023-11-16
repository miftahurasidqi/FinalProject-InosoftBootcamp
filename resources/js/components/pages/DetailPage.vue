<template>
    <div id="page-body">
        <h1>3rd Party Instruction</h1>
        <div class="card">
            <h2>{{ instruction.instructionId }}</h2>
            <div
                id="top-panel"
                class="flex-wrap d-flex justify-content-between"
            >
                <div>
                    <p>Back</p>
                </div>
                <div
                    class="d-flex fles-row"
                    v-if="
                        instruction.status === 'In Progress' ||
                        instruction.status === 'Draft'
                    "
                >
                    <ActionButton text="Terminate" />
                    <ActionButton text="Modify" @click="goToEdit" />
                </div>
            </div>
            <DetailPageInfoPanel :instruction="instruction" />
            <!-- <hr /> -->
            <div id="cost-detail-panel" class="card">
                <h2>Cost Detail</h2>
                <DetailPageTable :instruction="instruction" />
            </div>
            <div id="attachment-panel" class="d-flex justify-content-between">
                <div>
                    <h2>Attachment</h2>
                    <button>Add Attachment</button>
                </div>
                <div>
                    <label for="notes">Notes</label>
                    <textarea name="notes" id="" cols="10" rows="10"></textarea>
                </div>
            </div>
            <div id="vendor-invoice">
                <h2>Vendor Invoice</h2>
                <button>Add Vendor Invoice</button>
            </div>
            <div id="internal-panel-header">
                <h2>For Internal Only</h2>
            </div>
            <div id="internal-panel" class="d-flex">
                <div>
                    <h3>Attachment</h3>
                    <button>Add Attachments</button>
                </div>
                <div>
                    <h3>Internal Notes</h3>
                    <button>Add Internal Note</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import DetailPageInfoPanel from "../DetailPageInfoPanel.vue";
import DetailPageTable from "../DetailPageTable.vue";
import ActionButton from "../ActionButton.vue";

export default {
    name: "DetailPage",
    components: {
        DetailPageInfoPanel,
        DetailPageTable,
        ActionButton,
    },
    mounted() {
        this.getInstructionsById(this.$route.params.id);
    },
    computed: {
        ...mapGetters({
            instruction: "instructionDetail",
        }),
        // instruction() {
        //     return this.$store.getters.getInstructionById(
        //         this.$route.params.id
        //     );
        // },
    },
    methods: {
        ...mapActions({
            getInstructionsById: "getInstructionsById",
        }),
    },
    methods: {
        goToEdit() {
            this.$router.push(`/edit/${this.instruction.id}`);
        },
    },
};
</script>

<style scoped>
#page-body {
    margin: 2rem;
}

#attachment-panel {
    height: 300px;
}

#internal-panel-header {
    background-color: black;
    color: white;
}

textarea {
    max-height: 50%;
}
</style>
