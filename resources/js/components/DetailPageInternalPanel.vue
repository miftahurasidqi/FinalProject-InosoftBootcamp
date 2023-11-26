<template>
    <div class="container-panel">
        <div id="internal-panel-header">
            <p>For Internal Only</p>
        </div>
        <div id="internal-panel" class="container-a-i">
            <div class="c-a">
                <p>Attachment</p>
                <button>Add Attachments</button>
            </div>
            <div class="c-i">
                <p>Internal Notes</p>
                <button>Add Internal Note</button>
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
}

.container-a-i button {
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
