<template>
    <div class="card-body">
        <div id="card-header">
            <div class="container-card-top">
                <div class="container-o-c">
                    <ActionButton
                        @click="isOpenSwitcher"
                        text="Open"
                        :class="{
                            'b-open': isOpen,
                            'b-completed': !isOpen,
                        }"
                    />

                    <ActionButton
                        @click="isCloseSwitcher"
                        text="Completed"
                        :class="{
                            'b-open': !isOpen,
                            'b-completed': isOpen,
                        }"
                    />
                </div>
                <div class="container-s-e">
                    <input
                        name="attention-of"
                        type="text"
                        placeholder="Search"
                        v-model="searchKeyword"
                        @input="search"
                    />
                    <ActionButton text="Export" class="export" />
                </div>
            </div>

            <div class="conatiner-b-intruction">
                <p class="show-data">
                    {{ pageInfo.size }} of {{ pageInfo.totalData }} entries
                    displayed
                </p>

                <div style="position: relative">
                    <ActionButton
                        @click="toggleList"
                        text="Create 3rd Party Instruction"
                        class="b-intruction"
                    />
                    <div :class="listClass" style="transition: 0.3s">
                        <button class="logistic" @click="goCreateLogistic">
                            Logistic Instruction
                        </button>
                        <button class="service" @click="goCreateService">
                            Service Intruction
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

export default {
    name: "TopComponent",
    data() {
        return {
            isListOpen: false,
            searchKeyword: "",
        };
    },
    props: {
        isOpen: {
            type: Boolean,
        },
    },
    computed: {
        ...mapGetters({
            pageInfo: "pageInfo",
        }),
        listClass() {
            return this.isListOpen ? "open" : "close";
        },
    },
    methods: {
        isOpenSwitcher() {
            this.$emit("openSwitcher");
        },
        isCloseSwitcher() {
            this.$emit("closeSwitcher");
        },
        search() {
            this.$emit("search", this.searchKeyword);
        },
        toggleList() {
            this.isListOpen = !this.isListOpen;
        },
        goCreateService() {
            this.$router.push("/create");
        },
        goCreateLogistic() {
            this.$router.push("/create");
        },
    },
};
</script>

<style scoped>
* {
    padding: 0;
    margin: 0;
}

.container-card-top {
    display: flex;
    justify-content: space-between;
    align-items: center;
    height: 50px;
    margin-top: 1rem;
    margin-bottom: 1.5rem;
    border-bottom: 2px solid rgb(230, 230, 230);
    box-sizing: border-box;
}
.b-open {
    font-weight: 600;
    font-size: 1.2rem;
    height: calc(100% + 3px);
    color: rgb(160, 160, 160);
    padding: 0rem 1rem;
    border-radius: 0;
    box-sizing: border-box;
    background: none;
    color: rgb(0, 190, 190);
    border-bottom: 4px solid rgb(0, 190, 190);
}
.b-completed {
    font-weight: 600;
    font-size: 1.2rem;
    height: calc(100% + 3px);
    color: rgb(160, 160, 160);
    padding: 0rem 1rem;
    border-radius: 0;
    box-sizing: border-box;
}
.b-completed:hover {
    background: none;
    color: rgb(0, 190, 190);
}
.conatiner-b-intruction {
    display: flex;
    justify-content: space-between;
    height: 60px;
    margin-bottom: 10px;
}
.show-data {
    align-self: end;
    font-size: medium;
    font-weight: 500;
    color: rgb(170, 170, 170);
}
.close {
    position: absolute;
    left: 0;
    top: 0;
    overflow: hidden;
    height: 0px;
    transform: translateY(36px);
    display: flex;
    flex-direction: column;
}
.open {
    position: absolute;
    left: 0;
    top: 0;
    overflow: hidden;
    height: 72px;
    transform: translateY(36px);
    display: flex;
    flex-direction: column;
}
.logistic,
.service {
    width: 228px;
    height: 36px;
    border: none;
    font-size: small;
    font-weight: 600;
    border-radius: 4px;
    color: black;
    background: rgb(244, 244, 244);
}
.logistic:hover,
.service:hover {
    background: rgb(211, 211, 211);
    transition: 0.3s;
}
.b-intruction {
    background: rgb(0, 190, 190);
    color: white;
    font-size: small;
    font-weight: 600;
    height: 36px;
    padding: 0rem 2rem;
}
.b-intruction:hover {
    background: rgb(0, 170, 170);
    transition: 0.3s;
}
.container-o-c {
    height: 100%;
}
.container-s-e {
    display: flex;
    align-items: center;
    height: 100%;
    padding-bottom: 5px;
}
.container-s-e input {
    height: 35px;
    width: 230px;
    border: 1px solid rgb(230, 230, 230);
    font-size: small;
    font-weight: 500;
    padding-left: 10px;
}
.export {
    padding: 3px 1rem;
    height: 35px;
    width: 80px;
    border: 1px solid rgb(230, 230, 230);
    border-radius: 3px;
    margin-left: 1rem;
    font-size: small;
    font-weight: 600;
    background: rgb(46, 199, 199);
    color: rgb(230, 243, 243);
}
</style>
