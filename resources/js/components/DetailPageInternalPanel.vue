<template>
    <div id="internal-panel-header">
        <h2>For Internal Only</h2>
    </div>
    <div id="internal-panel" class="d-flex">
        <div>
            <h3>Attachment</h3>
            <button>Add Attachments</button>
        </div>
        <div>
            <h3>Internal Notes</h3>
            <button>Add Internal Note</button>
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
