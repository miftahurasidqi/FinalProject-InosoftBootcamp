// for Hompage start
export const instructions = (state) => {
    // console.log(state.openInstructions);
    return state.instructions.data;
};
export const pageInfo = (state) => {
    return state.instructions.page;
};
// for Hompage end

// for CreatePage start
export const newIstruction = (state) => {
    return state.newIstruction;
};
export const newCostDetail = (state) => {
    return state.newCostDetail;
};
export const getLinkTo = ({ pilihanInput }) => {
    return pilihanInput.linkTo;
};
export const getAssignedVendor = ({ pilihanInput }) => {
    return pilihanInput.assignedVendor;
};
export const getCustomer = ({ pilihanInput }) => {
    return pilihanInput.customer;
};
export const getInvoiceTo = ({ pilihanInput }) => {
    return pilihanInput.newCostDetail;
};
// for CreatePage end

// for Detailpage start
export const instructionDetail = (state) => {
    return state.instructionDetail;
};
// for Detailpage end

// for Editpage start
// for EditPage end
