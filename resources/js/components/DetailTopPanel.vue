<template>
    <div
        id="top-panel"
        class="flex-wrap d-flex justify-content-between"
        style="margin: 0rem 2rem"
    >
        <div>
            <router-link to="/" class="font-style">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="22"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="#00c412"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >
                    <path d="M15 18l-6-6 6-6" />
                </svg>
                Back
            </router-link>
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

                        <button
                            class="btn"
                            @click.prevent="removeAttacmentCancelFile(index)"
                        >
                            <TrashIcon />
                        </button>
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
import TrashIcon from "./assets/icons/TrashIcon.vue";
import ActionButton from "./ActionButton.vue";
import Popup from "./Popup.vue";

export default {
    name: "DetailTopPanel",
    components: {
        TrashIcon,
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
        async terminateInstruction() {
            await this.terminateInstructionsById(this.id);
            window.location.reload();
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
    color: black;
    text-decoration: none;
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
