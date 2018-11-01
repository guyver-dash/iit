
export default {

	created(){

		 let data = this
          this.$http.get(base_api + '/semester?token=' + window.localStorage.getItem('tokenKey')
          )
          .then(function(res){
            data.$store.dispatch('semesters', res.data.semesters)
          })

          this.$http.get(base_api + '/school_year',
            { headers: {
                "token" : window.localStorage.getItem('tokenKey')
              }
            }
          )
          .then(function(res){
            data.$store.dispatch('schoolYears', res.data.schoolYears)
          })
	}
}