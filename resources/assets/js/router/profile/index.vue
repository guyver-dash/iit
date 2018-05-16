<template>
	<v-container fluid fill-height class="ma-0 pa-0">
			<h1>Profile</h1>
	</v-container>
</template>

<script>
  export default {

    	components: {

    	},
    	created(){
            var roles =  window.localStorage.getItem('roles')
            var roles = roles.split(',')
            console.log(roles)
            if (roles.includes('registrar')) {
                this.$store.dispatch('items', [
                { icon: 'home', text: 'Home', to: '/' },
                { icon: 'account_circle', 
                    text: 'Profile', 
                    to: '/admin/profile/' + 
                    this.$string.toLowerCase(this.authUser.firstname + '-' + this.authUser.lastname) 
                },
                { icon: 'assignment_ind', text: 'Enrollees', to: '/admin/enrollees' },
                { icon: 'folder_shared', text: 'SHS', to: '/admin/shs' },
                { icon: 'folder_shared', text: 'JHS', to: '/admin/jhs'}
              ])
            }

            if (roles.includes('admin')) {
                this.$store.dispatch('items', [
                { icon: 'home', text: 'Home', to: '/' },
                { icon: 'account_circle', 
                    text: 'Profile', 
                    to: '/admin/profile/' + 
                    this.$string.toLowerCase(this.authUser.firstname + '-' + this.authUser.lastname) 
                },
                { icon: 'attach_money', text: 'Payments', to: '/admin/payments' },
                { icon: 'assignment_ind', text: 'Enrollees', to: '/admin/enrollees' },
                { icon: 'folder_shared', text: 'SHS', to: '/admin/shs' },
                { icon: 'folder_shared', text: 'JHS', to: '/admin/jhs'}
              ])
            }


    		

    	},
    	computed: {
    		authUser(){
    			return this.$store.getters.authUser
    		}
    	}
  }
</script>
