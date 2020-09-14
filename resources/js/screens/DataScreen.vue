<template>
    <div>
        <div class="row">
            <div class="col-sm-6">
                <div class="row mt-3">
                    <div class="col-sm-6 mt-3" v-for="(value, propertyName) in currentItem">
                        <label>{{ propertyName }}</label>
                        <input type="text"  class="form-control"   v-model="currentItem[propertyName]" />
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <iframe :src="'https://' + currentItem['Website']" frameborder="0" style="width: 100%; height: 800px;"></iframe>
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
