<template>
	<v-container fluid fill-height class="ma-0 pa-0">
			<h1>Payments</h1>
	</v-container>
</template>

<script>
  export default {

    	components: {

    	},
    	created(){
           

    	},
    	computed: {
    		authUser(){
    			return this.$store.getters.authUser
    		}
    	}
  }
</script>
