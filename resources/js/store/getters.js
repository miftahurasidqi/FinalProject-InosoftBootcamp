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
export const newCostItems = (state) => {
    return state.newCostItems;
};
export const newGrandTotal = (state) => {
    return state.newGrandTotal;
};
export const newAttacmentFile = ({ attacmentFile }) => {
    console.log(attacmentFile);
    return attacmentFile;
};
export const newNote = ({ newIstruction }) => {
    console.log(newIstruction.costDetail.notes);
    return newIstruction.costDetail.notes;
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
// ===
export const inputStatusAttachmentFile = (state) => {
    return state.inputStatusAttachmentFile;
};
export const newInvoiceNumber = (state) => {
    return state.newInvoice.invoiceNumber;
};

export const newInvoiceAttachment = (state) => {
    return state.newInvoice.invoiceAttachment;
};

export const newInvoiceSuportDoc = (state) => {
    return state.newInvoice.suportingDocument;
};

// for Detailpage end

// for Editpage start
// for EditPage end
