import ArowBottomIcon from "./ArowBottomIcon.vue";
import DownloadIcon from "./DownloadIcon.vue";
import PenIcon from "./PenIcon.vue";
import TrashIcon from "./TrashIcon.vue";

export default function registerIcons(app) {
    app.component("ArowBottomIcon", ArowBottomIcon)
        .component("DownloadIcon", DownloadIcon)
        .component("PenIcon", PenIcon)
        .component("TrashIcon", TrashIcon);
}
