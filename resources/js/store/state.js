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
        customerContract: "",
        NoCustomerPO: "",
        status: "",
        costDetail: {
            costItems: [],
            grandTotal: [],
            notes: "",
        },
    },
    newCostItems: [
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
    newGrandTotal: [],
    attacmentFile: [],

    // harusnya data ini dari BE
    pilihanInput: {
        linkTo: [
            "TRF-2020",
            "TRF-2021",
            "TRF-2022",
            "TRF-2023",
            "TRF-2024",
            "TRF-2025",
            "TRF-2026",
            "TRF-2027",
            "TRF-2028",
            "TRF-2029",
            "TRF-2010",
            "TRF-2011",
            "TRF-2012",
            "TRF-2013",
            "TRF-2014",
            "TRF-2015",
        ],
        assignedVendor: [],
        customer: [],
        invoiceTo: [],
    },
    // for CreatePage end

    // for Detailpage start
    instructionDetail: {
        costDetail: {
            costItems: [],
            grandTotal: [],
            notes: "",
        },
        vendor_invoice: [],
    },
    inputStatusInfo: {
        canceledBy: "User 1",
        description: "",
    },
    inputStatusAttachmentFile: [],
    // ====
    newInvoice: {
        invoiceNumber: "",
        invoiceAttachment: {},
        suportingDocument: [],
    },

    // for Detailpage end

    // for Editpage start
    editIstruction: {
        costDetail: {
            costItems: [],
            grandTotal: [],
            notes: "",
        },
    },
};
