<template>
    <div class="item">
        {{ title }}
    </div>
</template>

<script>
export default {
    name: "Item",
    props: ['title']
}
</script>

<style scoped>
    .item {
        border: 1px solid #000;
        padding: 5px;
        text-align: center;
        margin-top: 10px;
    }
</style>
