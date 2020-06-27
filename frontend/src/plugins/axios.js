import Vue from 'vue'
import axios from 'axios'

axios.defaults.baseURL = 'https://api.pipe.run'

Vue.use({
  install (Vue) {
    Vue.prototype.$http = axios
  }
})
