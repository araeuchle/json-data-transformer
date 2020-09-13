<template>
    <div>
        <div class="row">
            <div class="col-sm-4 offset-sm-4">
                <div class="alert alert-info">
                    Hier kannst du nun deine geänderten Daten entweder als JSON oder als CSV Datei exportieren.
                </div>
                <select class="form-control" v-model="format">
                    <option value="">Bitte auswählen</option>
                    <option value="json">JSON</option>
                    <option value="csv">CSV</option>
                </select>

                <button type="submit" class="btn btn-primary mt-3" @click="exportHandler">
                    Exportieren
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: "ExportScreen",
    data() {
        return {
            format: ''
        }
    },
    methods: {
        exportHandler() {
            let data = {
                items: this.$store.state.items,
                format: this.format
            }

            axios.post('api/export', data, {
                responseType: 'arraybuffer',
            })
                .then(response => {
                    const url = window.URL.createObjectURL(new Blob([response.data]));
                    const link = document.createElement('a');
                    link.href = url;
                    link.setAttribute('download', 'data.' + this.format); //or any other extension
                    document.body.appendChild(link);
                    link.click();
                })
                .catch(error => {
                    console.log(error);
                });
        }
    }
}
</script>

<style scoped>

</style>
