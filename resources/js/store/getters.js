// ====== HOME PAGE ======
export const instructions = (state) => {
    return state.instructions.data;
};
export const pageInfo = (state) => {
    return state.instructions.page;
};

// ====== FOR CREATE PAGE ======
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
    return attacmentFile;
};
export const newNote = ({ newIstruction }) => {
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

// ====== DETAIL PAGE ======
export const instructionDetail = (state) => {
    return state.instructionDetail;
};
export const costDetail = (state) => {
    return state.instructionDetail.costDetail;
};
export const vendor_invoice = (state) => {
    return state.instructionDetail.vendor_invoice;
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
export const internalAttachment = (state) => {
    return state.instructionDetail.internal_only_attachment;
};
export const internalNotes = (state) => {
    return state.instructionDetail.internal_only_notes;
};

// ====== EDIT PAGE ======
export const editIstruction = (state) => {
    return state.editIstruction;
};
export const editCostItem = (state) => {
    return state.editIstruction.costDetail.costItems;
};
export const editGrandTotal = (state) => {
    return state.editIstruction.costDetail.grandTotal;
};
export const editAttacmentFile = (state) => {
    return state.editIstruction.costDetail.attachment;
};
export const editNote = ({ editIstruction }) => {
    return editIstruction.costDetail.notes;
};
