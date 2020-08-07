<template>
    <div id="app" class="full-height full-width">
        <notifications group="error" position="left bottom" class="mt-3 error"/>
        <notifications group="success" position="bottom left" class="mb-4 success"/>
        <notifications group="danger" position="bottom left" class="mb-4 danger"/>
        <router-view />
    </div>
</template>

<script>
export default {
    name: 'App',
    mounted () {
        if ((!localStorage.getItem('access_token')) && (this.$route.fullPath === 'auth/register')) {
            this.$router.push({ name: 'login' })
        }
    }
}
</script>

<style lang="scss">
@import "assets/scss/custom.css";
.error .vue-notification {
    margin-left: 70px;
    background-color: #ff5959;
    border-left: #000000 solid 2px;
}
.success .vue-notification {
    margin-left: 70px;
    background-color: #00ff9d;
    color: black;
    border-left: #000000 solid 2px;
}
.danger .vue-notification {
    margin-left: 70px;
    background-color: #d53764;
    border-left: #000000 solid 2px;
}
html, body {
    float: left;
    width: 100%;
    height: 100%;
    margin: 0;
    padding: 0;
}
h1 label {
  color: #000;
}
.full-width {
  width: 100%;
}
.full-height {
    height: 100%;
}
.float-left {
  float: left;
}
.float-right {
    float: right;
}
.content {
    padding-top: 70px;
    padding-left: 70px;
    height: 100%;
    min-height: 100%;
}
.link-text {
    color: #fff;
    text-decoration: underline;
    transition: 0.5s;
}
.link-text:hover {
    color: #00ff9d;
}
</style>
