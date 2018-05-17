export default {

        created(){

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

        var roles = window.localStorage.getItem('roles')

        if (roles.includes('registrar')){
        	this.$store.dispatch('items', [
                { icon: 'home', text: 'Home', to: '/' },
                 { icon: 'dashboard', text: 'Dashboard', to: '/dashboard' },
                { icon: 'account_circle', 
                    text: 'Profile', 
                    to: '/profile'
                },
                { icon: 'attach_money', text: 'Payments', to: '/registrar/payments' },
                { icon: 'assignment_ind', text: 'Enrollees', to: '/registrar/enrollees' },
                { icon: 'folder_shared', text: 'SHS', to: '/registrar/shs' },
                { icon: 'folder_shared', text: 'JHS', to: '/registrar/jhs'}
              ])
        }

        if (roles.includes('admin')){
        	 this.$store.dispatch('items', [
                { icon: 'home', text: 'Home', to: '/' },
                 { icon: 'dashboard', text: 'Dashboard', to: '/dashboard' },
                { icon: 'account_circle', 
                    text: 'Profile', 
                    to: '/profile'
                },
                { icon: 'attach_money', text: 'Payments', to: '/admin/payments' },
                { icon: 'assignment_ind', text: 'Enrollees', to: '/admin/enrollees' },
                { icon: 'folder_shared', text: 'SHS', to: '/admin/shs' },
                { icon: 'folder_shared', text: 'JHS', to: '/admin/jhs'}
              ])

        }
    }
}