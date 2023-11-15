<template>
    <div class="container-modal">
        <div class="modal-internal-note">
            <div class="heading">
                <h4>Reason of Cancellation</h4>
            </div>
            <div>
                <p style="font-size: small; font-weight: 500">Canceled By</p>
                <p style="font-weight: 500; margin-top: -10px">Winata Admin</p>
            </div>
            <div class="form-isi">
                <form action="text">
                    <label
                        for=""
                        style="
                            font-weight: 500;
                            color: rgb(92, 92, 92);
                            font-size: medium;
                        "
                        >Description</label
                    >
                    <textarea
                        name="deskripsi"
                        id="isi"
                        cols="30"
                        rows="10"
                        placeholder="   Enter your Note"
                        style="
                            font-size: small;
                            line-height: 30px;
                            font-weight: 500;
                            margin-top: 10px;
                            background: rgb(241, 241, 241);
                        "
                    ></textarea>
                </form>
            </div>
            <div class="box-i-a">
                <h6>Attachment</h6>
                <div>
                    <label class="b-attachment" for="document-file-input">
                        <span
                            style="
                                font-size: 1.5rem;
                                font-weight: 600;
                                margin-right: 10px;
                            "
                            >+</span
                        >
                        <span>Add Attachments</span>
                    </label>
                    <input
                        type="file"
                        id="document-file-input"
                        style="display: none"
                        @change="handleFileChange"
                    />
                </div>
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
    name: "ReasonCancellation",
};
</script>

<style scoped>
.heading {
    display: flex;
    justify-content: center;
    align-items: center;
}

p {
    color: rgb(92, 92, 92);
}

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
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    height: 500px;
    width: 600px;
    padding-top: 2rem;
    padding-bottom: 2rem;
    padding-left: 2rem;
    padding-right: 2rem;
    background: rgb(255, 255, 255);
}

.form-isi form {
    display: flex;
    flex-direction: column;
    height: 180px;
    margin-bottom: 1rem;
}

.box-i-a {
    height: 100px;
    display: flex;
    flex-direction: column;
    justify-content: space-around;
}

.b-attachment {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 35px;
    width: 200px;
    border-radius: 8px;
    border: none;
    font-weight: 500;
    transition: 0.3s;
    background: rgb(95, 190, 155);
    color: white;
    transition: 0.3s;
}

.b-attachment:hover {
    background: rgb(80, 159, 130);
}

.buttons {
    display: flex;
    justify-content: flex-end;
    align-items: flex-end;
    height: 100px;
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
