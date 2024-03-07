export const state = {
    // ====== HOME PAGE ======
    instructions: {
        data: [],
        page: {},
    },
    // ====== FOR CREATE PAGE ======
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

    // ====== DETAIL PAGE ======
    instructionDetail: {
        costDetail: {
            costItems: [],
            grandTotal: [],
            notes: "",
        },
        vendor_invoice: [
            {
                invoiceAttachment: {
                    name: "",
                    path: "",
                },
                suportingDocument: [],
            },
        ],
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

    // ====== EDIT PAGE ======
    editIstruction: {
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
    changeFile: {
        addFiles: [],
        minFiles: [],
    },
};
