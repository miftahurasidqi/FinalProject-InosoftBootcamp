<template>
    <div class="popup-overlay">
        <div class="popup-container">
            <div class="mb-2 modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">
                    {{ title }}
                </h1>
                <button
                    type="button"
                    class="close-button"
                    aria-label="Close"
                    @click="closePopup"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="25"
                        height="25"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
            <!-- <div class="popup-header"> -->
            <!--     <button @click="closePopup" class="close-button">X</button> -->
            <!-- </div> -->
            <div class="popup-content">
                <slot></slot>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Popup",
    props: {
        title: String,
    },
    methods: {
        closePopup() {
            this.$emit("close");
        },
    },
};
</script>

<style scoped>
.popup-overlay {
    position: fixed;
    z-index: 100;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    display: flex;
    align-items: center;
    justify-content: center;
}

.popup-container {
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    max-width: 500px;
    width: 100%;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}

.popup-header {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    padding-bottom: 10px;
    margin-bottom: 10px;
}

.close-button {
    background: none;
    border: none;
    cursor: pointer;
    font-size: 16px;
}

.popup-content {
    /* Styling untuk konten popup */
}
</style>
