// for Hompage start
export const getOpenInstructions = async ({ commit }, currrentPage) => {
    const page = currrentPage + 1;
    const response = await axios.get(`api/instructions/open?page=${page}`);

    console.log(response.data);
    commit("setInstructions", response); // menjalankan function setInstructions() yg ada pada file mutations.js
};

export const getCompletedInstructions = async ({ commit }, currrentPage) => {
    const page = currrentPage + 1;
    const response = await axios.get(`api/instructions/completed?page=${page}`);

    console.log(response.data);
    commit("setInstructions", response); // menjalankan function setInstructions() yg ada pada file mutations.js
};
// for Hompage end

// for CreatePage start
export const addCostItem = async ({ commit }) => {
    commit("setNewCostItems");
    commit("setGrandTotal");
};

export const minCostItem = async ({ commit }, index) => {
    commit("setNewCostItems", index);
    commit("setGrandTotal");
};

export const calculateCostItem = async ({ commit }, index) => {
    commit("calculateNewCostItem", index);
    commit("setGrandTotal");
};

export const calculateGrandTotal = async ({ commit }) => {
    commit("setGrandTotal");
};

export const addAttacmentFile = async ({ commit }, file) => {
    commit("addAttacmentFile", file);
};
export const minAttachmentFile = async ({ commit }, index) => {
    commit("minAttacmentFile", index);
};

export const saveNewInstruction = async ({ commit, state }, status) => {
    state.newIstruction.status = status;
    state.newIstruction.costDetail.costItems = state.newCostItems;
    state.newIstruction.costDetail.grandTotal = state.newGrandTotal;
    try {
        const formData = new FormData();
        formData.append("data", JSON.stringify(state.newIstruction));
        // Iterasi melalui setiap file dalam array attachmentFile
        state.attacmentFile.forEach((file, i) => {
            formData.append(`attachment[${i}]`, file);
        });
        console.log(state.newIstruction);
        // Mengirim data ke API menggunakan metode POST
        const response = await axios.post("/api/newInstructions", formData, {
            headers: {
                "Content-Type": "multipart/form-data",
            },
        });
        // Handle response
        console.log(response);
        return response.data.id;
    } catch (error) {
        console.error("Error sending data to API:", error);
    }
};
// for CreatePage end

// for Detailpage start
export const getInstructionsById = async ({ commit }, id) => {
    const response = {
        id: "1",
        instructionId: "LI-2022-0",
        linkTo: ["TRF-2022"],
        instructionType: "LI",
        assignedVendor: "Qube Logistic",
        attentionOf: "Tina",
        quotationNo: 1895,
        customerPO: "foobar",
        costDetails: [
            {
                description: "jh",
                qty: 2,
                uom: "TRP",
                unitPrice: 120000,
                discount: 0,
                gst: 0,
                currency: "AED",
                vatAmount: 20,
                subTotal: 120000,
                total: 120000,
                chargeTo: "Mitme",
            },
            {
                description: "lk",
                qty: 2,
                uom: "TRP",
                unitPrice: 120000,
                discount: 0,
                gst: 0,
                currency: "AED",
                vatAmount: 20,
                subTotal: 120000,
                total: 120000,
                chargeTo: "Mitme",
            },
            {
                description: "po",
                qty: 0,
                uom: null,
                unitPrice: 0,
                gst: 0,
                currency: null,
                vatAmount: 0,
                subTotal: 0,
                total: 0,
                chargeTo: null,
            },
        ],
        status: "In Progress",
        // status: "Draft",
    };
    commit("setInstructionDetail", response);
    // const response = await axios.get(`api/data3Party/${id}`);
    // respons data: {
    //         id: "string",
    //         instructionID: "string",
    //         instructionType: "string",
    //         linkTo: array,
    //         attentionOf: "string",
    //         invoiceTo: "string",
    //         assignedVendor: "string",
    //         vendorAddress: "string"
    //         vendorQuotationNo: "string",
    //         customer: "string",
    //         NoCustomerPO: "string",
    //         status: {
    //             name: "string",
    //             info: {
    //                     canceledBy: "string",
    //                     description: "string",
    //                     canceledAttachment: ["fileName"],               // array berisi string nama file
    //             }
    //         },
    //         costDetail: {
    //             costItem: [
    //                 {
    //                     description: "string",
    //                     QTY: number,
    //                     UOM: "string",
    //                     unitPrice: number,
    //                     GST(%): number,
    //                     currency: "srting",
    //                     vatAmount: number,
    //                     subTotal: number,
    //                     total: number,
    //                 }
    //             ],
    //             grandTotal: [
    //                 {
    //                     currency: "srting",
    //                     vatAmount: number,
    //                     subTotal: number,
    //                     total: number,
    //                 }
    //             ],
    //             Attachment: ["fileName"],                 // array berisi string nama file
    //             notes: srting,
    //         },
    //         vendorInvoice: [
    //             {
    //                 id: "string"
    //                 invoiceNumber: "srting",
    //                 invoiceAttachment: "fileName",
    //                 suportingDocument: ["fileName"],      // array berisi string nama file
    //             }
    //         ],
    //         forInternalOnly: {
    //             intrnalAttachment: ["fileName"],          // array berisi string nama file
    //             internalNotes: ["string"],                // array berisi string
    //         },
    //         activityLog: {
    //             activityName: "string",
    //             user: "srting",
    //             date: "string",
    //         }
    //     }
};

