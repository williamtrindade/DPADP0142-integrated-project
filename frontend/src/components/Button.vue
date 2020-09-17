<template>
    <div class="button-component">
        <button
            id="send-personal-data-button"
            type="submit"
            class="btn button-primary ml-2"
            style="color:#000000">
            <i :class="icon"></i>
            {{ content }}
        </button>
    </div>
</template>

<script>
export default {
    name: 'Button',
    props: ['content', 'icon']
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
</style>
