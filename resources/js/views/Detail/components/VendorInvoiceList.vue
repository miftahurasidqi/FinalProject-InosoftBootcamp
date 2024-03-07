<template>
    <div id="vendor_invoice_list">
        <!-- form edit invoice -->
        <Popup
            v-if="isEditInvoice"
            @close="closeFormEditInvoice"
            title="Edit Invoice"
        >
            <div class="modal-body">
                <div>
                    <label for="invoice-num" class="me-5"
                        >Vendor Invoice No</label
                    >
                    <input
                        id="invoice-num"
                        type="text"
                        v-model="editInvoice.invoiceNumber"
                    />
                </div>

                <div>
                    <p class="input-title">Invoice Attachment</p>
                    <div
                        v-if="editInvoice.invoiceAttachment.name"
                        class="file-item"
                    >
                        <p>{{ editInvoice.invoiceAttachment.name }}</p>
                        <p>by user 13/11/2023</p>
                        <button
                            class="btn"
                            @click.prevent="
                                deleteInvoiceAttachment(
                                    editInvoice.invoiceAttachment
                                )
                            "
                        >
                            <TrashIcon />
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
                    <p class="input-title">Suporting Document</p>
                    <div
                        v-for="(file, index) in editInvoice.suportingDocument"
                        class="file-item"
                    >
                        <p>{{ file.name }}</p>
                        <p>by user 13/11/2023</p>
                        <button
                            class="btn"
                            @click.prevent="deleteSuportDoc(index)"
                        >
                            <TrashIcon />
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
            </div>

            <div class="modal-footer">
                <ActionButton
                    class="buttons me-2"
                    text="Cancel"
                    @click.prevent="closeFormEditInvoice"
                />
                <ActionButton
                    class="buttons"
                    text="Confirm"
                    @click.prevent="save"
                />
                <!-- @click.prevent="deleteInstruction" -->
            </div>
        </Popup>

        <!-- konfirmasi delete invoice -->
        <Popup
            v-if="isDeleteInvoice"
            @close="closeConfirmDeleteInvoice"
            title="Delete Invoice"
        >
            <p>Anda yakin Akan menghapus Invoice ini?</p>
            <div>
                <ActionButton
                    text="Cancel"
                    @click.prevent="closeConfirmDeleteInvoice"
                />
                <ActionButton text="Confirm" @click.prevent="deleteInvoice" />
            </div>
        </Popup>

        <table v-if="!showNoData" class="table">
            <!-- <table class="table"> -->
            <thead>
                <tr>
                    <td>Invoice Number</td>
                    <td>Attachment</td>
                    <td>Suporting Document</td>
                    <td v-if="isCompleted">Actions</td>
                </tr>
            </thead>
            <tr v-for="(invoice, index) in vendor_invoice" :key="index">
                <td>{{ invoice.invoiceNumber }}</td>
                <td>
                    <p>
                        <span
                            class="download"
                            @click="download(invoice.invoiceAttachment)"
                        >
                            <DownloadIcon />
                        </span>

                        {{ invoice.invoiceAttachment.name }}
                    </p>
                </td>
                <td>
                    <span v-if="Array.isArray(invoice.suportingDocument)">
                        {{ invoice.suportingDocument.length }}
                    </span>
                    <button class="btn" @click="showSuportDoc(index)">
                        <ArowBottom />
                    </button>
                    <div v-if="isShowSuportDoc == index" class="suport-doc">
                        <p
                            v-for="(suportDoc, i) in invoice.suportingDocument"
                            :key="i"
                        >
                            <span class="download" @click="download(suportDoc)">
                                <DownloadIcon />
                            </span>

                            {{ suportDoc.name }}
                        </p>
                    </div>
                </td>
                <td v-if="isCompleted">
                    <!-- <ActionButton
                        @click.prevent="showConfirmDeleteInvoice(invoice._id)"
                        text="Delete"
                    /> -->
                    <!-- <ActionButton
                        @click.prevent="showFormEditInvoice(index)"
                        text="Edit"
                    /> -->
                    <button
                        class="btn"
                        @click.prevent="showConfirmDeleteInvoice(invoice._id)"
                    >
                        <TrashIcon />
                    </button>
                    <button
                        class="btn"
                        @click.prevent="showFormEditInvoice(index)"
                    >
                        <PenIcon />
                    </button>
                </td>
            </tr>
        </table>
        <!-- Ketika tidak ada data -->
        <div v-if="showNoData" class="noData">
            <p>No Data</p>
        </div>

        <div class="recive-instruction" v-if="!showNoData && isCompleted">
            <ActionButton
                class="buttons"
                @click.prevent="setToCompleted"
                text="Recive Instruction"
            />
        </div>
        <!-- setInstructionToCompleted -->
    </div>
