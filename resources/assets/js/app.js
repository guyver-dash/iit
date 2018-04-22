import axios from 'axios'
import Vue from 'vue'
import VueRouter from 'vue-router'
import { store } from './vuex/store.js'
import {routes} from './router/route.js'
import Vuetify from 'vuetify'

import master from './components/layouts/master.vue'


window.base_api = 'http://localhost/iit/public/api/';
window.base = 'http://localhost/iit/public/';



Vue.use(Vuetify)
Vue.use(VueRouter)

const router = new VueRouter({
  routes
})


const app = new Vue({
    el: '#app',
    router,
    store,
    components: {
    	master
    }
    
});

