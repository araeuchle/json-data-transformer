<template>
    <div>
        <div class="row">
            <div class="col-sm-8 offset-sm-2">
                <div class="alert alert-info">
                    Die Adresse muss für die Weiterverarbeitung ein bestimmtes Format haben. Beispiel:<br />
                    <br />
                    Straße/Hausnummer,Postleitzahl,Ort,Bundesland,Land
                </div>
                <div class="row mt-3">
                    <div class="col-sm-6 mt-3" v-for="(value, propertyName) in currentItem">
                        <label>{{ propertyName }}</label>
                        <input type="text"  class="form-control"   v-model="currentItem[propertyName]" />
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
export default {
    name: "EditView",
    computed: {
        currentItem() {
            return this.$store.state.currentItem;
        },
        iframeUrl() {
            return this.$store.state.currentItem[this.$store.state.websiteField];
        }
    }
}
</script>

<style scoped>

</style>
