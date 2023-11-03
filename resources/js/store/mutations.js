// merubah value state.instructions dengan data dari response
export const setInstructions = (state, response) => {
    state.instructions = response.data.instructions;
};
