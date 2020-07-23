<template>
  <div class="home">
    <img alt="Vue logo" src="../assets/logo.png">
  </div>
</template>

<script>

export default {
  name: 'Home',
  components: {
  },
  created () {
    this.$http
      .get()
      .then(function (res) {
        console.log(res)
      })
  },
  mounted () {

  }
}
</script>
