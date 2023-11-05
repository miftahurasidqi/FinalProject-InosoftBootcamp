<template>
    <div id="page-body">
        <h1>3rd Party Instruction</h1>
        <!-- <DetailPageContent /> -->
        <div class="card">
            <h2>{{ instruction.instructionId }}</h2>
            <div id="top-panel" class="flex-wrap d-flex justify-content-between">
                <div>
                    <p>Back</p>
                </div>
                <div class="d-flex fles-row">
                    <p>Terminate</p>
                    <p>Modify</p>
                </div>
            </div>
            <div id="info-panel" class="flex-row card d-flex justify-content-evenly">
                <div>
                    <p>Type</p>
                    <p>{{ instruction.instructionType }}</p>
                </div>
                <div>
                    <p>LI No.</p>
                    <p>{{ instruction.instructionId }}</p>
                </div>
                <div>
                    <p>Transfer No.</p>
                    <p>{{ instruction.linkTo }}</p>
                </div>
                <div>
                    <p>Customer</p>
                    <p>no data yet</p>
                </div>
                <div>
                    <p>Customer PO</p>
                    <p>{{ instruction.customerPO }}</p>
                </div>
                <div>
                    <p>Statsu</p>
                    <p>{{ instruction.status }}</p>
                </div>
                <div>
                    <p>Attention Of</p>
                    <p>{{ instruction.attentionOf }}</p>
                </div>
                <div>
                    <p>Assigned Vendor</p>
                    <p>{{ instruction.assignedVendor }}</p>
                </div>
                <div>
                    <p>Vendor Address</p>
                    <p>no data yet</p>
                </div>
            </div>
            <hr />
            <div id="cost-detail-panel" class="card">
                <h2>Cost Detail</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Description</th>
                            <th>QTY</th>
                            <th>UOM</th>
                            <th>Unit Price</th>
                            <th>Discount</th>
                            <th>GST(%)</th>
                            <th>Currency</th>
                            <th>Vat Amount</th>
                            <th>Sub Total</th>
                            <th>Total</th>
                            <th>Charge To</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="detail in instruction.costDetails">
                            <td>{{ detail.description }}</td>
                            <td>{{ detail.qty }}</td>
                            <td>{{ detail.uom }}</td>
                            <td>{{ detail.unitPrice }}</td>
                            <td>{{ detail.discount }}</td>
                            <td>{{ detail.gst }}</td>
                            <td>{{ detail.currency }}</td>
                            <td>{{ detail.vatAmount }}</td>
                            <td>{{ detail.subTotal }}</td>
                            <td>{{ detail.total }}</td>
                            <td>{{ detail.chargeTo }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div id="attachment-panel" class="d-flex justify-content-between">
                <div>
                    <h2>Attachment</h2>
                    <button>Add Attachment</button>
                </div>
                <div>
                    <label for="notes">Notes</label>
                    <textarea name="notes" id="" cols="10" rows="10"></textarea>
                </div>
            </div>
            <div id="vendor-invoice">
                <h2>Vendor Invoice</h2>
                <button>Add Vendor Invoice</button>
            </div>
            <div id="internal-panel-header">
                <h2>For Internal Only</h2>
            </div>
            <div id="internal-panel" class="d-flex">
                <div>
                    <h3>Attachment</h3>
                    <button>Add Attachments</button>
                </div>
                <div>
                    <h3>Internal Notes</h3>
                    <button>Add Internal Note</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
// import DetailPageContent from "../DetailPageContent.vue";

export default {
    name: "DetailPage",
    //components: {
    //    DetailPageContent,
    //},
    computed: {
        instruction() {
            return this.$store.getters["getInstructionById"](
                this.$route.params.id,
            );
        },
    },
};
</script>

<style scoped>
#page-body {
    margin: 2rem;
}

#attachment-panel {
    height: 300px;
}

#internal-panel-header {
    background-color: black;
    color: white;
}

textarea {
    max-height: 50%;
}
</style>
