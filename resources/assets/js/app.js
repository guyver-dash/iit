import axios from 'axios'
import Vue from 'vue'
import VueRouter from 'vue-router'
import { store } from './vuex/store.js'
import {routes} from './router/route.js'
import Vuetify from 'vuetify'
import MyPlugin from './plugins/my-vue-plugin.js'

import master from './components/layouts/master.vue'

window.base_api = 'http://localhost/iit/public/api';
window.base = 'http://localhost/iit/public/';

// window.base_api = 'http://cebu.it.nf/public/api';
// window.base = 'http://cebu.it.nf/public/';



Vue.use(Vuetify)
Vue.use(VueRouter)
Vue.use(MyPlugin)

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
    if (userLogin ) {
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
    components: {
    	master
    },
    created: function () {

    let token = localStorage.getItem('tokenKey');
    let data = this
     this.$http
          .get(base_api + '/start-up')
          .then(function(response){
            data.$store.dispatch('courses', response.data.courses)
            data.$store.dispatch('provinces', response.data.provinces)
            data.$store.dispatch('schoolYears', response.data.schoolYears)
            data.$store.dispatch('yearLevel', response.data.yearLevels)
            data.$store.dispatch('schedules', response.data.schedules)
            data.$store.dispatch('semesters', response.data.semesters)
            data.$store.dispatch('questions', response.data.questions)
            data.$store.dispatch('requirements', response.data.requirements)
            data.$store.dispatch('policies', response.data.policies)
            data.$store.dispatch('civilStatus', response.data.civilStatus)
            data.$store.dispatch('educAtt', response.data.educAtt)
          }) 
    if(token != null && token.length > 30){
        
        this.$http.get(base_api + '/user?token=' + token)
        .then(function(response){
            
            data.$store.dispatch('userLogin', true)
            data.$store.dispatch('authUser', response.data.user)
            window.localStorage.setItem('roles', response.data.roles)
            window.localStorage.setItem('userLogin', true)
            
        })
        .catch(function(error){
            data.$store.dispatch('userLogin', false)
            localStorage.setItem('tokenKey', 'token_expired')
            window.localStorage.setItem('roles', null)
             window.localStorage.setItem('userLogin', false)
        });
    }


  }
    
});

