<template>
    <div style="background-color: rgb(74, 74, 74)">
        <button class="open-close" @click="toggleList">
            <img src="../../assets/svg/angle-up-solid.svg" alt="" :class="iconClass" style="transition: 0.3s" />
        </button>
        <ul :class="listClass" style="transition: 0.3s">
            <li>
                <button class="description">Dashboard</button>
                <button class="icons">
                    <img src="../../assets/svg/folder-solid.svg" alt="" class="icons-img" />
                </button>
            </li>
            <li>
                <button class="description">Market Index</button>
                <button class="icons">
                    <img src="../../assets/svg/business-time-solid.svg" alt="" class="icons-img" />
                </button>
            </li>
            <li>
                <button class="description">Quality & HSE</button>
                <button class="icons">
                    <img src="../../assets/svg/wrench-solid.svg" alt="" class="icons-img" />
                </button>
            </li>
            <li>
                <button class="description">Commerical</button>
                <button class="icons">
                    <img src="../../assets/svg/clock-solid.svg" alt="" class="icons-img" />
                </button>
            </li>
            <li>
                <button class="description">Procurement</button>
                <button class="icons">
                    <img src="../../assets/svg/hands-solid.svg" alt="" class="icons-img" />
                </button>
            </li>
            <li>
                <button class="description">Inventory</button>
                <button class="icons">
                    <img src="../../assets/svg/layer-group-solid.svg" alt="" class="icons-img" />
                </button>
            </li>
            <li>
                <button class="description">Vendor Management</button>
                <button class="icons">
                    <img src="../../assets/svg/table-list-solid.svg" alt="" class="icons-img" />
                </button>
            </li>
            <li>
                <button class="description">Production</button>
                <button class="icons">
                    <img src="../../assets/svg/gears-solid.svg" alt="" class="icons-img" />
                </button>
            </li>
            <li>
                <button class="description">KPI & Report</button>
                <button class="icons">
                    <img src="../../assets/svg/folder-open-solid.svg" alt="" class="icons-img" />
                </button>
            </li>
            <li>
                <button class="description">MI Share</button>
                <button class="icons">
                    <img src="../../assets/svg/map-location-dot-solid.svg" alt="" class="icons-img" />
                </button>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    name: "TheSideBar",
    data() {
        return {
            isListOpen: false,
            isIconOpen: false,
        };
    },
    computed: {
        listClass() {
            return this.isListOpen ? "open" : "close";
        },
        iconClass() {
            return this.isIconOpen ? "icon-angel-open" : "icon-angel-close";
        },
    },
    methods: {
        toggleList() {
            this.isListOpen = !this.isListOpen;
            this.isIconOpen = !this.isIconOpen;
        },
    },
};
</script>

<style scoped>
.icon-angel-close {
    height: 40px;
    width: 40px;
    transform: rotate(-90deg);
    filter: brightness(0) invert(1);
}

.icon-angel-open {
    height: 40px;
    width: 40px;
    transform: rotate(90deg);
    filter: brightness(0) invert(1);
}

.icons-img {
    height: 25px;
    width: 25px;
    filter: brightness(0) invert(1);
}

.open-close {
    width: 100%;
    height: 70px;
}

ul.close {
    margin-left: -210px;
}

ul.open {
    margin-left: -30px;
}

ul li {
    display: flex;
    height: 55px;
    width: 250px;
    transition: 0.3s;
}

ul li:hover {
    background: rgb(47, 47, 47);
}

ul li .description {
    display: flex;
    justify-content: flex-start;
    /* changed from start */
    align-items: center;
    width: calc(100% - 70px);
    font-weight: 500;
    font-size: medium;
    padding-left: 2rem;
    color: rgb(216, 216, 216);
}

ul li .icons {
    width: 70px;
    color: rgb(216, 216, 216);
}

button {
    background: none;
    border: none;
}
</style>
