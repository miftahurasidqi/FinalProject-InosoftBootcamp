import registerIcons from "./assets/icons/registerIcons.js";
import ActionButton from "./ActionButton.vue";
import TheNavbar from "./TheNavBar.vue";
import TheSideBar from "./SideBar.vue";
import Popup from "./Popup.vue";

export function registerGlobComp(app) {
    app
    .component("ActionButton", ActionButton)
    .component("TheSideBar", TheSideBar)
    .component("TheNavbar", TheNavbar)
    .component("Popup", Popup)

    registerIcons(app);
}
