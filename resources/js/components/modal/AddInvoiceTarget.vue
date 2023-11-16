<template>
    <div class="container-modal">
        <div class="modal-invoice-target">
            <div class="heading">
                <h1>Add Invoice Target</h1>
            </div>
            <div class="form-isi">
                <form action="text">
                    <label
                        for=""
                        style="
                            font-weight: 500;
                            color: rgb(92, 92, 92);
                            font-size: medium;
                            margin-bottom: 5px;
                        "
                        >Invoice To</label
                    >
                    <textarea
                        name="deskripsi"
                        id="isi"
                        cols="30"
                        rows="2"
                        placeholder="  Invoice To"
                        class="ph"
                    ></textarea>
                </form>
            </div>
            <div class="buttons">
                <button class="b-cancel">Cancel</button>
                <input type="submit" value="Submit" class="b-submit" />
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "AddInvoiceTarget",
};
</script>

<style scoped>
.container-modal {
    position: fixed;
    top: 0;
    left: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    width: 100vw;
    background: rgba(0, 0, 0, 0.5);
    z-index: 9999;
}

.modal-invoice-target {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    position: relative;
    height: 300px;
    width: 800px;
    background: rgb(255, 255, 255);
}

.heading {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100px;
}

.heading h1 {
    font-size: x-large;
    font-weight: 700;
    color: rgb(101, 101, 101);
}

.form-isi {
    padding-left: 3rem;
    padding-right: 3rem;
}
.form-isi form {
    display: flex;
    flex-direction: column;
    height: 76px;
    margin-top: -2rem;
}

.ph {
    line-height: 36px;
    background: rgb(238, 238, 238);
    border-radius: 5px;
}

.buttons {
    display: flex;
    justify-content: flex-end;
    align-items: flex-end;
    height: 100px;
    padding-left: 3rem;
    padding-right: 3rem;
    padding-bottom: 2rem;
}

.b-cancel,
.b-submit {
    height: 50px;
    width: 200px;
    border-radius: 8px;
    border: none;
    background: none;
    font-weight: 500;
    transition: 0.3s;
}

.b-cancel:hover {
    background: rgb(213, 213, 213);
}
.b-submit {
    background: rgb(95, 190, 155);
    color: white;
}

.b-submit:hover {
    background: rgb(80, 159, 130);
}
</style>
