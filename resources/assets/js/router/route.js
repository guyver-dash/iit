import store from '../vuex/store.js'
import home from './home/index.vue'
import dashboard from './dashboard.vue'
import profile from './profile/index.vue'
import admission from './admission/index.vue'
import editAdmission from './admission/editAdmission.vue'
import balance from './profile/balance.vue'
import payment from './profile/payment.vue'
import shs from './profile/shs.vue'
import jhs from './profile/jhs.vue'
import balanceEnrollee from './profile/balance-enrollee.vue'
import enrollees from './enrollees.vue'

export const routes = [
	
		{ path: '/', component: home, name: 'home'}, 
		{ path: '/admission', component: admission, name: 'admission'},
		{ path: '/dashboard', component: dashboard, name: 'dashboard' , 
			meta: { requiresAuth: true}
		},
		{ path: '/profile', component: profile, name: 'profile', 
			meta: { requiresAuth: true}
		},
		{ path: '/admin/balance', component: balance, name: 'balance', 
			meta: { requiresAuth: true}
		},
		{ path: '/admin/balance-enrollee', component: balanceEnrollee, name: 'balanceEnrollee', 
			meta: { requiresAuth: true}
		},
		{ path: '/admin/payments', component: payment, name: 'payments', 
			meta: { requiresAuth: true}
		},
		{ path: '/admin/enrollees', component: enrollees, name: 'enrollees', 
			meta: { requiresAuth: true}
		},
		{ path: '/admin/admission/:id', component: editAdmission, name: 'editAdmission', 
			meta: { requiresAuth: true}
		},
		{ path: '/admin/shs', component: shs, name: 'shs', 
			meta: { requiresAuth: true}
		},
		{ path: '/admin/jhs', component: jhs, name: 'jhs', 
			meta: { requiresAuth: true}
		}
	
	]