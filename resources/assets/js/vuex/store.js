import Vue from 'vue'
import Vuex from 'vuex'
import { state } from './state.js'

Vue.use(Vuex)


export const store = new Vuex.Store({
	state,
	mutations: {
		snackbar(state, snackbar){
			state.snackbar = snackbar
		},
		siblings(state, siblings){
			state.siblings = siblings
		},
		dialogAdmission(state, value){
			state.dialogAdmission = value
		},
		schoolYears(state, schoolYears){
			state.schoolYears = schoolYears
		},
		courses(state, courses){
			state.courses = courses
		},
		items(state, items){
			state.items = items
		},
		provinces(state, provinces){
			state.provinces = provinces
		},
		answers(state, answers){
			state.answers = answers
		},
		yearLevel(state, yearLevel){
			state.yearLevel = yearLevel
		}
	},
	actions: {
		removeSibling(store, key){

			var siblings = store.state.siblings
			delete siblings[key]

			var cleanArray = [];
            	for(var key in siblings){
            		if(siblings[key] !== null || siblings[key] !== undefined){
            			cleanArray.push(siblings[key])
            		}
            	}

			store.commit('siblings', cleanArray)
		},
		addSibling(store, sibling){

			var siblings = store.state.siblings;

			if(siblings === null){
				store.commit('siblings', [sibling]);
			}
			else {
				siblings.push(sibling);
				var newSiblings = store.state.siblings;
				store.commit('siblings', newSiblings);
			}

		},	
		answers(store, answers){
			store.commit('answers', answers)
		},
		provinces(store, provinces){
			store.commit('provinces', provinces);
		},
		dialogAdmission(store, dialogAdmission){
			store.commit('dialogAdmission', dialogAdmission);
		},
		schoolYears(store, schoolYears){
			store.commit('schoolYears', schoolYears);
		},
		courses(store, courses){
			store.commit('courses', courses);
		},
		items(store, items){
			store.commit('items', items);
		},
		snackbar(store, snackbar){
			store.commit('snackbar', snackbar)
		},
		yearLevel(store, yearLevel){
			store.commit('yearLevel', yearLevel)
		}
	},
	getters: {
		siblings(){
			return store.state.siblings
		},
		provinces(){
			return store.state.provinces
		},
		items(){

			return store.state.items
		},
		dialogAdmission(){

			return store.state.dialogAdmission
		},
		schoolYears(){
			return store.state.schoolYears
		},
		courses(){
			return store.state.courses
		},
		answers(){
			return store.state.answers
		},
		snackbar(){
			return store.state.snackbar
		},
		yearLevel(){
			return store.state.yearLevel
		}
	}
	
})

