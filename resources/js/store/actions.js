// ====== HOME PAGE ======
export const getOpenInstructions = async ({ commit }, currrentPage) => {
    const page = currrentPage + 1;
    const response = await axios.get(`api/instructions/open?page=${page}`);
    commit("setInstructions", response);
    // console.log(response.data);
};
export const getCompletedInstructions = async ({ commit }, currrentPage) => {
    const page = currrentPage + 1;
    const response = await axios.get(`api/instructions/completed?page=${page}`);
    commit("setInstructions", response);
    // console.log(response.data);
};
export const searchInstructions = async ({ commit }, reqData) => {
    console.log(reqData);
    const { status, keyWord, currrentPage } = reqData;
    const page = currrentPage + 1;
    const queryParameters = {
        keyWord,
        status,
        page,
    };
    const response = await axios.get(`api/instructions/search`, {
        params: queryParameters,
    });
    commit("setInstructions", response);
    // console.log(response.data);
};

// ====== FOR CREATE PAGE ======
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
        state.attacmentFile.forEach((file, i) => {
            formData.append(`attachment[${i}]`, file);
        });

        const response = await axios.post("/api/newInstructions", formData, {
            headers: {
                "Content-Type": "multipart/form-data",
            },
        });
        console.log(response);
        return response.data.id;
    } catch (error) {
        console.error("Error sending data to API:", error);
    }
};

