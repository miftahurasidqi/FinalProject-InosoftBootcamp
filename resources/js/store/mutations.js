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
export const setNewCostDetail = (state, index) => {
    console.log(index);
    if (index === undefined) {
        state.newCostDetail.push({
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
        state.newCostDetail.length == 1
            ? console.log("minimal 1 data bang")
            : state.newCostDetail.splice(index, 1);
    }
};
// for CreatePage end

// for Detailpage start
export const setInstructionDetail = (state) => {
    console.log("mutation");
};

// for Detailpage end

// for Editpage start
// for EditPage end
