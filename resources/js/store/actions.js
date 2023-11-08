export const getOpenInstructions = async ({ commit }, currrentPage) => {
    const page = currrentPage + 1;
    const response = await axios.get(`api/data3Party/open?page=${page}`);

    console.log(response.data);
    commit("setInstructions", response); // menjalankan function setInstructions() yg ada pada file mutations.js
};

export const getCompletedInstructions = async ({ commit }, currrentPage) => {
    const page = currrentPage + 1;
    const response = await axios.get(`api/data3Party/completed?page=${page}`);

    console.log(response.data);
    commit("setInstructions", response); // menjalankan function setInstructions() yg ada pada file mutations.js
};
