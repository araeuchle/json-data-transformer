<template>
    <div class="row " v-if="parseMode">
        <div class="col-sm-4 offset-sm-4">
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

            let parsedItems = JSON.parse(this.items);

            this.$store.dispatch('setItems', parsedItems);
            this.$store.dispatch('setCurrentItem', parsedItems[0]);
            this.$store.dispatch('setViewMode', 'data');
        },
    }
}
</script>

<style scoped>

</style>
