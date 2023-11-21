// for Hompage start
export const setInstructions = (state, response) => {
    // merubah value state.instructions dengan data dari response
    // memeriksa respons yg diberikan adalah halaman 1
    if (response.data.page.currrentPage == 1) {
        // jika halaman = 1 maka ubah data openInstructions yg ada dalam state menjadi data yg berasal dari respons
        state.instructions.data = response.data.instructions;
        state.instructions.page = response.data.page;
    } else {
        // jika halaman != 1 maka tamahkan data openInstructions yg ada dalam state dengan data yg berasal dari respons
        state.instructions.data = state.instructions.data.concat(
            response.data.instructions
        );
        state.instructions.page.currrentPage = response.data.page.currrentPage;

        state.instructions.page.size =
            state.instructions.page.size + response.data.page.size;
    }
};
// for Hompage end

// for CreatePage start
export const setNewCostItems = (state, index) => {
    if (index === undefined) {
        state.newCostItems.push({
            description: "",
            qty: 0,
            uom: "",
            unitPrice: 0,
            gst: 0,
            currency: "",
            vatAmount: 0,
            subTotal: 0,
            total: 0,
            chargeTo: "",
        });
    } else {
        state.newCostItems.length == 1
            ? console.log("minimal 1 data")
            : state.newCostItems.splice(index, 1);
    }
};

export const calculateNewCostItem = (state, index) => {
    const item = state.newCostItems[index];

    item.subTotal = item.qty * item.unitPrice;
    item.vatAmount = (item.subTotal * item.gst) / 100;
    item.total = item.subTotal + item.vatAmount;

    state.newCostItems[index] = item;
};

export const setGrandTotal = (state) => {
    const costItems = state.newCostItems;
    const totalByCurrency = {};

    costItems.forEach((item) => {
        console.log(item);
        const { currency, vatAmount, subTotal, total } = item;

        // Mengecek apakah mata uang sudah ada dalam objek totalByCurrency
        if (currency !== "") {
            if (!totalByCurrency[currency]) {
                totalByCurrency[currency] = {
                    vatAmount: 0,
                    subTotal: 0,
                    total: 0,
                };
            }
            // Menjumlahkan data berdasarkan mata uang
            totalByCurrency[currency].vatAmount += vatAmount;
            totalByCurrency[currency].subTotal += subTotal;
            totalByCurrency[currency].total += total;
        }
    });

    // Mengonversi objek totalByCurrency ke dalam bentuk array
    state.newGrandTotal = Object.keys(totalByCurrency).map((currency) => ({
        currency,
        ...totalByCurrency[currency],
    }));
};
export const addAttacmentFile = ({ attacmentFile }, file) => {
    attacmentFile.push(file);
};
export const minAttacmentFile = ({ attacmentFile }, index) => {
    console.log(attacmentFile[index]);
    attacmentFile.splice(index, 1);
};

export const updateNewNote = ({ newIstruction }, note) => {
    newIstruction.costDetail.notes = note;
};

// for CreatePage end

// for Detailpage start
export const setInstructionDetail = (state, response) => {
    state.instructionDetail = response;
};
export const updateDescription = ({ inputStatusInfo }, description) => {
    inputStatusInfo.description = description;
    console.log(inputStatusInfo);
};
export const addAttacmentCancelFile = ({ inputStatusAttachmentFile }, file) => {
    inputStatusAttachmentFile.push(file);
};

export const removeAttacmentCancelFile = (
    { inputStatusAttachmentFile },
    index
) => {
    inputStatusAttachmentFile.splice(index, 1);
};

export const updateInvoiceNumber = ({ newInvoice }, value) => {
    newInvoice.invoiceNumber = value;
};
export const handleInputInvoiceAttachment = ({ newInvoice }, file) => {
    newInvoice.invoiceAttachment = file;
};
export const deleteInvoiceAttachment = ({ newInvoice }) => {
    newInvoice.invoiceAttachment = {};
};
export const handleInputSuportDoc = ({ newInvoice }, files) => {
    let suportDoc = [];
    for (let i = 0; i < files.length; i++) {
        suportDoc.push(files[i]);
    }
    newInvoice.suportingDocument =
        newInvoice.suportingDocument.concat(suportDoc);
};
export const deleteSuportDoc = ({ newInvoice }, index) => {
    newInvoice.suportingDocument.splice(index, 1);
};
// for Detailpage end

// for Editpage start
// for EditPage end
