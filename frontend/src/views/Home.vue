<template>
    <h1>Home</h1>
</template>

<script>
export default {
    name: 'Home',

    components: {},
    mounted () {
        this.$router.push({ name: 'manager-dash' })
    }
}
</script>
