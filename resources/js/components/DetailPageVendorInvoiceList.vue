<template>
    <div id="vendor_invoice_list">
        <!-- form edit invoice -->
        <Popup v-if="isEditInvoice" @close="closeFormEditInvoice">
            <div>
                <label for="invoice-num">Vendor Invoice No</label>
                <input
                    id="invoice-num"
                    type="text"
                    v-model="editInvoice.invoiceNumber"
                />
                <!-- @input="updateInvoiceNumber" -->
            </div>

            <div>
                <p>Invoice Attachment</p>
                <div
                    v-if="editInvoice.invoiceAttachment.name"
                    class="file-item"
                >
                    <p>{{ editInvoice.invoiceAttachment.name }}</p>
                    <p>by user 13/11/2023</p>
                    <button
                        @click.prevent="
                            deleteInvoiceAttachment(
                                editInvoice.invoiceAttachment,
                            )
                        "
                    >
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
                    v-for="(file, index) in editInvoice.suportingDocument"
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
                <ActionButton text="Cancel" @click="closeFormEditInvoice" />
                <ActionButton text="Confirm" @click="save" />
                <!-- @click.prevent="deleteInstruction" -->
            </div>
        </Popup>

        <!-- konfirmasi delete invoice -->
        <Popup v-if="isDeleteInvoice" @close="closeConfirmDeleteInvoice">
            <p>Anda yakin Akan menghapus Invoice ini?</p>
            <div>
                <ActionButton
                    text="Cancel"
                    @click="closeConfirmDeleteInvoice"
                />
                <ActionButton text="Confirm" @click.prevent="deleteInvoice" />
            </div>
        </Popup>

        <table class="table">
            <thead>
                <tr>
                    <td>Invoice Number</td>
                    <td>Attachment</td>
                    <td>Suporting Document</td>
                    <td>Actions</td>
                </tr>
            </thead>
            <tr v-for="(invoice, index) in vendor_invoice" :key="index">
                <td>{{ invoice.invoiceNumber }}</td>
                <td>{{ invoice.invoiceAttachment.name }}</td>
                <td>
                    <span>
                        {{ invoice.suportingDocument.length }}
                    </span>
                    <span @click="showSuportDoc(index)">i</span>

                    <div v-if="isShowSuportDoc == index" class="suport-doc">
                        <p
                            v-for="(suportDoc, i) in invoice.suportingDocument"
                            :key="i"
                        >
                            {{ suportDoc.name }}
                        </p>
                    </div>
                </td>
                <td>
                    <span
                        @click.prevent="showConfirmDeleteInvoice(invoice._id)"
                    >
                        delete</span
                    >
                    <span @click.prevent="showFormEditInvoice(index)"
                        >edit</span
                    >
                </td>
            </tr>
        </table>
        <!-- Ketika tidak ada data -->
        <div
            v-if="vendor_invoice.length == 0"
            style="
                width: 100%;
                display: flex;
                justify-content: center;
                height: 35px;
                align-items: center;
                font-size: small;
                font-weight: 600;
                color: rgb(120, 120, 120);
            "
        >
            <p>No Data</p>
        </div>
    </div>
</template>
<script>
import { mapGetters, mapActions } from "vuex";
import ActionButton from "./ActionButton.vue";
import Popup from "./Popup.vue";

export default {
    name: "DetailPageVendorInvoiceList",
    components: {
        ActionButton,
        Popup,
    },
    data() {
        return {
            isEditInvoice: false,
            isDeleteInvoice: false,

            isShowSuportDoc: -1,
            deleteInvoiceId: "",
            editInvoice: {
                invoiceNumber: "",
                invoiceAttachment: {},
                suportingDocument: [],
            },
            deleteFile: {
                invoiceAttachment: {},
                suportingDocument: [],
            },
            addFile: {
                invoiceAttachment: {},
                suportingDocument: [],
            },
        };
    },
    computed: {
        ...mapGetters({
            vendor_invoice: "vendor_invoice",
        }),
    },
    methods: {
        ...mapActions({
            saveEditInvoice: "saveEditInvoice",
        }),
        //
        showFormEditInvoice(i) {
            this.editInvoice = this.vendor_invoice[i];
            this.isEditInvoice = true;
        },
        showConfirmDeleteInvoice(id) {
            this.deleteId = id;
            this.isDeleteInvoice = true;
        },
        closeFormEditInvoice() {
            this.isEditInvoice = false;
        },
        closeConfirmDeleteInvoice() {
            this.isDeleteInvoice = false;
        },
        showSuportDoc(index) {
            if (this.isShowSuportDoc == index) {
                this.isShowSuportDoc = -1;
            } else {
                this.isShowSuportDoc = index;
            }
        },
        deleteInvoice() {
            console.log("delete", this.deleteId);
        },

        handleInputInvoiceAttachment(e) {
            this.editInvoice.invoiceAttachment = e.target.files[0];
            this.addFile.invoiceAttachment = e.target.files[0];
        },
        deleteInvoiceAttachment(fileInfo) {
            this.editInvoice.invoiceAttachment = {};
            if (fileInfo.path) {
                this.deleteFile.invoiceAttachment = fileInfo;
            }
        },
        handleInputSuportDoc(e) {
            const files = e.target.files;
            let suportDoc = [];
            for (let i = 0; i < files.length; i++) {
                suportDoc.push(files[i]);
            }
            this.editInvoice.suportingDocument =
                this.editInvoice.suportingDocument.concat(suportDoc);
            this.addFile.suportingDocument =
                this.addFile.suportingDocument.concat(suportDoc);
        },
        deleteSuportDoc(index) {
            const fileChose = this.editInvoice.suportingDocument[index];

            this.editInvoice.suportingDocument.splice(index, 1);
            if (fileChose.path) {
                this.deleteFile.suportingDocument.push(fileChose);
            } else {
                this.addFile.suportingDocument =
                    this.addFile.suportingDocument.filter(
                        (item) => item.name !== fileChose.name,
                    );
            }

            // this.$store.commit("deleteSuportDoc", index);
        },
        save() {
            const editData = {
                id: this.editInvoice._id,
                invoiceNumber: this.editInvoice.invoiceNumber,
                deleteFile: this.deleteFile,
                addFile: this.addFile,
            };
            this.saveEditInvoice(editData);
        },
    },
};
</script>

<style scoped>
* {
    padding: 0;
    margin: 0;
}
.suport-doc {
    position: absolute;
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
td {
    height: 3rem;
}
</style>
