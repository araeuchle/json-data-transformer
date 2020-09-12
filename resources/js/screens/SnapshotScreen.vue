<template>
    <div>
        <div class="row">
            <div class="col-sm-4 offset-sm-4">
                <div class="alert alert-info">
                    Hier kannst du deine Zwischenspeicherstände widerherstellen und löschen.
                </div>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Dateiname</th>
                        <th>Optionen</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="snapshot in snapshots">
                        <td>
                            {{ snapshot }}
                        </td>
                        <td>
                            <button class="btn btn-outline-secondary" @click="restoreHandler(snapshot)" title="Widerherstellen">
                                <Zondicon icon="reload" style="height: 18px;" />
                            </button>
                            <button class="btn btn-outline-secondary" @click="deleteHandler(snapshot)" title="Löschen">
                                <Zondicon icon="trash" style="height: 18px;" />
                            </button>
                        </td>
                    </tr>
                    </tbody>
                </table>

                <a href="#" @click="deleteAllHandler">Alle Löschen</a>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: "SnapshotScreen",
    mounted() {
        axios.get('api/snapshots')
            .then(response => {
                this.snapshots = response.data.data;
            })
    },
    data() {
        return {
            snapshots: []
        }
    },
    methods: {
        restoreHandler(file) {
            axios.get('api/snapshots/restore/' + file)
                .then(response => {
                    if (!response.data.status) {
                        alert("Die Datei wurde nicht gefunden.");
                        return;
                    }

                    let data = response.data.data;

                    this.$store.dispatch('restoreData', data);
                    this.$store.dispatch('setViewMode', 'data');
                    alert("Der Zwischenstand wurde erfolgreich wieder hergestellt");
                })
                .catch(error => {
                    console.log(error);
                })
        },
        deleteHandler(file) {
            axios.delete('api/snapshots/' + file)
                .then(response => {
                    this.snapshots = response.data.data;
                    alert("Der Zwischenstand wurde erfolgreich gelöscht");
                })
                .catch(error => {
                    console.log(error);
                })
        },
        deleteAllHandler() {
            axios.delete('api/snapshots')
                .then(response => {
                    this.snapshots = response.data.data;
                    alert("Alle Zwischenstände wurden gelöscht");
                })
                .catch(error => {
                    console.log(error);
                })
        }
    }
}
</script>

<style scoped>

</style>
