<template>
	<v-container class="ma-2 pa-0" fluid>
    <v-layout class="ma-0 pa-0">
      <v-flex xl3 lg3 md3 sm3 xs3>
         <h1 class="pa-2">Payments</h1>
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
        <payments ref="newPayment" v-bind:confirmid="this.$route.params.id"></payments>
      </v-flex>
    </v-layout>
    </v-container>
</template>

<script>
  import payments from '../../components/data-tables/payments.vue'
  export default {
        data: ()=>({
            search: '',
        }),
    	components: {
            payments
    	},
    	created(){
            
            if (Number.isInteger(this.$route.params.id)) {
                this.confirmEnrolled()
            }
            

    	},
    	computed: {
    		authUser(){
    			return this.$store.getters.authUser
    		}
    	},
        methods: {

            confirmEnrolled(){
                var data = this
                this.$http.get(window.base_api + '/confirm-enrolled/' + this.$route.params.id+ '?token=' + localStorage.getItem('tokenKey'))
                    .then(function(res){
                        data.$store.dispatch('confirmEnrolledPayment', res.data.enrollee)
                    })
            }
        }
  }
</script>
