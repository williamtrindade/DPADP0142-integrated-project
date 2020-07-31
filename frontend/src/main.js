import Vue from 'vue'
import App from './App.vue'
import Notifications from 'vue-notification'
import './registerServiceWorker'
import router from './router'
import store from './store'
import './plugins/axios'

// we import jquery and pooperjs
import 'bootstrap'
import 'bootstrap/dist/css/bootstrap.min.css'

Vue.use(Notifications)
Vue.config.productionTip = false
new Vue({
    router,
    store,
    render: h => h(App)
}).$mount('#app')
