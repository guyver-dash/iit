import Vue from 'vue'
import Vuex from 'vuex'
import { state } from './state.js'

Vue.use(Vuex)


export const store = new Vuex.Store({
	state,
	mutations: {
		authUser(state, authUser){
			state.authUser = authUser
		},
		userLogin(state, userLogin){
			state.userLogin = userLogin
		},
		endTime(state, endTime){
			state.endTime = endTime
		},
		startTime(state, startTime){
			state.startTime = startTime
		},
		birthday(state, birthday){
			state.birthday = birthday
		},
		registrationCompleted(state, registrationCompleted){
			state.registrationCompleted = registrationCompleted
		},
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
		questions(state, questions){
			state.questions = questions
		},
		yearLevel(state, yearLevel){
			state.yearLevel = yearLevel
		},
		semesters(state, semesters){
			state.semesters = semesters
		},
		schedules(state, schedules){
			state.schedules = schedules
		},
		requirements(state, requirements){
			state.requirements = requirements
		},
		policies(state, policies){
			state.policies = policies
		},
		civilStatus(state, civilStatus){
			state.civilStatus = civilStatus
		},
		educAtt(state, educAtt){
			state.educAtt = educAtt
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
		questions(store, questions){
			store.commit('questions', questions)
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
		registrationCompleted(store, registrationCompleted){
			store.commit('registrationCompleted', registrationCompleted)
		},
		yearLevel(store, yearLevel){
			store.commit('yearLevel', yearLevel)
		},
		semesters(store, semesters){
			store.commit('semesters', semesters)
		},
		schedules(store, schedules){
			store.commit('schedules', schedules)
		},
		requirements(store, requirements){
			store.commit('requirements', requirements)
		},
		policies(store, policies){
			store.commit('policies', policies)
		},
		civilStatus(store, civilStatus){
			store.commit('civilStatus', civilStatus)
		},
		birthday(store, birthday){
			store.commit('birthday', birthday)
		},
		educAtt(store, educAtt){
			store.commit('educAtt', educAtt)
		},
		startTime(store, startTime){
			store.commit('startTime', startTime)
		},
		endTime(store, endTime){
			store.commit('endTime', endTime)
		},
		userLogin(store, userLogin){
			store.commit('userLogin', userLogin)
		},
		authUser(store, authUser){
			store.commit('authUser', authUser)
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
		questions(){
			return store.state.questions
		},
		snackbar(){
			return store.state.snackbar
		},
		registrationCompleted(){
			return store.state.registrationCompleted
		},
		yearLevel(){
			return store.state.yearLevel
		},
		semesters(){
			return store.state.semesters
		},
		schedules(){
			return store.state.schedules
		},
		requirements(){
			return store.state.requirements
		},
		policies(){
			return store.state.policies
		},
		civilStatus(){
			return store.state.civilStatus
		},
		birthday(){
			return store.state.birthday
		},
		educAtt(){
			return store.state.educAtt
		},
		startTime(){
			return store.state.startTime
		},
		endTime(){
			return store.state.endTime
		},
		userLogin(){
			return store.state.userLogin
		},
		authUser(){
			return store.state.authUser
		}
	}
	
})

