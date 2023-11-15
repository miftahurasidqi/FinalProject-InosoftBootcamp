export const state = {
    // for Hompage start
    instructions: {
        data: [],
        page: {},
    },
    // for Hompage end

    // for CreatePage start
    newIstruction: {
        instructionType: "",
        linkTo: [],
        attentionOf: "",
        invoiceTo: "",
        assignedVendor: "",
        vendorAddress: "",
        vendorQuotationNo: "",
        customer: "",
        NoCustomerPO: "",
        status: "",
        costDetail: [],
    },
    newCostDetail: [
        {
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
        },
    ],
    pilihanInput: {
        linkTo: ["TRF-2020", "TRF-2021", "TRF-2022", "TRF-2023"],
        assignedVendor: [],
        customer: [],
        invoiceTo: [],
    },
    // for CreatePage end

    // for Detailpage start
    instructionDetail: {},

    // for Detailpage end
    // for Editpage start

    // for EditPage end
};
