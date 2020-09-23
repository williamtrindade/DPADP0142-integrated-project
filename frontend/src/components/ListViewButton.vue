<template>
    <button
        class="button-component btn-sm button"
        id="send-personal-data-button"
        type="submit"
    >
        <i :class="icon"></i>
        {{ content }}
    </button>
</template>

<script>
export default {
    name: 'ListViewButton',
    props: ['content', 'icon']
}
</script>

<style scoped>
.button {
    margin: 3%;
    width: 35px;
    height: 35px;
    text-align: center;
    justify-content: center;
    border-radius: 0;
    color:rgb(41, 41, 41);
    transition: 0.5s;
    padding: 0%;
    border:2.5px solid rgb(46, 46, 46);
}
.button:hover {
    color: #fff;
    border:2.5px solid rgba(0, 255, 115, 0.884);
    background-color:  rgba(0, 255, 115, 0.884);
}
.icon {
}
</style>
