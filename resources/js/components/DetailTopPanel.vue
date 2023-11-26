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
    <Popup v-if="isPopupDelete" @close="closeDelete">
        <p>Anda yakin Akan menghapus Instruction ini?</p>
        <div>
            <ActionButton text="Cancel" @click="closeDelete" />
            <ActionButton text="Confirm" @click.prevent="deleteInstruction" />
        </div>
    </Popup>

    <!-- Popup untuk button terminate -->
    <Popup v-if="isPopupTerminate" @close="closeTerminate">
        <h6>Reason Of Cancellation</h6>
        <div>
            <div>
                <p>Canceled By</p>
                <p>User 1</p>
            </div>
            <div>
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
                    <p>{{ file.name }}</p>
                    <p>by user 13/11/2023</p>
                    <button @click.prevent="removeAttacmentCancelFile(index)">
                        Remove
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
        <div>
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
        },
        showTerminate() {
            this.isPopupTerminate = true;
        },
        closeDelete() {
            this.isPopupDelete = false;
        },
        closeTerminate() {
            this.isPopupTerminate = false;
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
    background: rgb(95, 190, 155);
    color: white;
}
.file-item {
    background: rgb(223, 223, 223);
    padding: 5px;
}
</style>
