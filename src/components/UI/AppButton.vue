<template>
    <button class="btn">
        <slot></slot>
    </button>
</template>

<script>
export default {
    name: 'app-button'
}
</script>

<style scoped>
.btn {
    display: inline-block;
    color: #fff;
    font-size: 13px;
    font-weight: 500;
    padding: 6px 20px;
    transition: all .3s;
    border: none;
    outline: none;
}
</style>