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
            !localStorage.getItem('authenticated') ||
      !localStorage.getItem('access_token') ||
      !localStorage.getItem('refresh_token')
        ) {
            this.$router.push({ name: 'login' })
        }
    }
}
</script>

<style lang="scss">
@import "assets/scss/custom.css";

html, body {
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
</style>
