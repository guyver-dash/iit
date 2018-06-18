<template>
	<v-container class="ma-2 pa-0" fluid>
    <v-layout class="ma-0 pa-0">
      <v-flex xl3 lg3 md3 sm3 xs3>
         <h1 class="pa-2">Balance Enrollee</h1>
      </v-flex>
      <v-flex xl9 lg9 md9 sm9 xs9>
         <v-text-field
          v-model="search"
          append-icon="search"
          label="Search"
          single-line
          hide-details
        ></v-text-field>
      </v-flex>
    </v-layout>
    <v-layout class="ma-0 pa-0">
      <v-flex xl12 lg12 md12 sm12 xs12>
        <balance-enrollee ref="newBalance" v-bind:confirmid="this.$route.params.id"></balance-enrollee>
      </v-flex>
    </v-layout>
    </v-container>
</template>

<script>
  import balanceEnrollee from '../../components/data-tables/balance-enrollee.vue'
  export default {
        data: ()=>({
            search: '',
        }),
    	components: {
            balanceEnrollee
    	},
    	created(){
            
           
            

    	},
    	computed: {
    		authUser(){
    			return this.$store.getters.authUser
    		}
    	},
        methods: {

            
        },
    watch: {
      
      search(val){
        let data = this
       
      }
    }
  }
</script>
