<template>
    <Popup
        v-if="isDeleteAttachment"
        @close="closeConfirmDelete"
        title="Delete Invoice"
    >
        <p>Anda yakin Akan menghapus Attachment ini?</p>
        <div>
            <ActionButton text="Cancel" @click.prevent="closeConfirmDelete" />
            <ActionButton text="Confirm" @click.prevent="deleteAttachment" />
        </div>
    </Popup>
    <div class="container-panel">
        <div id="internal-panel-header">
            <p>For Internal Only</p>
        </div>
        <div id="internal-panel" class="container-a-i">
            <div class="c-a">
                <p>Attachment</p>
                <div>
                    <div>
                        <div
                            v-for="(attachment, index) in internalAttachment"
                            :key="index"
                            class="card attachment-panel"
                        >
                            <p>
                                <span
                                    class="download"
                                    @click="download(attachment.file)"
                                >
                                    <DownloadIcon />
                                </span>
                                {{ attachment.file.name }}
                            </p>
                            <div class="attachment-panel-bottom">
                                <p>
                                    Upload By {{ attachment.uploadBy }}
                                    {{ attachment.time }}
                                </p>
                                <button
                                    class="btn"
                                    @click.prevent="
                                        showConfirmDelete(attachment._id)
                                    "
                                >
                                    <TrashIcon />
                                </button>
                            </div>
                        </div>
                    </div>
                    <label for="add-attachment-file" class="buttons"
                        >+ Add Attachment</label
                    >
                    <input
                        hidden
                        id="add-attachment-file"
                        type="file"
                        @change="handleInputFile"
                    />
                </div>
            </div>
            <div class="c-i">
                <p>Internal Notes</p>
                <div>
                    <div
                        v-for="(noteItem, index) in internalNotes"
                        :key="index"
                    >
                        <div class="d-flex notes-info">
                            <div>
                                <p>
                                    By {{ noteItem.uploadBy }}
                                    {{ noteItem.time }}
                                </p>
                            </div>
                            <div>
                                <button
                                    class="btn me-2"
                                    @click="showDeleteNote(noteItem._id)"
                                >
                                    <TrashIcon />
                                </button>
                                <button
                                    class="btn"
                                    @click="showEditNote(index)"
                                >
                                    <PenIcon />
                                </button>
                            </div>
                        </div>
                        <div class="card notes-panel">
                            <p>
                                {{ noteItem.note }}
                            </p>
                        </div>
                    </div>

                    <div>
                        <ActionButton
                            class="buttons"
                            text="Add Internal Note"
                            @click="showAddNote"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <Popup v-if="isAddNote" @close="closeAddNote" title="Add Note">
        <div class="modal-body notes-input">
            <p>By User</p>
            <textarea
                @input="handleInputNote"
                rows="6"
                placeholder="Enter a note"
            >
                {{ inputNote }}
            </textarea>
        </div>
        <div class="modal-footer">
            <ActionButton
                class="buttons me-2"
                text="Cancel"
                @click.prevent="closeAddNote"
            />
            <ActionButton
                class="buttons"
                text="Confirm"
                @click.prevent="confimAddNote"
            />
        </div>
    </Popup>

    <Popup v-if="isDeleteNote" @close="closeDeleteNote" title="Delete Invoice">
        <p>Anda yakin Akan menghapus Attachment ini?</p>
        <div>
            <ActionButton text="Cancel" @click.prevent="closeDeleteNote" />
            <ActionButton text="Confirm" @click.prevent="deleteNote" />
        </div>
    </Popup>

    <Popup v-if="isEditNote" @close="closeEditNote" title="Edit Note">
        <div class="modal-body notes-input">
            <p>By User</p>
            <textarea
                rows="6"
                placeholder="Enter a note"
                @input="handleInputNote"
                >{{ inputNote }}</textarea
            >
        </div>
        <div class="modal-footer">
            <ActionButton
                class="buttons me-2"
                text="Cancel"
                @click.prevent="closeEditNote"
            />
            <ActionButton
                @click.prevent="saveEditNote"
                class="buttons"
                text="Confirm"
            />
        </div>
    </Popup>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

