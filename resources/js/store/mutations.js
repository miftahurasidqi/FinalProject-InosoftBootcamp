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
