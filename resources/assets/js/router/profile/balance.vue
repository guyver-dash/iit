<template>
	<v-container class="ma-2 pa-0" fluid>
    <v-layout class="ma-0 pa-0">
      <v-flex xl3 lg3 md3 sm3 xs3>
         <v-btn slot="activator" color="primary" dark @click="dialog3Show">New Balance</v-btn>
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
    <v-layout class="ma-0 pa-0 mt-2">
      <v-flex xl12 lg12 md12 sm12 xs12>
        <balance ref="newBalance" v-bind:confirmid="this.$route.params.id"></balance>
      </v-flex>
    </v-layout>
    </v-container>
</template>

<script>
  import balance from '../../components/data-tables/balance.vue'
  import semestersSY from '../../mixins/semestersSY.js'

  export default {
      mixins:[semestersSY],
        data: ()=>({
            search: '',
            items: [
              { title: 'Click Me' },
              { title: 'Click Me' },
              { title: 'Click Me' },
              { title: 'Click Me 2' }
            ]
        }),
    	components: {
            balance
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
            dialog3Show(){
              this.$refs.newBalance.dialog3 = true
            },
            confirmEnrolled(){
                var data = this
                this.$http.get(window.base_api + '/confirm-enrolled/' + this.$route.params.id+ '?token=' + localStorage.getItem('tokenKey'))
                    .then(function(res){
                        data.$store.dispatch('confirmEnrolledPayment', res.data.enrollee)
                    })
            }
        },
    watch: {
      
      search(val){
        let data = this
        this.$http.post(base_api + '/balance/search?token=' + localStorage.getItem('tokenKey'),{
          search: val
        }).then(function(res){
            data.$store.dispatch('balances', res.data.balances);
        })
      }
    }
  }
</script>
