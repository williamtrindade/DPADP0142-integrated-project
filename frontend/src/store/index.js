import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        isMakingRequest: false
    },
    mutations: {
        isMakingRequest (state, bool) {
            state.isMakingRequest = bool
        }
    },
    actions: {
    },
    modules: {
    },
    getters: {
        isMakingRequest: state => {
            return state.isMakingRequest
        }
    }
})
