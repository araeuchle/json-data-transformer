<template>
    <div class="item">
        {{ title}} (<a href="">Wiederherstellen</a>)
    </div>
</template>

<script>
export default {
name: "Snapshot",
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
