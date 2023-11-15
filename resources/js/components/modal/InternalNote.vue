<template>
    <div class="container-modal">
        <div class="modal-internal-note">
            <div class="heading">
                <h1>Internal Note</h1>
            </div>
            <div class="form-isi">
                <form action="text">
                    <label
                        for=""
                        style="
                            font-weight: 500;
                            color: rgb(92, 92, 92);
                            font-size: small;
                        "
                        >By Winata Admin</label
                    >
                    <textarea
                        name="deskripsi"
                        id="isi"
                        cols="30"
                        rows="6"
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
    name: "InternalNote",
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

.modal-internal-note {
    position: relative;
    height: 400px;
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
}

.form-isi {
    padding-left: 3rem;
    padding-right: 3rem;
}
.form-isi form {
    display: flex;
    flex-direction: column;
}

.buttons {
    display: flex;
    justify-content: flex-end;
    align-items: flex-end;
    height: 100px;
    padding-left: 3rem;
    padding-right: 3rem;
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
