<template>
    <button class="btn">{{ text }}</button>
</template>

<script>
export default {
    name: "ActionButton",
    props: {
        text: {
            type: String,
        },
    },
};
</script>

<style scoped>
button {
    background: none;
    border: none;
    color: black;
    padding: 1rem;
}
</style>
