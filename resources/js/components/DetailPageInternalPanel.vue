<template>
    <div class="container-panel">
        <div id="internal-panel-header">
            <p>For Internal Only</p>
        </div>
        <div id="internal-panel" class="container-a-i">
            <div class="c-a">
                <p>Attachment</p>
                <div>
                    <div>
                        <div class="card attachment-panel">
                            <p>filename.pdf</p>
                            <p>Upload By User 1 11/29/2023</p>
                            <div class="attachment-panel-button">
                                <ActionButton class="buttons" text="Delete" />
                            </div>
                        </div>
                        <div class="card attachment-panel">
                            <p>filename.pdf</p>
                            <p>Upload By User 1 11/29/2023</p>
                            <div class="attachment-panel-button">
                                <ActionButton class="buttons" text="Delete" />
                            </div>
                        </div>
                        <div class="card attachment-panel">
                            <p>filename.pdf</p>
                            <p>Upload By User 1 11/29/2023</p>
                            <div class="attachment-panel-button">
                                <ActionButton class="buttons" text="Delete" />
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
                        multiple
                    />
                </div>
            </div>
            <div class="c-i">
                <p>Internal Notes</p>
                <div>
                    <div class="card notes-panel">
                        <p>
                            this is an internal notes test! Lorem ipsum dolor
                            sit amet consectetur adipisicing elit. Non rerum
                            magni nostrum ratione expedita doloremque adipisci
                            ad consequatur, saepe fuga sunt maxime voluptatum
                            neque eius velit molestias quidem qui culpa?
                        </p>
                        <p>By User 1 11/29/2023</p>
                        <div class="notes-panel-button">
                            <ActionButton class="buttons me-2" text="Delete" />
                            <ActionButton class="buttons" text="Edit" />
                        </div>
                    </div>
                    <div class="notes-input">
                        <p>Write a new note:</p>
                        <textarea
                            rows="6"
                            placeholder="Enter a note here"
                        ></textarea>
                        <ActionButton
                            class="buttons"
                            text="Add Internal Note"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import ActionButton from "./ActionButton.vue";
import Popup from "./Popup.vue";

export default {
    name: "DetailPageInternalPanel",
    components: {
        ActionButton,
        Popup,
    },
    methods: {
        ...mapActions({
            addInternalAttachment: "addInternalAttachment",
        }),
        handleInputFile(e) {
            console.log(e.target.files);
            let files = [];
            for (let i = 0; i < e.target.files.length; i++) {
                files.push(e.target.files[i]);
            }
            const reqData = {
                id: this.$route.params.id,
                files: files,
            };
            this.addInternalAttachment(reqData);
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
    padding-left: 2rem;
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
    padding: 2rem;
}
.c-i {
    width: 60%;
    padding: 2rem;
}
.attachment-panel {
    background-color: #f0eded;
    margin: 1rem 0;
    padding: 0.5rem;
    .buttons {
        width: 40%;
    }
}
.notes-panel {
    background-color: #f0eded;
    margin: 1rem 0;
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
.attachment-panel-button {
    display: flex;
    justify-content: flex-end;
}
</style>
