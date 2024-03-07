<template>
    <div id="page-body">
        <h1 style="margin-bottom: 8px">3rd Party Instruction</h1>
        <form
            class="card"
            style="padding-bottom: 2rem"
            @submit.prevent="handleSubmit"
        >
            <EditPageInfoPanel
                :editInstruction="editInstruction"
                :getAssignedVendor="getAssignedVendor"
                :getCustomer="getCustomer"
                :getInvoiceTo="getInvoiceTo"
                :getLinkTo="getLinkTo"
            />
            <EditPageTable
                :newCostItems="newCostItems"
                :newGrandTotal="newGrandTotal"
                :newAttacmentFile="newAttacmentFile"
                :note="note"
            />
            <div class="container-button-bottom">
                <button type="button" @click="handleCancel">Cancel</button>
                <button
                    v-if="editInstruction.status == 'draft'"
                    type="submit"
                    @click="handleForDraft"
                >
                    Save as Daft
                </button>
                <button type="submit" @click="handleForSubmit">Submit</button>
            </div>
        </form>
    </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import EditPageInfoPanel from "./components/InfoPanel.vue";
import EditPageTable from "./components/Table.vue";

export default {
    name: "EditPage",
    components: {
        EditPageInfoPanel,
        EditPageTable,
    },
    data() {
        return {
            status: "",
        };
    },
    mounted() {
        this.getInstructionsById(this.$route.params.id);
    },
    computed: {
        ...mapGetters({
            getAssignedVendor: "getAssignedVendor",
            editInstruction: "editIstruction",
            getInvoiceTo: "getInvoiceTo",
            getCustomer: "getCustomer",
            getLinkTo: "getLinkTo",
            newCostItems: "editCostItem",
            newGrandTotal: "editGrandTotal",
            newAttacmentFile: "editAttacmentFile",
            note: "editNote",
        }),
    },
    methods: {
        ...mapActions({
            getInstructionsById: "getInstructionsById",
            saveEditInstruction: "saveEditInstruction",
        }),
        handleCancel() {
            this.$router.push("/");
        },
        handleForDraft() {
            this.status = "draft";
        },
        handleForSubmit() {
            this.status = "in progres";
        },
        async handleSubmit() {
            const reqData = {
                id: this.$route.params.id,
                status: this.status,
            };
            const response = await this.saveEditInstruction(reqData);

            await this.$router.push(`/detail/${response}`);
        },
    },
};
</script>

<style scoped>
* {
    padding: 0;
    margin: 0;
}

.container-button-bottom {
    display: flex;
    justify-content: flex-end;
    margin-top: 2rem;
    margin-right: 2rem;
}

.container-button-bottom button:nth-child(1) {
    padding: 0.4rem 2rem;
    border: none;
    border-radius: 5px;
    font-weight: 600;
}
.container-button-bottom button:nth-child(2) {
    padding: 0.4rem 2rem;
    margin-left: 1rem;
    border: 0.6px solid rgb(165, 165, 165);
    border-radius: 5px;
    font-weight: 600;
}
.container-button-bottom button:nth-child(3) {
    padding: 0.4rem 4rem;
    margin-left: 1rem;
    border-radius: 5px;
    font-weight: 600;
    border: none;
    background: rgb(0, 190, 190);
    color: white;
}

#page-body {
    margin: 2rem;
}
</style>
