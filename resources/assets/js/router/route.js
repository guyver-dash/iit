import store from '../vuex/store.js'
import home from './home/index.vue'
import dashboard from './dashboard.vue'
import profile from './profile/index.vue'
import admission from './admission/index.vue'
import payment from './profile/payment.vue'

export const routes = [
	
		{ path: '/', component: home, name: 'home'}, 
		{ path: '/admission', component: admission, name: 'admission'},
		{ path: '/dashboard', component: dashboard, name: 'dashboard' , 
			meta: { requiresAuth: true}
		},
		{ path: '/profile', component: profile, name: 'profile', 
			meta: { requiresAuth: true}
		},
		{ path: '/admin/payment', component: payment, name: 'payment', 
			meta: { requiresAuth: true}
		},
		{ path: '/admin/shs', component: payment, name: 'shs', 
			meta: { requiresAuth: true}
		},
		{ path: '/admin/jhs', component: payment, name: 'jhs', 
			meta: { requiresAuth: true}
		}
	
	]