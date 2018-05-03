import axios from 'axios'
import Vue from 'vue'
import VueRouter from 'vue-router'
import { store } from './vuex/store.js'
import {routes} from './router/route.js'
import Vuetify from 'vuetify'

import master from './components/layouts/master.vue'


window.base_api = 'http://localhost/iit/public/api';
window.base = 'http://localhost/iit/public/';

// window.base_api = 'http://cebu.it.nfpublic/api';
// window.base = 'http://cebu.it.nf/public';



Vue.use(Vuetify)
Vue.use(VueRouter)
Vue.prototype.$http = axios;

const router = new VueRouter({
  routes
})


const app = new Vue({
    el: '#app',
    router,
    store,
    components: {
    	master
    },
	  mounted () {
	  	var data = this
	    this.$http
	      .get(base_api + '/start-up')
	      .then(function(response){
            data.$store.dispatch('courses', response.data.courses)
            data.$store.dispatch('provinces', response.data.provinces)
            data.$store.dispatch('schoolYears', response.data.schoolYears)
            data.$store.dispatch('yearLevel', response.data.yearLevels)
          }) 
	  }
    
});

