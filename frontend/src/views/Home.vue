<template>
    <h1>Home</h1>
</template>

<script>
export default {
    name: 'Home',
    mounted () {
        this.$router.push({ name: 'login' })
    }
}
</script>
