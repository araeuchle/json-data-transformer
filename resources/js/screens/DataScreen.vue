<template>
    <div>
        <div class="row">
            <div class="col-sm-4 offset-sm-4">
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
