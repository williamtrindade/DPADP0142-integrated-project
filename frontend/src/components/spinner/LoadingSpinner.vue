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
#loading {
    background-color:rgba(0, 0, 0, 0.37);
    width: 100%;
    height: 100%;
    position: absolute;
    z-index: 2;
}
.spinner {
    top:50%;
    position: absolute;
    left:50%;
}
</style>
