<template>
    <div>
        <div class="row">
            <div class="col-sm-4 offset-sm-4">
                <div class="alert alert-info">
                    Hier kannst du verschiedene Einstellungen für den JSON Viewer vornehmen.
                </div>

                <div class="form-group">
                    <label for="searchField">Suchfeld</label>
                    <input type="text" class="form-control" v-model="searchField" />

                </div>

                <button class="btn btn-primary mt-3" @click="saveConfigHandler">Speichern</button>
            </div>
        </div>

    </div>
</template>

<script>
export default {
    name: "ConfigScreen",
    mounted() {
        this.searchField = this.$store.state.searchField;
    },
    data() {
        return {
            searchField: '',
        }
    },
    methods: {
        saveConfigHandler() {
            this.$store.dispatch('setSearchField', this.searchField);

            alert("Die Änderungen wurden erfolgreich gespeichert.");
        }
    }
}
</script>

<style scoped>

</style>
