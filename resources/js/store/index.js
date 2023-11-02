import { createStore } from "vuex";

export default createStore({
    state: {
        instructions: [],
    },
    getters: {
        getInstructionById: (state) => (id) => {
            return state.instructions.find(
                (instruction) => instruction.instructionId === id,
            );
        },
        getOpenInstructions(state) {
            // Untuk mendapatkan data untuk halaman 'Open'
            return state.instructions.filter(
                (instruction) =>
                    instruction.status === "In Progress" ||
                    instruction.status === "Draft",
            );
        },
        getCloseInstructions(state) {
            // Untuk mendapatkan data untuk halaman 'Close'
            return state.instructions.filter(
                (instruction) =>
                    instruction.status === "Completed" ||
                    instruction.status === "Cancelled",
            );
        },
    },
    actions: {
        async FETCH_DATA() {
            // Action ini dipanggil di App.vue
            // Saat App.vue dirender, FETCH_DATA manggil data
            // dari axios
            const response = await axios.get("api/getAllData");
            this.state.instructions = response.data.instructions;
        },
    },
});
