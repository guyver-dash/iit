import Vue from 'vue'
import Vuex from 'vuex'
import { state } from './state.js'

Vue.use(Vuex)


export const store = new Vuex.Store({
	state,
	mutations: {
		dialogAdmission(state, value){
			state.dialogAdmission = value
		}
	},
	actions: {

		dialogAdmission(store, dialogAdmission){
			store.commit('dialogAdmission', dialogAdmission);
		},
	},
	getters: {

		items(){

			return store.state.items
		},
		dialogAdmission(){

			return store.state.dialogAdmission
		}
	}
	
})

