<template>
    <div
        id="top-panel"
        class="flex-wrap d-flex justify-content-between"
        style="margin: 0rem 1.5rem"
    >
        <div>
            <p class="font-style">Back</p>
        </div>
        <div class="d-flex fles-row" v-if="status === 'draft'">
            <ActionButton
                text="Delete"
                @click.prevent="showDelete"
                class="font-style"
            />
            <ActionButton text="Modify" @click="goToEdit" class="font-style" />
        </div>

        <div class="d-flex fles-row" v-else-if="status === 'in progres'">
            <ActionButton
                text="Terminate"
                @click.prevent="showTerminate"
                class="font-style"
            />
            <ActionButton text="Modify" @click="goToEdit" class="font-style" />
        </div>
    </div>

    <!-- Popup untuk button delete -->
    <Popup v-if="isPopupDelete" @close="closeDelete" title="Delete Instruction">
        <div class="modal-body">
            <p>Anda yakin Akan menghapus Instruction ini?</p>
            <div>
                <ActionButton text="Cancel" @click="closeDelete" />
                <ActionButton
                    text="Confirm"
                    @click.prevent="deleteInstruction"
                />
            </div>
        </div>
    </Popup>

    <!-- Popup untuk button terminate -->
    <Popup
        v-if="isPopupTerminate"
        @close="closeTerminate"
        title="Terminate Instruction"
    >
        <div class="modal-body">
            <h6>Reason Of Cancellation</h6>
            <div>
                <div>
                    <!-- Nanti dibuat kayak gini <p>Cancelled by {{user}}</p> . gitu kan? -->
                    <p>Canceled By User 1</p>
                    <!-- <p>User 1</p> -->
                </div>
                <div class="description-textarea">
                    <label for="description-cancel">Description</label>
                    <textarea
                        v-model="description"
                        @input="updateDescription"
                        name="description-cancel"
                        id="description-cancel"
                        cols="30"
                        rows="5"
                    ></textarea>
                </div>
                <div>
                    <div
                        v-for="(file, index) in inputStatusAttachmentFile"
                        class="file-item"
                    >
                        <div>
                            <p>{{ file.name }}</p>
                            <p>by user 13/11/2023</p>
                        </div>
                        <div class="file-item-button">
                            <button
                                @click.prevent="
                                    removeAttacmentCancelFile(index)
                                "
                            >
                                Remove
                            </button>
                        </div>
                    </div>

                    <label for="add-attachment-cancel-file" class="add-file"
                        >Add Attachment</label
                    >
                    <input
                        hidden
                        id="add-attachment-cancel-file"
                        type="file"
                        @change="handleInputFile"
                    />
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <ActionButton text="Cancel" @click.prevent="closeTerminate" />
            <ActionButton
                text="Confirm"
                @click.prevent="terminateInstruction"
            />
        </div>
    </Popup>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import ActionButton from "./ActionButton.vue";
import Popup from "./Popup.vue";

export default {
    name: "DetailTopPanel",
    components: {
        ActionButton,
        Popup,
    },
    props: {
        status: {
            type: String,
        },
        id: {
            type: String,
        },
    },
    data() {
        return {
            isPopupDelete: false,
            isPopupTerminate: false,
            description: "",
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
        goToEdit() {
            this.$router.push(`/edit/${this.id}`);
        },
        showDelete() {
            this.isPopupDelete = true;
            document.body.style.overflow = "hidden";
        },
        showTerminate() {
            this.isPopupTerminate = true;
            document.body.style.overflow = "hidden";
        },
        closeDelete() {
            this.isPopupDelete = false;

            document.body.style.overflow = "";
        },
        closeTerminate() {
            this.isPopupTerminate = false;
            document.body.style.overflow = "";
        },
        updateDescription() {
            this.$store.commit("updateDescription", this.description);
        },
        handleInputFile(e) {
            this.$store.commit("addAttacmentCancelFile", e.target.files[0]);
        },
        removeAttacmentCancelFile(index) {
            this.$store.commit("removeAttacmentCancelFile", index);
        },
        async deleteInstruction() {
            const res = await this.deleteInstructionsById(this.id);
            if (res) {
                this.$router.push(`/`);
            }
        },
        terminateInstruction() {
            this.terminateInstructionsById(this.id);
        },
    },
};
</script>

<style scoped>
textarea {
    max-height: 50%;
}
.font-style {
    font-size: medium;
    font-weight: 600;
}
.add-file {
    /* background: rgb(95, 190, 155);
    color: white;
    */
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
    /* background: rgb(223, 223, 223);
    padding: 5px; */
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
.modal-body {
    max-height: 20rem;
    overflow-y: auto;
}
.description-textarea {
    display: flex;
    flex-direction: column;
}
</style>