export const deleteInstructionsById = async ({ commit }, id) => {
    console.log(id);
    // try {
    //     const response = await axios.delete(`/api/instruction/${id}`);

    //     console.log(response);
    //     if (response.message === "Delete 3rd Party Instruction success") {
    //         return true;
    //     }
    // } catch (error) {
    //     console.error("Error sending data to API:", error);
    // }
};

export const terminateInstructionsById = async ({ commit, state }, id) => {
    console.log(state.inputStatusInfo);
    console.log(state.inputStatusAttachmentFile);
    const formData = new FormData();
    formData.append("status", "Canceled");
    formData.append("statusInfo", JSON.stringify(state.inputStatusInfo));
    formData.append("statusAttachment", state.inputStatusAttachmentFile);
    console.log(formData);
    // try {

    // // Mengirim data ke API menggunakan metode PATCH
    // const response = await axios.patch(`/api/instruction/canceled/${id}`, formData, {
    //     headers: {
    //         "Content-Type": "multipart/form-data",
    //     },
    // });

    // Handle response jika diperlukan
    // commit("", response);
    // console.log(response.data);
    // } catch (error) {
    //     console.error("Error sending data to API:", error);
    // }
};

export const saveNewInvoice = async ({ commit, state }, id) => {
    console.log(state.newInvoice);

    state.newInvoice.invoiceAttachment;
    state.newInvoice.suportingDocument;
    const formData = new FormData();
    formData.append("invoiceNumber", state.newInvoice.invoiceNumber);
    formData.append("invoiceAttachment", state.newInvoice.invoiceAttachment);
    formData.append("suportingDocument", state.newInvoice.suportingDocument);
    console.log(formData);
    try {
        // Mengirim data ke API menggunakan metode POST
        const response = await axios.post(`/api/addInvoice/${id}`, formData, {
            headers: {
                "Content-Type": "multipart/form-data",
            },
        });

        // Handle response jika diperlukan
        // commit("", response);
        console.log(response.data);
    } catch (error) {
        console.error("Error sending data to API:", error);
    }
    // response: {
    //     message: "add Invoice success",
    //     data: [
    //             {
    //                 id: "string",
    //                 invoiceNumber: "srting",
    //                 invoiceAttachment: "fileName",
    //                 suportingDocument: [fileName],      // array berisi string "fileName"
    //             }
    //     ]
    // }
};

