<template>
    <input :value="modelValue" @input="updateInput" text="text" class="search-input">
</template>

<script>
export default {
    name: 'app-input',
    props: {
        modelValue: [String, Number]
    },
    methods: {
        updateInput(event) {
            this.$emit('update:modelValue', event.target.value);
        }
    }
}
</script>

<style scoped>
.search-input {
	height: 40px;
	border: 1px solid #eee!important;
	font-size: 13px;
	font-weight: 500;
	color: #2e3e51;
	outline: none;
	padding: 0px 15px;
}
.search-input:focus-visible {
    border: 1px solid rgb(84 184 129 / 70%);
}
</style>