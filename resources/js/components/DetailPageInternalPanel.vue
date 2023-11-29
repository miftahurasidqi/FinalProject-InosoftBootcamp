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
                        <div>
                            <p>filename.pdf</p>
                            <p>Upload By User 1 11/29/2023</p>
                            <button>delete</button>
                        </div>
                        <div>
                            <p>filename.pdf</p>
                            <p>Upload By User 1 11/29/2023</p>
                            <button>delete</button>
                        </div>
                        <div>
                            <p>filename.pdf</p>
                            <p>Upload By User 1 11/29/2023</p>
                            <button>delete</button>
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
                        <div>
                            <button>delete</button>
                            <button>edit</button>
                            <p>By User 1 11/29/2023</p>
                            <textarea disabled>nini note1</textarea>
                        </div>
                    </div>
                    <button>Add Internal Note</button>
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
    background: rgb(0, 190, 190);
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
</style>
