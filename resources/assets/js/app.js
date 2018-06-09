import axios from 'axios'
import Vue from 'vue'
import VueRouter from 'vue-router'
import { store } from './vuex/store.js'
import {routes} from './router/route.js'
import Vuetify from 'vuetify'
import MyPlugin from './plugins/my-vue-plugin.js'
import startUp from './mixins/start-up.js'
import master from './components/layouts/master.vue'
import Vue2Filters from 'vue2-filters'


window.base_api = 'http://localhost/iit/public/api';
window.base = 'http://localhost/iit/public/';

// window.base_api = 'http://cebu.it.nf/public/api';
// window.base = 'http://cebu.it.nf/public/';
Vue.use(Vuetify)
Vue.use(VueRouter)
Vue.use(MyPlugin)
Vue.use(Vue2Filters)

//Adding axios globally
Vue.prototype.$http = axios;

const router = new VueRouter({
  routes
})

router.beforeEach((to, from, next) => {
  if(to.meta.requiresAuth){
    var userLogin = JSON.parse(window.localStorage.getItem('userLogin'))
    var roles = window.localStorage.getItem('roles')
    var roles = roles.split(',')
    if (userLogin) {
        if (to.path === '/admin/payment' || to.path === '/admin/shs' || to.path === '/admin/jhs') {
            if(!roles.includes('admin')){
                next({name: 'home'})
            }
        }
        
    }
    else {
        next({ name: 'home'})
    }
  }else{
    next()
  }
  next()

})




const app = new Vue({
    el: '#app',
    router,
    store,
    mixins: [startUp],
    components: {
    	master
    }
    
});

