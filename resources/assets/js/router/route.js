import store from '../vuex/store.js'
import home from './home/index.vue'
import school from './home/school.vue'
import students from './home/students.vue'
import industryPartner from './home/industry-partner.vue'
import contact from './home/contact.vue'
import dashboard from './dashboard.vue'
import profile from './profile/index.vue'
import admission from './admission/index.vue'
import editAdmission from './admission/editAdmission.vue'
import balance from './profile/balance.vue'
import payment from './profile/payment.vue'
import trainingPayments from './profile/training-payments.vue'
import shs from './profile/shs.vue'
import jhs from './profile/jhs.vue'
import ict from './profile/ict.vue'
import collections from './profile/collections.vue'
import balanceEnrollee from './profile/balance-enrollee.vue'
import enrollees from './enrollees.vue'

export const routes = [
	
		{ path: '/', component: home, name: 'home'}, 
		{ path: '/school', component: school, name: 'school'},
		{ path: '/students', component: students, name: 'students'},
		{ path: '/contact-us', component: contact, name: 'contact'},
		{ path: '/industry-partner', component: industryPartner, name: 'industryPartner'},
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
		{ path: '/admin/training-payments', component: trainingPayments, name: 'trainingPayments', 
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
		},
		{ path: '/admin/ict', component: ict, name: 'ict', 
			meta: { requiresAuth: true}
		},
		{ path: '/admin/collections', component: collections, name: 'collections', 
			meta: { requiresAuth: true}
		}
	
	]