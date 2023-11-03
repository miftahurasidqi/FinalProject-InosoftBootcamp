export const getInstructionById = (state) => (id) => {
    return state.instructions.find((instruction) => instruction.id === id);
};
export const getOpenInstructions = (state) => {
    // Untuk mendapatkan data untuk halaman 'Open'
    return state.instructions.filter(
        (instruction) =>
            instruction.status === "In Progress" ||
            instruction.status === "Draft"
    );
};
export const getCloseInstructions = (state) => {
    // Untuk mendapatkan data untuk halaman 'Close'
    return state.instructions.filter(
        (instruction) =>
            instruction.status === "Completed" ||
            instruction.status === "Cancelled"
    );
};
