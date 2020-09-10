<template>
    <div>
        <div class="row mt-3" v-for="(value, propertyName) in currentItem">
            <label>{{ propertyName }}</label>
            <input type="text"  class="form-control"   v-model="currentItem[propertyName]" />
        </div>
    </div>
</template>

<script>
export default {
    name: "EditView"
}
</script>

<style scoped>

</style>
