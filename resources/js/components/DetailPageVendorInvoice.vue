<template>
    <!-- form add invoice -->
    <Popup
        v-if="isAddInvoice"
        @close="closeFormAddInvoice"
        title="Add Vendor Invoice"
    >
        <div class="modal-body">
            <div>
                <label for="invoice-num" class="me-5">Vendor Invoice No</label>
                <input
                    id="invoice-num"
                    type="text"
                    v-model="invoiceNumber"
                    @input="updateInvoiceNumber"
                />
            </div>

            <div>
                <p class="input-title">Invoice Attachment</p>
                <div v-if="newInvoiceAttachment.name" class="file-item">
                    <div>
                        <p>{{ newInvoiceAttachment.name }}</p>
                        <p>by user 13/11/2023</p>
                    </div>
                    <div class="file-item-button">
                        <button @click.prevent="deleteInvoiceAttachment">
                            Remove
                        </button>
                    </div>
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
                <p class="input-title">Suporting Document</p>

                <div
                    v-for="(file, index) in newInvoiceSuportDoc"
                    class="file-item"
                >
                    <div>
                        <p>{{ file.name }}</p>
                        <p>by user 13/11/2023</p>
                    </div>
                    <div class="file-item-button">
                        <button @click.prevent="deleteSuportDoc(index)">
                            Remove
                        </button>
                    </div>
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
        </div>
        <div class="modal-footer">
            <ActionButton
                type="button"
                class="buttons me-2"
                @click="closeFormAddInvoice"
                text="Cancel"
            />
            <ActionButton
                type="button"
                class="buttons"
                @click="save"
                text="Submit"
            />
        </div>
    </Popup>

    <div class="panel-top">
        <p>Vendor Invoice</p>
        <ActionButton
            text="Add Vendor Invoice"
            class="buttons"
            @click.prevent="showFormAddInvoice"
        />
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
            vendor_invoice: "vendor_invoice",
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
            document.body.style.overflow = "hidden";
        },
        closeFormAddInvoice() {
            this.isAddInvoice = false;
            document.body.style.overflow = "";
        },
        updateInvoiceNumber() {
            this.$store.commit("updateInvoiceNumber", this.invoiceNumber);
        },
        handleInputInvoiceAttachment(e) {
            console.log(e.target.files[0]);
            this.$store.commit(
                "handleInputInvoiceAttachment",
                e.target.files[0],
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
        save() {
            this.saveNewInvoice(this.$route.params.id);
        },
    },
};
</script>

<style scoped>
/* * {
    padding: 0;
    margin: 0;
} */
.panel-top {
    display: flex;
    justify-content: space-between;
    margin: 1.5rem;
}
.panel-top p {
    display: inline;
    height: 40px;
    line-height: 40px;
    font-weight: 600;
}
.buttons {
    background: rgb(0, 190, 190);
    padding: 0.3rem 2rem;
    border: none;
    border-radius: 4px;
    color: white;
    font-weight: 600;
}
#vendor_invoice_list {
    margin: 0rem 1.5rem;
    border: 1px solid rgb(189, 189, 189);
}
#vendor_invoice_list thead tr td {
    border: none;
    font-size: small;
    font-weight: 600;
    color: white;
    background: rgb(165, 165, 165);
}
.modal-body {
    max-height: 20rem;
    overflow-y: auto;
}
.add-file {
    background: rgb(0, 162, 162);
    padding: 0.3rem 2rem;
    border: none;
    border-radius: 4px;
    color: white;
    font-weight: 600;
    cursor: pointer;
    margin: 1rem 0;
}
.file-item {
    display: flex;
    justify-content: space-between;
    padding: 1rem;
    background-color: #f0eded;
    margin: 1rem 0;
    p {
        margin-bottom: 0.2rem;
    }
    .file-item-button {
        display: flex;
        align-content: center;
    }
}
.input-title {
    margin: 0;
}
/* .panel-top actionb .add-file {
    background: rgb(95, 190, 155);
    color: white;
} */
/* .file-item {
    background: rgb(223, 223, 223);
    padding: 5px;
} */
</style>
