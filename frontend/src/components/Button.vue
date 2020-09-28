<template>
    <div class="button-component">
        <button
            v-bind:class="buttonClass"
            id="send-personal-data-button"
            type="submit"
            class="btn button-primary"
        >
            <i :class="icon"></i>
            {{ content }}
        </button>
    </div>
</template>

<script>
export default {
    name: 'Button',
    props: ['content', 'icon', 'buttonClass']
}
</script>

<style scoped>
.button-primary {
    background-color: #00ff9d;
}
.button-primary:hover {
    background-color: #5dffbd;
}
.button-primary:current {
    background-color: #5dffbd;
}

.button-secondary {
    color: white;
    background-color: #2b2b2b;
}
.button-secondary .icon {
    color:white;
}
.button-secondary:hover {
    color: white;
    background-color: #4b4b4b;
}
</style>
