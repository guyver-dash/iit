import Vue from 'vue'
import Vuex from 'vuex'
import { state } from './state.js'

Vue.use(Vuex)


export const store = new Vuex.Store({
	state,
	mutations: {
		trainingPayments(state, payload){
			state.trainingPayments = payload
		},
		newTrainingDialog(state, payload){
			state.newTrainingDialog = payload
		},
		loaderMessage(state, loaderMessage){
			state.loader = loaderMessage
		},
		loader(state, loader){
			state.loader = loader
		},
		balanceEnrollees(state, balanceEnrollees){
			state.balanceEnrollees = balanceEnrollees
		},
		confirmEnrolledId(state, confirmEnrolledId){
			state.confirmEnrolledId = confirmEnrolledId
		},
		dueDate(state, dueDate){
			state.dueDate = dueDate
		},
		payments(state, payments){
			state.payments = payments
		},
		balance_ids(state, balance_ids){
			state.balance_ids = balance_ids
		},
		balance(state, balance){
			state.balance = balance
		},
		balances(state, balances){
			state.balances = balances
		},
		course_ids(state, course_ids){
			state.course_ids = course_ids
		},
		givenAmount(state, givenAmount){
			state.givenAmount = givenAmount
		},
		page(state, page){
			state.page = page
		},
		studentType(state, studentType){
			state.studentType = studentType
		},
		confirmEnrolledPayment(state, confirmEnrolledPayment){
			state.confirmEnrolledPayment = confirmEnrolledPayment
		},
		confirmedEnrolled(state, confirmedEnrolled){
			state.confirmedEnrolled = confirmedEnrolled
		},
		removeSiblingEdit(state, siblings){
			state.confirmedEnrolled.enrollee.siblings = siblings
		},
		addSiblingEdit(state, siblings){
			state.confirmedEnrolled.enrollee.siblings = siblings
		},
		answersEdit(state, answers){
			state.confirmedEnrolled.enrollee.answers[answers['index']].id = answers['value']
		},
		
		confirmedEnrolledEnrollee(state, payload){
			state.confirmedEnrolled.enrollee[payload['field']] = payload['value']
		},
		confirmedEnrolledField(state, payload){
			state.confirmedEnrolled[payload['field']] = payload['value']
		},
		enrollees(state, enrollees){
			state.enrollees = enrollees
		},
		password(state, password){
			state.password = password
		},
		authUser(state, authUser){
			state.authUser = authUser
		},
		authUserField(state, authUserField){
			state.authUser[authUserField[0]] = authUserField[1]
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
		snackbarText(state, snackbarText){
			state.snackbarText = snackbarText
		},
		snackbarColor(state, snackbarColor){
			state.snackbarColor = snackbarColor
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
		},
		
		roles(state, roles){
			state.roles = roles
		},
		role(state, role){
			state.role = role
		}
	},
	actions: {
		trainingPayments(store, payload){
			store.commit('trainingPayments', payload)
		},
		newTrainingDialog(store, payload){
			store.commit('newTrainingDialog', payload)
		},
		loaderMessage(store, loaderMessage){
			store.commit('loaderMessage', loaderMessage)
		},
		loader(store, loader){
			store.commit('loader', loader)
		},
		balanceEnrollees(store, balanceEnrollees){
			store.commit('balanceEnrollees', balanceEnrollees)
		},
		confirmEnrolledId(store, confirmEnrolledId){
			store.commit('confirmEnrolledId', confirmEnrolledId)
		},
		dueDate(store, dueDate){
			store.commit('dueDate', dueDate)
		},
		payments(store, payments){
			store.commit('payments', payments)
		},
		balance_ids(store, balance_ids){
			store.commit('balance_ids', balance_ids)
		},
		balance(store, balance){
			store.commit('balance', balance)
		},
		balances(store, balances){
			store.commit('balances', balances)
		},
		course_ids(store, course_ids){
			store.commit('course_ids', course_ids)
		},
		givenAmount(store, givenAmount){
			store.commit('givenAmount', givenAmount)
		},
		page(store, page){
			store.commit('page', page)
		},
		studentType(store, studentType){
			store.commit('studentType', studentType);
		},
		answersEdit(store, answers){
			store.commit('answersEdit', answers);
		},
		addSiblingEdit(store, sibling){

			var siblings = store.state.confirmedEnrolled.enrollee.siblings;
			if(siblings === null){
				store.commit('addSiblingEdit', [sibling]);
			}
			else {
				siblings.push(sibling);
				var newSiblings = store.state.confirmedEnrolled.enrollee.siblings;
				store.commit('addSiblingEdit', newSiblings);
			}

		},
		removeSiblingEdit(store, key){
			var siblings = store.state.confirmedEnrolled.enrollee.siblings
			delete siblings[key]

			var cleanArray = [];
            	for(var key in siblings){
            		if(siblings[key] !== null || siblings[key] !== undefined){
            			cleanArray.push(siblings[key])
            		}
            	}

			store.commit('removeSiblingEdit', cleanArray)
		},
		confirmEnrolledPayment(store, confirmEnrolledPayment){
			store.commit('confirmEnrolledPayment', confirmEnrolledPayment)
		},
		confirmedEnrolledEnrollee(store, payload){
			store.commit('confirmedEnrolledEnrollee', payload)
		},
		confirmedEnrolled(store, confirmedEnrolled){
			store.commit('confirmedEnrolled', confirmedEnrolled)
		},
		confirmedEnrolledField(store, confirmedEnrolledField){
			store.commit('confirmedEnrolledField', confirmedEnrolledField)
		},
		enrollees(store, enrollees){
			store.commit('enrollees', enrollees)
		},
		role(store, role){
			store.commit('role', role)
		},
		roles(store, roles){
			store.commit('roles', roles) 
		},
		authUserField(store, authUserField){
			store.commit('authUserField', authUserField)
		},
		password(store, password){
			store.commit('password', password)
		},
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
			store.commit('snackbar', snackbar);
		},
		snackbarText(store, snackbarText){
			store.commit('snackbarText', snackbarText)
		},
		snackbarColor(store, snackbarColor){
			store.commit('snackbarColor', snackbarColor)
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
		trainingPayments(){
			return store.state.trainingPayments
		},
		newTrainingDialog(){
			return store.state.newTrainingDialog
		},
		loaderMessage(){
			return store.state.loaderMessage
		},
		loader(){
			return store.state.loader
		},
		balanceEnrollees(){
			return store.state.balanceEnrollees
		},
		confirmEnrolledId(){
			return store.state.confirmEnrolledId
		},
		dueDate(){
			return store.state.dueDate
		},
		payments(){
			return store.state.payments
		},
		balance_ids(){
			return store.state.balance_ids
		},
		balance(){
			return store.state.balance
		},
		balances(){
			return store.state.balances
		},
		course_ids(){
			return store.state.course_ids
		},
		givenAmount(){
			return store.state.givenAmount
		},
		page(){
			return store.state.page
		},
		studentType(){
			return store.state.studentType
		},
		confirmEnrolledPayment(){
			return store.state.confirmEnrolledPayment
		},
		confirmedEnrolled(){
			return store.state.confirmedEnrolled
		},
		enrollees(){
			return store.state.enrollees
		},
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
		snackbarText(){
			return store.state.snackbarText
		},
		snackbarColor(){
			return store.state.snackbarColor
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
		},
		password(){
			return store.state.password
		},
		roles(){
			return store.state.roles
		},
		role(){
			return store.state.role
		}
	}
	
})

