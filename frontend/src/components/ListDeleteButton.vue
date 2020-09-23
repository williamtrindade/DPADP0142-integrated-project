<template>
    <button
        class="button-component btn-sm button-danger"
        id="send-personal-data-button"
        type="submit"
    >
        <i :class="icon"></i>
        {{ content }}
    </button>
</template>

<script>
export default {
    name: 'ListDeleteButton',
    props: ['content', 'icon']
}
</script>

<style scoped>
.button-danger {
    margin: 3%;
    width: 35px;
    height: 35px;
    border-radius: 0;
    color:rgb(41, 41, 41);
    transition: 0.5s;
    padding: 0%;
    border:2.5px solid rgb(46, 46, 46);
}
.button-danger:hover {
    color: #fff;
    border:2.5px solid rgb(255, 0, 76);
    background-color: rgb(255, 0, 76);
}
</style>
