<template>
    <div id="vendor-invoice">
        <Popup v-if="isAddInvoice" @close="closeFormAddInvoice">
            <div>
                <label for="invoice-num">Vendor Invoice No</label>
                <input
                    id="invoice-num"
                    type="text"
                    v-model="invoiceNumber"
                    @input="updateInvoiceNumber"
                />
            </div>

            <div>
                <p>Invoice Attachment</p>
                <div v-if="newInvoiceAttachment.name" class="file-item">
                    <p>{{ newInvoiceAttachment.name }}</p>
                    <p>by user 13/11/2023</p>
                    <button @click.prevent="deleteInvoiceAttachment">
                        Remove
                    </button>
                </div>
                <label v-else for="add-attachment-file" class="add-file"
                    >Add Attachment</label
                >
                <input
                    hidden
                    id="add-attachment-file"
                    type="file"
                    @change="handleInputInvoiceAttachment"
                />
            </div>
            <div>
                <p>Suporting Document</p>

                <div
                    v-for="(file, index) in newInvoiceSuportDoc"
                    class="file-item"
                >
                    <p>{{ file.name }}</p>
                    <p>by user 13/11/2023</p>
                    <button @click.prevent="deleteSuportDoc(index)">
                        Remove
                    </button>
                </div>

                <label for="add-suport-file" class="add-file"
                    >Add Suport Document</label
                >
                <input
                    hidden
                    id="add-suport-file"
                    type="file"
                    @change="handleInputSuportDoc"
                    multiple
                />
            </div>

            <div>
                <ActionButton text="Cancel" @click="closeFormAddInvoice" />
                <ActionButton text="Confirm" @click="saveNewInvoice" />
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
            invoiceNumber: "",
        };
    },
    computed: {
        ...mapGetters({
            invoiceNumbers: "newInvoiceNumber",
            newInvoiceAttachment: "newInvoiceAttachment",
            newInvoiceSuportDoc: "newInvoiceSuportDoc",
        }),
    },
    methods: {
        ...mapActions({
            saveNewInvoice: "saveNewInvoice",
        }),
        showFormAddInvoice() {
            this.isAddInvoice = true;
        },
        closeFormAddInvoice() {
            this.isAddInvoice = false;
        },
        updateInvoiceNumber() {
            this.$store.commit("updateInvoiceNumber", this.invoiceNumber);
        },
        handleInputInvoiceAttachment(e) {
            this.$store.commit(
                "handleInputInvoiceAttachment",
                e.target.files[0]
            );
        },
        deleteInvoiceAttachment() {
            this.$store.commit("deleteInvoiceAttachment");
        },
        handleInputSuportDoc(e) {
            this.$store.commit("handleInputSuportDoc", e.target.files);
        },
        deleteSuportDoc(index) {
            this.$store.commit("deleteSuportDoc", index);
        },
    },
};
</script>

<style scoped>
.add-file {
    background: rgb(95, 190, 155);
    color: white;
}
.file-item {
    background: rgb(223, 223, 223);
    padding: 5px;
}
</style>
