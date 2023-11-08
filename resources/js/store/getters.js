export const getInstructionById = (state) => (id) => {
    return state.instructions.data.find((instruction) => instruction.id === id);
};

export const instructions = (state) => {
    // console.log(state.openInstructions);
    return state.instructions.data;
};

export const pageInfo = (state) => {
    return state.instructions.page;
};
