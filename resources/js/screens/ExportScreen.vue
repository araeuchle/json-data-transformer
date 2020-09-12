<template>
    <div>
        <div class="alert alert-info">
            Hier kannst du nun deine geänderten Daten entweder als JSON oder als CSV Datei exportieren.
        </div>
        <select class="form-control">
            <option>JSON</option>
            <option>CSV</option>
        </select>

        <button type="submit" class="btn btn-primary mt-3">Exportieren</button>
    </div>
</template>

<script>
export default {
    name: "ExportScreen"
}
</script>

<style scoped>

</style>
