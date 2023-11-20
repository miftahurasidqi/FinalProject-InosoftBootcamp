<template>
    <div id="vendor-invoice">
        <Popup v-if="isAddInvoice" @close="closeFormAddInvoice">
            <div>
                <label for="add-attachment-file" class="add-file"
                    >Add Attachment</label
                >
                <input
                    hidden
                    id="add-attachment-file"
                    type="file"
                    @change="handleInputFile"
                />
            </div>
            <div>
                <ActionButton text="Cancel" @click="closeFormAddInvoice" />
                <ActionButton text="Confirm" />
                <!-- @click.prevent="deleteInstruction" -->
            </div>
        </Popup>
        <div>
            <h2>Vendor Invoice</h2>
            <ActionButton
                text="Add Vendor Invoice"
                @click.prevent="showFormAddInvoice"
            />
        </div>
        <div></div>
    </div>
</template>
<script>
import { mapGetters, mapActions } from "vuex";
import ActionButton from "./ActionButton.vue";
import Popup from "./Popup.vue";

export default {
    name: "DetailPageVendorInvoice",
    components: {
        ActionButton,
        Popup,
    },
    data() {
        return {
            isAddInvoice: false,
        };
    },
    computed: {
        ...mapGetters({
            inputStatusAttachmentFile: "inputStatusAttachmentFile",
        }),
    },
    methods: {
        ...mapActions({
            deleteInstructionsById: "deleteInstructionsById",
            terminateInstructionsById: "terminateInstructionsById",
        }),
        showFormAddInvoice() {
            this.isAddInvoice = true;
        },
        closeFormAddInvoice() {
            this.isAddInvoice = false;
        },
    },
};
</script>
