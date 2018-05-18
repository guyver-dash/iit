<template>
	<v-container fluid fill-height >
    <v-layout>
      <v-flex xl12 lg12 md12 sm12 xs12>
			 <h1>Enrollees</h1>
        <enrollees></enrollees>
      </v-flex>
    </v-layout>
	</v-container>
</template>

<script>
import startUp from '../mixins/start-up.js'
import enrollees from '../components/data-tables/enrollees.vue'
  export default {
      mixins: [startUp],
      components:{
        enrollees
      },
    	computed: {
    		authUser(){
    			return this.$store.getters.authUser
    		}
    	}
  }
</script>