</template>
<script>
import { mapGetters, mapActions } from "vuex";

export default {
    name: "DetailPageVendorInvoiceList",
    props: {
        status: {
            type: String,
        },
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
        showNoData() {
            if (Array.isArray(this.vendor_invoice)) {
                if (this.vendor_invoice.length !== 0) {
                    return false;
                }
            }
            return true;
        },
        isCompleted() {
            if (this.status == "completed") {
                return false;
            }
            return true;
        },
    },
    methods: {
        ...mapActions({
            setInstructionToCompleted: "setInstructionToCompleted",
            saveEditInvoice: "saveEditInvoice",
            deleteInvoiceById: "deleteInvoice",
            downloadFile: "downloadFile",
        }),
        download(file) {
            this.downloadFile(file);
        },
        setShowNoData() {
            if (vendor_invoice.length !== 0) {
                showNoData = false;
            }
        },
        setToCompleted() {
            this.setInstructionToCompleted(this.$route.params.id);
            window.location.reload();
        },
        showFormEditInvoice(i) {
            this.editInvoice = this.vendor_invoice[i];
            this.isEditInvoice = true;
            document.body.style.overflow = "hidden";
        },
        showConfirmDeleteInvoice(id) {
            this.deleteInvoiceId = id;
            this.isDeleteInvoice = true;
            document.body.style.overflow = "hidden";
        },
        closeFormEditInvoice() {
            this.isEditInvoice = false;
            document.body.style.overflow = "";
        },
        closeConfirmDeleteInvoice() {
            this.isDeleteInvoice = false;
            document.body.style.overflow = "";
        },
        showSuportDoc(index) {
            if (this.isShowSuportDoc == index) {
                this.isShowSuportDoc = -1;
            } else {
                this.isShowSuportDoc = index;
            }
        },
        async deleteInvoice() {
            // console.log("delete", this.deleteInvoiceId);
            await this.deleteInvoiceById(this.deleteInvoiceId);
            window.location.reload();
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
                        (item) => item.name !== fileChose.name
                    );
            }

            // this.$store.commit("deleteSuportDoc", index);
        },
        async save() {
            const editData = {
                id: this.editInvoice._id,
                invoiceNumber: this.editInvoice.invoiceNumber,
                deleteFile: this.deleteFile,
                addFile: this.addFile,
            };
            //  deleteAttachment: this.deleteFile.invoiceAttachment,
            // deletesuportDoc: this.deleteFile.suportingDocument,
            await this.saveEditInvoice(editData);
            window.location.reload();
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
.btn {
    border: 0;
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
.buttons {
    background: rgb(0, 190, 190);
    padding: 0.3rem 2rem;
    border: none;
    border-radius: 4px;
    color: white;
    font-weight: 600;
}
.noData {
    width: 100%;
    display: flex;
    justify-content: center;
    height: 35px;
    align-items: center;
    font-size: small;
    font-weight: 600;
    color: rgb(120, 120, 120);
}
.download {
    margin-right: 5px;
}
.recive-instruction {
    display: flex;
    justify-content: center;
}
</style>
