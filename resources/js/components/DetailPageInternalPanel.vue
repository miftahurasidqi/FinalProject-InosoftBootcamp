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
                            <div class="attachment-panel-bottom">
                                <p>Upload By User 1 11/29/2023</p>
                                <button class="btn">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="25"
                                        height="25"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="#f80000"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    >
                                        <polyline
                                            points="3 6 5 6 21 6"
                                        ></polyline>
                                        <path
                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"
                                        ></path>
                                        <line
                                            x1="10"
                                            y1="11"
                                            x2="10"
                                            y2="17"
                                        ></line>
                                        <line
                                            x1="14"
                                            y1="11"
                                            x2="14"
                                            y2="17"
                                        ></line>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="card attachment-panel">
                            <p>filename.pdf</p>
                            <div class="attachment-panel-bottom">
                                <p>Upload By User 1 11/29/2023</p>
                                <button class="btn">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="25"
                                        height="25"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="#f80000"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    >
                                        <polyline
                                            points="3 6 5 6 21 6"
                                        ></polyline>
                                        <path
                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"
                                        ></path>
                                        <line
                                            x1="10"
                                            y1="11"
                                            x2="10"
                                            y2="17"
                                        ></line>
                                        <line
                                            x1="14"
                                            y1="11"
                                            x2="14"
                                            y2="17"
                                        ></line>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="card attachment-panel">
                            <p>filename.pdf</p>
                            <div class="attachment-panel-bottom">
                                <p>Upload By User 1 11/29/2023</p>
                                <button class="btn">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="25"
                                        height="25"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="#f80000"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    >
                                        <polyline
                                            points="3 6 5 6 21 6"
                                        ></polyline>
                                        <path
                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"
                                        ></path>
                                        <line
                                            x1="10"
                                            y1="11"
                                            x2="10"
                                            y2="17"
                                        ></line>
                                        <line
                                            x1="14"
                                            y1="11"
                                            x2="14"
                                            y2="17"
                                        ></line>
                                    </svg>
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
                        multiple
                    />
                </div>
            </div>
            <div class="c-i">
                <p>Internal Notes</p>
                <div>
                    <div>
                        <div class="d-flex notes-info">
                            <div>
                                <p>By User 1 11/29/2023</p>
                            </div>
                            <div>
                                <button class="btn me-2">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="25"
                                        height="25"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="#f80000"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    >
                                        <polyline
                                            points="3 6 5 6 21 6"
                                        ></polyline>
                                        <path
                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"
                                        ></path>
                                        <line
                                            x1="10"
                                            y1="11"
                                            x2="10"
                                            y2="17"
                                        ></line>
                                        <line
                                            x1="14"
                                            y1="11"
                                            x2="14"
                                            y2="17"
                                        ></line>
                                    </svg>
                                </button>
                                <button class="btn" @click="showEditNote">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="25"
                                        height="25"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="#0cf800"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    >
                                        <polygon
                                            points="14 2 18 6 7 17 3 17 3 13 14 2"
                                        ></polygon>
                                        <line
                                            x1="3"
                                            y1="22"
                                            x2="21"
                                            y2="22"
                                        ></line>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="card notes-panel">
                            <p>
                                this is an internal notes test! Lorem ipsum
                                dolor sit amet consectetur adipisicing elit. Non
                                rerum magni nostrum ratione expedita doloremque
                                adipisci ad consequatur, saepe fuga sunt maxime
                                voluptatum neque eius velit molestias quidem qui
                                culpa?
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
        <div class="modal-body">
            <textarea></textarea>
        </div>
    </Popup>
    <Popup v-if="isEditNote" @close="closeEditNote" title="Edit Note">
        <div class="modal-body"></div>
    </Popup>
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
    data() {
        return {
            isAddNote: false,
            isEditNote: false,
        };
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
        showAddNote() {
            this.isAddNote = true;
            document.body.style.overflow = "hidden";
        },
        closeAddNote() {
            this.isAddNote = false;
            document.body.style.overflow = "";
        },
        showEditNote() {
            this.isEditNote = true;
            document.body.style.overflow = "hidden";
        },
        closeEditNote() {
            this.isEditNote = false;
            document.body.style.overflow = "";
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
}
</style>
