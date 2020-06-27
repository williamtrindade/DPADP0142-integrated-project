<template>
  <div class="home">
    <img alt="Vue logo" src="../assets/logo.png">
    <HelloWorld msg="Welcome to Your Vue.js App"/>
  </div>
</template>

<script>
export default {
  name: 'Home',
  components: {
  },
  created () {
    this.$http.get().then(res => console.log(res))
  },
  mounted () {

  }
}
</script>
