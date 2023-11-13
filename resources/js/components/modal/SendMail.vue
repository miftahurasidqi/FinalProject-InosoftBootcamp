<template>
    <div class="container-modal">
        <div class="modal-internal-note">
            <div class="heading">
                <h1>Send Mail</h1>
            </div>
            <div>
                <div class="detail-isi">
                    <p>Contractor</p>
                    <p>Contractor Email</p>
                </div>
                <div class="isi">
                    <h4>Qube Logistic</h4>
                    <div class="pilihan">
                        <p>Recipents</p>
                        <div class="check">
                            <img
                                src="../../../assets/svg/angle-up-solid.svg"
                                class="icons"
                            />
                        </div>
                    </div>
                </div>
            </div>
            <div class="attachments">
                <p>Attachment</p>
                <a href="">link.pdf</a>
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
    name: "SendMail",
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
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    height: 400px;
    width: 800px;
    background: rgb(255, 255, 255);
}

.heading {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 80px;
}

.heading h1 {
    font-size: large;
    font-weight: 700;
    color: rgb(101, 101, 101);
}

.detail-isi {
    display: flex;
    padding: 0rem 3rem;
    /* height: 20px; */
}

.detail-isi p {
    width: 50%;
    font-size: small;
    font-weight: 600;
    color: rgb(101, 101, 101);
}

.isi {
    padding: 0rem 3rem;
    color: rgb(101, 101, 101);
}

.isi h4 {
    font-size: medium;
    margin-bottom: 2rem;
}

.isi .pilihan p {
    margin: 5px 0px;
}

.check {
    display: flex;
    justify-content: end;
    align-items: center;
    padding: 0px 10px;
    height: 35px;
    background: rgb(243, 243, 243);
    border-radius: 4px;
    border: 1px solid rgb(101, 101, 101);
    cursor: pointer;
}

.icons {
    height: 20px;
    width: 20px;
    transform: rotate(180deg);
}

.attachments {
    padding: 1rem 3rem;
}

.attachments p {
    margin: 0;
    font-size: small;
    font-weight: 600;
    color: rgb(101, 101, 101);
}

.attachments a {
    font-size: small;
    font-weight: 600;
}

.buttons {
    display: flex;
    justify-content: end;
    align-items: end;
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
