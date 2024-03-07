<template>
    <div id="page-body">
        <h1 style="margin-bottom: 8px">3rd Party Instruction</h1>
        <form
            class="card"
            style="padding-bottom: 2rem"
            @submit.prevent="handleSubmit"
        >
            <CreateInfoPanel />

            <CreateCostDetail />

            <div class="container-button-bottom">
                <button type="button" @click="handleCancel">Cancel</button>
                <button type="submit" @click="handleForDraft">
                    Save as Daft
                </button>
                <button type="submit" @click="handleForSubmit">Submit</button>
            </div>
        </form>
    </div>
</template>

<script>
import { mapActions } from "vuex";
import CreateInfoPanel from "./components/CreateInfoPanel.vue";
import CreateCostDetail from "./components/CreateCostDetail.vue";

export default {
    name: "CreatePage",
    components: {
        CreateInfoPanel,
        CreateCostDetail,
    },
    data() {
        return {
            status: "",
        };
    },
    methods: {
        ...mapActions({
            saveNewInstruction: "saveNewInstruction",
        }),
        handleCancel() {
            this.$router.push("/");
        },
        handleForDraft() {
            this.status = "draft";
        },
        handleForSubmit() {
            this.status = "in progres";
        },
        async handleSubmit() {
            const response = await this.saveNewInstruction(this.status);
            await this.$router.push(`/detail/${response}`);
        },
    },
};
</script>

<style scoped>
* {
    padding: 0;
    margin: 0;
}

.container-button-bottom {
    display: flex;
    justify-content: flex-end;
    margin-top: 2rem;
    margin-right: 2rem;
}

.container-button-bottom button:nth-child(1) {
    padding: 0.4rem 2rem;
    border: none;
    border-radius: 5px;
    font-weight: 600;
}
.container-button-bottom button:nth-child(2) {
    padding: 0.4rem 2rem;
    margin-left: 1rem;
    border: 0.6px solid rgb(165, 165, 165);
    border-radius: 5px;
    font-weight: 600;
}
.container-button-bottom button:nth-child(3) {
    padding: 0.4rem 4rem;
    margin-left: 1rem;
    border-radius: 5px;
    font-weight: 600;
    border: none;
    background: rgb(0, 190, 190);
    color: white;
}

#page-body {
    margin: 2rem;
}
</style>
