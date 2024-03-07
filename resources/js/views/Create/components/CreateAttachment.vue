<template>
    <div id="attachment-panel" class="container-a">
        <div class="a-l">
            <h6>Attachment</h6>
            <div v-for="(file, index) in newAttacmentFile" class="file-item">
                <div>
                    <p>{{ file.name }}</p>
                    <p>by user 13/11/2023</p>
                </div>
                <button
                    class="btn"
                    @click.prevent="removeAttachmentFile(index)"
                >
                    <TrashIcon />
                </button>
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
        <div class="a-r">
            <label for="notes">Notes</label>
            <textarea
                v-model="newNote"
                @input="updateNewNote"
                name="notes"
                id="notes"
            ></textarea>
        </div>
    </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

export default {
    name: "CreateAttachment",
    data() {
        return {
            newNote: "",
        };
    },
    computed: {
        ...mapGetters({
            newAttacmentFile: "newAttacmentFile",
            Note: "newNote",
        }),
    },
    methods: {
        ...mapActions({
            addAttacmentFile: "addAttacmentFile",
            minAttachmentFile: "minAttachmentFile",
        }),

        handleInputFile(e) {
            this.addAttacmentFile(e.target.files[0]);
        },
        removeAttachmentFile(i) {
            this.minAttachmentFile(i);
        },
        updateNewNote() {
            this.$store.commit("updateNewNote", this.newNote);
        },
    },
};
</script>

<style scoped>
* {
    padding: 0px;
    margin: 0px;
}

.container-a {
    display: flex;
    margin: 2rem 10px;
}
.buttons {
    background: rgb(0, 190, 190);
    padding: 0.3rem 2rem;
    border: none;
    border-radius: 4px;
    color: white;
    font-weight: 600;
    cursor: pointer;
    margin-top: 1rem;
}

.a-l {
    width: 40%;
    margin-right: 15px;
}
.a-l p {
    font-weight: 500;
    color: rgb(98, 98, 98);
}
.a-r {
    display: flex;
    flex-direction: column;
    width: 60%;
}

.a-r label {
    font-size: medium;
    font-weight: 500;
    color: rgb(98, 98, 98);
}

.a-r textarea {
    border: none;
    height: 100px;
    background: rgb(250, 250, 250);
    border: 1px solid rgb(190, 190, 190);
    border-radius: 3px;
}
.file-item {
    display: flex;
    justify-content: space-between;
    padding-inline: 20px;
    background: rgb(222, 215, 215);
    margin-bottom: 5px;
    border-radius: 5px;
}
h6 {
    margin-bottom: 9px;
}
</style>
