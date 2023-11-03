export const getAllInstructions = async ({ commit }) => {
    // Action ini dipanggil di App.vue
    // Saat App.vue dirender, getAllInstructions manggil data dari axios
    const response = await axios.get("api/getAllData");
    commit("setInstructions", response); // menjalankan function setInstructions() yg ada pada file mutations.js
};
