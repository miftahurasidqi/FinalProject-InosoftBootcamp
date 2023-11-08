<template>
    <div>
        <h1>3rd Party Instruction</h1>
        <form @submit.prevent="submitForm">
            <div class="card">
                <div>
                    <div class="d-flex justify-content-between">
                        <select class="form-select info-top-panel" aria-label="Select instruction type"
                            v-model="formData.instructionType">
                            <option>Service Instruction</option>
                            <option>Logistic Instruction</option>
                            <!-- Make the option dynamic later -->
                        </select>
                        <div class="info-top-panel">
                            <p>Draft</p>
                        </div>
                    </div>
                    <div>
                        <div>
                            <label for="assigned-vendor">Assigned Vendor</label>
                            <select name="assigned-vendor" id="" v-model="formData.assignedVendor">
                                <option disabled value="">Enter Vendor</option>
                                <option>1</option>
                                <option>2</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <button>submit</button>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    name: "CreatePage",
    data() {
        return {
            formData: {
                // bagian dari v-model
                // sesuaikan dengan database
                instructionType: "",
                assignedVendor: "",
                status: "In Progress",
            },
        };
    },
    methods: {
        async submitForm() {
            // pindahkan ke actions nanti
            try {
                const response = await axios.post(
                    "/api/postData",
                    this.formData,
                );
                console.log(response);
            } catch (error) {
                console.error(error);
            }
        },
    },
};
</script>

<style scoped>
.info-top-panel {
    width: 40%;
}
</style>
