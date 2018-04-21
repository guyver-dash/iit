
var app = new Vue({
	el: '#app',
	data: {
		value: '',
		admissions: [],
		schoolyears: [],
		courses: [],
		semesters: [],
		schedules: [],
		civilstatus: [],
		genders: [],
		csid : '',
		show: false
	},

	created: function(){
		
		this.ajaxAll()
		
	},
	methods: {

		ajaxAll: _.debounce( function(){
			var app = this
			var admissions = 'admissions'
			var schoolYear = 'schoolyear'
			axios.all([this.getAllData('api/enrolldata',['admissions', 'schoolyears', 'courses', 'semesters', 'schedules', 'genders', 'civilstatus'])]);
				
		}),

		getAllData: function(url, value){
			var app = this
			return axios.get(url)
				.then(function(response){
					for (var i = value.length - 1; i >= 0; i--) {
						app[value[i]] = response.data[value[i]]
					}
				})
		},

		checkSingle: function(){
			
			if(this.csid == 1){
				this.show = true
			}
				
			else{
				this.show = false	
			}
				

		}


	}
})