export default {
    name: "DetailPageInternalPanel",
    data() {
        return {
            isDeleteAttachment: false,
            deleteAttachmentId: "",
            inputNote: "",
            isAddNote: false,
            deleteNoteId: "",
            isDeleteNote: false,
            editNoteID: "",
            isEditNote: false,
            notesPlaceholder:
                "Lorem ipsum dolor sit amet, qui minim labore adipisicing minim sint cillum sint consectetur cupidatat.",
        };
    },
    computed: {
        ...mapGetters({
            internalAttachment: "internalAttachment",
            internalNotes: "internalNotes",
        }),
    },
    methods: {
        ...mapActions({
            addInternalAttachment: "addInternalAttachment",
            deleteInternalAttachment: "deleteInternalAttachment",
            addInternalNotes: "addInternalNotes",
            editInternalNotes: "editInternalNotes",
            deleteInternalNotes: "deleteInternalNotes",
            downloadFile: "downloadFile",
        }),
        download(file) {
            this.downloadFile(file);
        },
        async handleInputFile(e) {
            console.log(e.target.files[0]);
            const reqData = {
                id: this.$route.params.id,
                file: e.target.files[0],
            };
            await this.addInternalAttachment(reqData);
            window.location.reload();
        },
        showConfirmDelete(id) {
            this.deleteAttachmentId = id;
            this.isDeleteAttachment = true;
            document.body.style.overflow = "hidden";
        },
        closeConfirmDelete() {
            this.isDeleteAttachment = false;
            document.body.style.overflow = "";
        },
        async deleteAttachment() {
            await this.deleteInternalAttachment(this.deleteAttachmentId);
            window.location.reload();
        },
        handleInputNote(e) {
            this.inputNote = e.target.value;
        },
        async confimAddNote() {
            const reqData = {
                id: this.$route.params.id,
                note: this.inputNote,
            };
            await this.addInternalNotes(reqData);
            window.location.reload();
        },
        showAddNote() {
            this.isAddNote = true;
            document.body.style.overflow = "hidden";
        },
        closeAddNote() {
            this.isAddNote = false;
            document.body.style.overflow = "";
        },
        showDeleteNote(id) {
            this.deleteNoteId = id;
            this.isDeleteNote = true;
            document.body.style.overflow = "hidden";
        },
        closeDeleteNote() {
            this.isDeleteNote = false;
            document.body.style.overflow = "";
        },
        async deleteNote() {
            await this.deleteInternalNotes(this.deleteNoteId);
            window.location.reload();
        },
        showEditNote(i) {
            this.editNoteID = this.internalNotes[i]._id;
            this.inputNote = this.internalNotes[i].note;
            this.isEditNote = true;
            document.body.style.overflow = "hidden";
        },
        closeEditNote() {
            this.isEditNote = false;
            document.body.style.overflow = "";
        },
        async saveEditNote() {
            const reqData = {
                id: this.editNoteID,
                note: this.inputNote,
            };
            await this.editInternalNotes(reqData);
            window.location.reload();

            // console.log(this.editNoteID);
        },
    },
};
</script>

<style scoped>
.container-panel {
    margin-top: 2rem;
}
#internal-panel-header {
    background: rgb(70, 70, 70);
    color: white;
    padding-left: 1.5rem;
    height: 40px;
}
#internal-panel-header p {
    height: 40px;
    line-height: 40px;
    font-weight: 600;
}

.container-a-i {
    display: flex;
    /* background: rgb(0, 190, 190); */
}

.buttons {
    background: rgb(0, 162, 162);
    padding: 0.3rem 2rem;
    border: none;
    border-radius: 4px;
    color: white;
    font-weight: 600;
}
.c-a {
    width: 40%;
    padding: 1.5rem;
}
.c-i {
    width: 60%;
    padding: 1.5rem;
}
.attachment-panel {
    background-color: #f0eded;
    margin: 1rem 0;
    padding: 0.5rem;
    p {
        margin: 0;
    }
}
.notes-info {
    justify-content: space-between;
    div {
        display: flex;
        align-items: center;
    }
    p {
        margin: 0;
    }
}
.notes-panel {
    background-color: #f0eded;
    margin: 0rem 0 1rem;
    padding: 0.5rem;
}
.notes-panel-button {
    display: flex;
    justify-content: flex-end;
    .buttons {
        width: 30%;
    }
}
.notes-input {
    display: flex;
    flex-direction: column;
}
.attachment-panel-bottom {
    display: flex;
    justify-content: space-between;
    align-items: center;
    p {
        margin: 0;
    }
}
.modal-body {
    max-height: 20rem;
    overflow-y: auto;
    margin-bottom: 2rem;
    p {
        margin: 0;
    }
}
.download {
    margin-right: 5px;
}
</style>
