<template>
	<v-container class="ma-2 pa-0" fluid>
    <v-layout class="ma-0 pa-0">
      <v-flex xl3 lg3 md3 sm3 xs3>
         <v-menu right>
          <v-btn slot="activator" color="primary" dark>New Balance</v-btn>
          <v-list>
            <v-list-tile v-for="(item, index) in items" :key="index" @click="">
              <v-list-tile-title>{{ item.title }}</v-list-tile-title>
            </v-list-tile>
          </v-list>
        </v-menu>
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
        <balance ref="newBalance" v-bind:confirmid="this.$route.params.id"></balance>
      </v-flex>
    </v-layout>
    </v-container>
</template>

<script>
  import balance from '../../components/data-tables/balance.vue'
  export default {
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
