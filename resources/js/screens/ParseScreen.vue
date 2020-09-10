<template>
    <div class="row " v-if="parseMode">
        <div class="col-md-12">
            <textarea class="form-control" rows="10" v-model="items"></textarea>
            <button class="btn btn-primary mt-2" @click="parse">Parse</button>
        </div>
    </div>
</template>

<script>
export default {
    name: "ParseView",
    data() {
        return {
            items: [],
            parseMode: true
        }
    },
    methods: {
        parse() {
            if (this.items.length === 0) {
                alert('Keine Datensätze eingetragen.');
                return;
            }

            this.items = JSON.parse(this.items);
            this.parseMode = false;
            this.currentItem = this.items[this.currentIndex];
        },
    }
}
</script>

<style scoped>

</style>
