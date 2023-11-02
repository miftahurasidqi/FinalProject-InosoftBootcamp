<template>
    <button type="button" class="btn btn-secondary">{{ text }}</button>
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
