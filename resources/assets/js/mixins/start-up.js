export default {

        created(){

        let token = localStorage.getItem('tokenKey');
        let data = this
         
        if(token != null && token.length > 30){
            
            this.$http.get(base_api + '/user?token=' + token)
            .then(function(response){
                
                data.$store.dispatch('userLogin', true)
                data.$store.dispatch('authUser', response.data.user)
                data.$store.dispatch('role', response.data.myRoles)
                window.localStorage.setItem('roles', response.data.roles)
                window.localStorage.setItem('userLogin', true)
                
            })
            .catch(function(error){
                data.$store.dispatch('userLogin', false)
                localStorage.setItem('tokenKey', 'token_expired')
                window.localStorage.setItem('roles', null)
                window.localStorage.setItem('userLogin', false)
                data.$router.push('/')
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
                { icon: 'account_circle', 
                    text: 'Profile', 
                    to: '/profile'
                },
                { icon: 'format_bold', text: 'Balance', to: '/admin/balance' },
                { icon: 'attach_money', text: 'Payments', to: '/admin/payments' },
                { icon: 'attach_money', text: 'Training Payments', to: '/admin/training-payments' },
                { icon: 'assignment_ind', text: 'Enrollees', to: '/admin/enrollees' },
                { icon: 'folder_shared', text: 'SHS', to: '/admin/shs' },
                { icon: 'folder_shared', text: 'JHS', to: '/admin/jhs'},
                { icon: 'folder_shared', text: 'ICT', to: '/admin/ict'},
                { icon: 'donut_small', text: 'Collection Reports', to: '/admin/collections'}
              ])

        }
    }
}