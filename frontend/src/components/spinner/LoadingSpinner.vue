<template>
    <div id="loading" v-if="isMakingRequest">
        <half-circle-spinner
            class="spinner"
            :animation-duration="1000"
            :size="60"
            :color="'#00ff9d'"
        />
    </div>
</template>

<script>
import { HalfCircleSpinner } from 'epic-spinners'

export default {
    name: 'LoadingSpinner',
    components: {
        HalfCircleSpinner
    },
    computed: {
        isMakingRequest () {
            return this.$store.getters.isMakingRequest
        }
    }
}
</script>

<style scoped>
html,body{
    width: 100%;
    height:100%;
}
#loading {
    overflow: visible;
    position: fixed;
    background-color:rgba(0, 0, 0, 0.637);
    width: 100%;
    height: 100%;
    z-index: 10;
}
.spinner {
    top:50%;
    left:50%;
}
</style>
