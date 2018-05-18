<template>
	<v-container fluid fill-height class="ma-0 pa-0">
			<h1>Dashboard</h1>
	</v-container>
</template>

<script>
import startUp from '../mixins/start-up.js'

  export default {
      mixins: [startUp],
    	computed: {
    		authUser(){
    			return this.$store.getters.authUser
    		}
    	}
  }
</script>
