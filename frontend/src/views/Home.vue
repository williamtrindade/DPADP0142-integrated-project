<template>
    <h1>Home</h1>
</template>

<script>
export default {
    name: 'Home',
    components: {},
    created () {},
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
