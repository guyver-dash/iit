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
import * as VueGoogleMaps from 'vue2-google-maps'

export const EventBus = new Vue();

// window.base_api = 'http://localhost:8099/iit/public/api';
// window.base = 'http://localhost:8099/iit/public/';

// window.base_api = 'http://localhost/iit/public/api';
// window.base = 'http://localhost/iit/public/';
window.base_api = 'http://iitcebu.net/public/api';
window.base = 'http://iitcebu.net/public/';
Vue.use(Vuetify)
Vue.use(VueRouter)
Vue.use(MyPlugin)
Vue.use(Vue2Filters)
Vue.use(VueGoogleMaps, {
  load: {
    key: 'AIzaSyATumGc3ktPcZyeOItj1YLUV9o2wB9ZU1M',
    libraries: 'places', // This is required if you use the Autocomplete plugin
    // OR: libraries: 'places,drawing'
    // OR: libraries: 'places,drawing,visualization'
    // (as you require)

    //// If you want to set the version, you can do so:
    // v: '3.26',
  },

  //// If you intend to programmatically custom event listener code
  //// (e.g. `this.$refs.gmap.$on('zoom_changed', someFunc)`)
  //// instead of going through Vue templates (e.g. `<GmapMap @zoom_changed="someFunc">`)
  //// you might need to turn this on.
  // autobindAllEvents: false,

  //// If you want to manually install components, e.g.
  //// import {GmapMarker} from 'vue2-google-maps/src/components/marker'
  //// Vue.component('GmapMarker', GmapMarker)
  //// then disable the following:
  // installComponents: true,
})

//Adding axios globally
Vue.prototype.$http = axios;

const router = new VueRouter({
	mode: 'history',
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