export const editInvoice = async ({ commit }, id) => {
    console.log(id);
    // request data: {
    //                invoiceNumber: "string",
    //                deleteFile: [fileName],          // array berisi Nama File yg dihapus
    //         }
    // request file: {
    //             invoiceAttachment: file,
    //             suportingDocument: [file],          // array berisi file
    //         }

    // const response = await axios.patch(`api/editInvoice/${id}`);
    // commit("setInstructionDetail", response);

    // response: {
    //     message: "Edit Invoice success",
    //     data: [
    //             {
    //                 id: "string"
    //                 invoiceNumber: "srting",
    //                 invoiceAttachment: file,
    //                 suportingDocument: [file],      // array berisi file
    //             }
    //     ]
    // }
};

export const deleteInvoice = async ({ commit }, id) => {
    console.log(id);

    // const response = await axios.delete(`api/deleteInvoice/${id}`);
    // commit("setInstructionDetail", response);

    //  response {
    //     message: "Delete Invoice success",
    //     data: [
    //             {
    //                 id: "string"
    //                 invoiceNumber: "srting",
    //                 invoiceAttachment: file,
    //                 suportingDocument: [file],      // array berisi file
    //             }
    //     ]
    // }
};
export const updateInstructionStatusToComplete = async ({ commit }, id) => {
    console.log(id);
    // request data: {
    //     status: "completed",                              // nilai harus "completed"
    // }

    // const response = await axios.patch(`api/data3Party/completed/${id}`);
    // commit("setInstructionDetail", response);
};

export const addAttachmentForInternalOnly = async ({ commit }, id) => {
    console.log(id);
    //     request file: {
    //         internalAttachment: file,
    //     }

    // const response = await axios.post(`api/forInternalOnly/attachment/${id}`);
    // commit("setInstructionDetail", response);

    // response: {
    // message: "Upload Attachment success",
    // data: [
    //         {
    //             id: "string",
    //             internalAttachment: "string",           // berisi nama file
    //         }
    // ]
    // }
};

export const deleteAttachmentForInternalOnly = async ({ commit }, id) => {
    console.log(id);

    // const response = await axios.delete(`api/forInternalOnly/attachment/${id}`);
    // commit("setInstructionDetail", response);

    // response: {
    //     message: "Delete Attachment success",
    //     data: [
    //             {
    //                 id: "string",
    //                 internalAttachment: "string",           // berisi nama file
    //             }
    //     ]
    // }
};

export const addNotesForInternalOnly = async ({ commit }, id) => {
    console.log(id);
    // request data: {
    //     note: "string",
    //     noteBy: "string",
    // }
    // const response = await axios.post(`api/forInternalOnly/addNote/${id}`);
    //     // commit("setInstructionDetail", response);

    // response: {
    // message: "add note success",
    // data: [
    //     {
    //         id: "string",
    //         note: "string",
    //         noteBy: "string",
    //         time: "string",
    //     }
    // ]
    // }
};

export const editNotesForInternalOnly = async ({ commit }, id) => {
    console.log(id);
    //     request data: {
    //         note: "string",
    //         noteBy: "string",
    //     }

    // const response = await axios.patch(`api/forInternalOnly/note/${id}`);
    // commit("setInstructionDetail", response);

    // response: {
    // message: "edit note success",
    // data: [
    //         {
    //             id: "string",
    //             note: "string",
    //             noteBy: "string",
    //             time: "string",
    //         }
    // ]
    // }
};
export const deleteNotesForInternalOnly = async ({ commit }, id) => {
    console.log(id);
    // const response = await axios.delete(`api/forInternalOnly/note/${id}`);
    // commit("setInstructionDetail", response);

    // response: {
    //     message: "edit note success",
    //     data: [
    //             {
    //                 id: "string",
    //                 note: "string",
    //                 noteBy: "string",
    //                 time: "string",
    //             }
    //     ]
    // }
};

export const downloadFile = async ({ commit }, id) => {
    console.log(id);
    // request data: {
    //     fileName: "string",
    // }

    // const response = await axios.get(`api/download`);
    // commit("setInstructionDetail", response);

    // respons => download file
};

// for Detailpage end

// for Editpage start
// for EditPage end
