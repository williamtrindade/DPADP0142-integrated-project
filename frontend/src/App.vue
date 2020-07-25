<template>
    <div id="app" class="full-height full-width float-left">
        <!-- <div id="nav">
        <router-link to="/">Home</router-link> |
        </div>-->
        <router-view />
    </div>
</template>

<script>
export default {
    name: 'App',
    mounted () {
        if (
            !localStorage.getItem('access_token')
        ) {
            this.$router.push({ name: 'login' })
        }
    }
}
</script>

<style lang="scss">
@import "assets/scss/custom.css";

html, body {
    width: 100%;
    height: 100%;
    float: left;
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
    float: left;
    width: 100%;
    height: 100%;
    max-height: 100%;
    max-width: 100%;
    padding-left: 70px;
}
</style>
