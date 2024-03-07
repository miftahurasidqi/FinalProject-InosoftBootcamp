<template>
    <div id="attachment-panel">
        <div class="a-l">
            <h6>Attachment</h6>
            <div>
                <div
                    v-for="(attachment, index) in costDetail.attachment"
                    :key="index"
                >
                    <p>
                        <span class="download" @click="download(attachment)">
                            <DownloadIcon />
                        </span>
                        {{ attachment.name }}
                    </p>
                </div>
            </div>
        </div>
        <div class="a-r">
            <label for="notes">Notes</label>
            <textarea disabled name="notes" id="" v-model="costDetail.notes">
            </textarea>
        </div>
    </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

export default {
    name: "Attachment",
    computed: {
        ...mapGetters({
            costDetail: "costDetail",
        }),
    },
    methods: {
        ...mapActions({
            downloadFile: "downloadFile",
        }),
        download(file) {
            this.downloadFile(file);
        },
    },
};
</script>

<style scoped>
.container-cd {
    margin: 0rem 2rem;
    border: none;
    border-top: 1px solid rgb(200, 200, 200);
    border-radius: 0px;
    padding-top: 1rem;
}

.container-table-cd {
    border: 1px solid rgb(189, 189, 189);
}

.container-cd p {
    font-weight: 700;
}

.table-head tr th {
    background: rgb(165, 165, 165);
    color: white;
    font-size: small;
}

.table-body tr td {
    font-size: small;
    font-weight: 600;
    color: rgb(120, 120, 120);
    background: rgb(250, 250, 250);
}
.table-body-2 td {
    border: none;
}

#attachment-panel {
    height: auto;
    display: flex;
    padding: 0px 10px;
    padding-bottom: 10px;
}
.a-l {
    width: 40%;
}
.a-l p {
    font-weight: 500;
    color: rgb(98, 98, 98);
}
.a-l button {
    background: rgb(0, 162, 162);
    padding: 0.3rem 2rem;
    border: none;
    border-radius: 4px;
    color: white;
    font-weight: 600;
}
.a-r {
    display: flex;
    flex-direction: column;
    width: 60%;
}

.a-r label {
    font-size: medium;
    font-weight: 500;
    color: rgb(98, 98, 98);
}

.a-r textarea {
    border: none;
    height: 100px;
    background: rgb(245, 245, 245);
}
.download {
    margin-right: 5px;
}
</style>
