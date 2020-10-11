<template>
    <button
        v-bind:class="buttonClass"
        id="send-personal-data-button"
        type="submit"
        :disabled="this.$store.getters.isMakingRequest"
        class="btn secondary button-component"
    >
        <i :class="icon"></i>
        {{ content }}
    </button>
</template>

<script>
export default {
    name: 'BackButton',
    props: ['content', 'icon', 'buttonClass']
}
</script>

<style scoped>
.primary {
    background-color: #00ff9d;
}
.primary:hover {
    background-color: #5dffbd;
}

.secondary {
    color: white;
    background-color: #474747;
}
.secondary .icon {
    color:white;
}
.secondary:hover {
    color: white;
    background-color: #4b4b4b;
}

.black {
    color: #ffffff;
    border: none;
    background-color: #242424;
    transition: 1s;
}
.black:hover {
    color: white;
    background-color: #000000;
}
</style>
