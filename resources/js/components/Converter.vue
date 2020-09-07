<template>
    <div class="container p-5">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1>JSON Converter</h1>
            </div>
        </div>
        <div class="row mt-3" v-if="!parseMode">
            <div class="col-md-6 text-center">
                <h3>Felder</h3>

                <div class="row mt-3" v-for="(value, propertyName) in currentItem">
                    <label>{{ propertyName }}</label>
                    <input type="text"  class="form-control"   v-model="currentItem[propertyName]" />
                </div>

                <div class="row mt-3">
                    <div class="col-md-12" style="padding-right: 0; padding-left: 0;">
                        <button class="btn btn-danger float-left" @click="ignore">Ignorieren</button>
                        <button class="btn btn-success float-right" @click="save">Speichern</button>
                    </div>
                </div>

            </div>
            <div class="col-md-6 text-center">
                <h3>Karte</h3>
            </div>
        </div>
        <div class="row mt-3" v-else>
            <textarea class="form-control" rows="10" v-model="items"></textarea>
            <button class="btn btn-primary mt-2" @click="parse">Parse</button>
        </div>
    </div>
</template>

<script>
export default {
    name: "Converter",
    data() {
        return {
            parseMode: true,
            items: [],
            currentItem: {},
            currentIndex: 0,
            convertedItems: []
        }
    },
    methods: {
        parse: function() {
            if (this.items.length === 0) {
                alert('Keine Datensätze eingetragen.');
                return;
            }

            this.items = JSON.parse(this.items);
            this.parseMode = false;
            this.getCurrentItem();
        },
        getCurrentItem() {
            this.currentItem = this.items[this.currentIndex]
        },
        save() {
            this.convertedItems.push(this.currentItem);
            this.currentIndex += 1
        },
        ignore() {
            this.currentIndex += 1
        }
    }
}
</script>

<style scoped>

</style>