// ====== DETAIL PAGE ======
export const getInstructionsById = async ({ commit }, id) => {
    try {
        const response = await axios.get(`/api/instruction/${id}`);
        console.log(response);
        commit("setInstructionDetail", response.data);
        // commit("setInstructionEdit", response.data);
    } catch (error) {
        console.error("Error getInstruction data to API:", error);
    }
};
export const deleteInstructionsById = async ({ commit }, id) => {
    console.log(id);
    try {
        const response = await axios.delete(`/api/instruction/${id}`);
        console.log(response);
        if (response.status !== 200) {
            return false;
        }
        return true;
    } catch (error) {
        console.error("Error sending data to API:", error);
    }
};
export const terminateInstructionsById = async ({ commit, state }, id) => {
    console.log(state.inputStatusInfo);
    console.log(state.inputStatusAttachmentFile);
    const formData = new FormData();
    formData.append("statusInfo", JSON.stringify(state.inputStatusInfo));
    state.inputStatusAttachmentFile.forEach((file, i) => {
        formData.append(`statusAttachment[${i}]`, file);
    });
    try {
        const response = await axios.post(
            `/api/instruction/canceled/${id}`,
            formData,
            {
                headers: {
                    "Content-Type": "multipart/form-data",
                },
            }
        );

        // Handle response
        // commit("", response);
        console.log(response);
    } catch (error) {
        console.error("Error sending data to API:", error);
    }
};
export const saveNewInvoice = async ({ commit, state }, id) => {
    console.log(id);
    const formData = new FormData();
    formData.append("invoiceNumber", state.newInvoice.invoiceNumber);
    formData.append("invoiceAttachment", state.newInvoice.invoiceAttachment);
    // formData.append("suportingDocument", state.newInvoice.suportingDocument);
    // console.log(formData);
    state.newInvoice.suportingDocument.forEach((file, i) => {
        formData.append(`suportingDocument[${i}]`, file);
    });
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
};
export const saveEditInvoice = async ({ commit }, editData) => {
    console.log(editData);
    const { id, invoiceNumber, deleteFile, addFile } = editData;
    const formData = new FormData();
    const reqData = {
        invoiceNumber,
        deleteFile,
    };

    formData.append("reqData", JSON.stringify(reqData));
    if (addFile.invoiceAttachment.name) {
        formData.append("invoiceAttachment", addFile.invoiceAttachment);
    }
    if (addFile.suportingDocument.length !== 0) {
        addFile.suportingDocument.forEach((file, i) => {
            formData.append(`suportingDocument[${i}]`, file);
        });
    }
    try {
        const response = await axios.post(`/api/editInvoice/${id}`, formData, {
            headers: {
                "Content-Type": "multipart/form-data",
            },
        });
        console.log(response.data);
    } catch (error) {
        console.error("Error :", error);
    }
};
export const deleteInvoice = async ({ commit }, id) => {
    console.log(id);
    try {
        const response = await axios.delete(`/api/deleteInvoice/${id}`);
        console.log(response);
        // commit("setInstructionDetail", response);
    } catch (error) {
        console.error("Error :", error);
    }
};
export const setInstructionToCompleted = async ({ commit }, id) => {
    console.log(id);
    try {
        const response = await axios.patch(`/api/instruction/completed/${id}`);
        console.log(response.data);
        commit("setInstructionDetail", response.data.instruction);
    } catch (error) {
        console.log(error);
    }
};
export const addInternalAttachment = async ({ commit }, reqData) => {
    console.log(reqData);

    const { id, file } = reqData;
    const formData = new FormData();
    formData.append(`internalAttachment`, file);

    try {
        const response = await axios.post(
            `/api/internalOnly/attachment/add/${id}`,
            formData,
            {
                headers: {
                    "Content-Type": "multipart/form-data",
                },
            }
        );
        console.log(response.data);
        // commit("setInstructionDetail", response);
    } catch (error) {
        console.error("Error :", error);
    }
};
export const deleteInternalAttachment = async ({ commit }, id) => {
    console.log(id);

    try {
        const response = await axios.delete(
            `/api/internalOnly/attachment/delete/${id}`
        );
        console.log(response.data);
        // commit("setInstructionDetail", response);
    } catch (error) {
        console.log(error);
    }
};
export const addInternalNotes = async ({ commit }, reqData) => {
    console.log(reqData);
    const { id, note } = reqData;
    try {
        const response = await axios.post(`/api/internalOnly/note/add/${id}`, {
            note,
        });
        console.log(response.data);
        // commit("setInstructionDetail", response);
    } catch (error) {
        console.log(error);
    }
};
export const editInternalNotes = async ({ commit }, reqData) => {
    const { id, note } = reqData;
    console.log(id, note);

    try {
        const response = await axios.patch(
            `/api/internalOnly/note/edit/${id}`,
            {
                note,
            }
        );
        console.log(response.data);
        // commit("setInstructionDetail", response);
    } catch (error) {
        console.log(error);
    }
};
export const deleteInternalNotes = async ({ commit }, id) => {
    console.log(id);
    try {
        const response = await axios.delete(
            `/api/internalOnly/note/delete/${id}`
        );
        console.log(response.data);
        // commit("setInstructionDetail", response);
    } catch (error) {
        console.log(error);
    }
};
export const downloadFile = async ({ commit }, file) => {
    try {
        const { name, path } = file;

        const response = await axios.get(`/api/download`, {
            params: {
                name,
                path,
            },
            responseType: "blob",
        });

        console.log(response.data);
        const url = window.URL.createObjectURL(new Blob([response.data]));
        console.log(url);
        const link = document.createElement("a");
        link.href = url;

        // Menentukan nama file untuk diunduh
        link.setAttribute("download", name);

        // Menambahkan tautan ke dokumen
        document.body.appendChild(link);

        // Memicu klik pada tautan untuk memulai unduhan
        link.click();

        // Menghapus tautan dari dokumen setelah unduhan selesai
        document.body.removeChild(link);

        // commit("setInstructionDetail", response);
    } catch (error) {
        console.log(error);
    }
};
// ====== EDIT PAGE ======
export const saveEditInstruction = async ({ commit, state }, reqData) => {
    const { status, id } = reqData;
    const addFiles = state.changeFile.addFiles;
    const editInstructionData = state.editIstruction;

    editInstructionData["deleteAttachment"] = state.changeFile.minFiles;
    editInstructionData.status = status;

    delete editInstructionData.internal_only_attachment;
    delete editInstructionData.internal_only_notes;
    delete editInstructionData.vendor_invoice;
    delete editInstructionData._id;
    console.log(editInstructionData);

    try {
        const formData = new FormData();
        formData.append("data", JSON.stringify(editInstructionData));
        addFiles.forEach((file, i) => {
            formData.append(`attachment[${i}]`, file);
        });

        const response = await axios.post(
            `/api/instruction/update/${id}`,
            formData,
            {
                headers: {
                    "Content-Type": "multipart/form-data",
                },
            }
        );

        console.log(response.data);
        commit("clearEditData");
        return response.data.id;
    } catch (error) {
        console.error("Error sending data to API:", error);
    }
};
