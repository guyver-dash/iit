<template>
	<v-container class="ma-2 pa-0" fluid>
    <v-layout class="ma-0 pa-0">
      <v-flex xl3 lg3 md3 sm3 xs3>
         <h1 class="pa-2">Enrollees</h1>
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
        <enrollees v-bind:printUrl="'api/confirm-enrolled/print/'"></enrollees>
      </v-flex>
    </v-layout>
	</v-container>
</template>

<script>
import startUp from '../mixins/start-up.js'
import enrollees from '../components/data-tables/enrollees.vue'
  export default {
      data: ()=>({
        search: ''
      }),
      mixins: [startUp],
      components:{
        enrollees
      },
    	computed: {
    		authUser(){
    			return this.$store.getters.authUser
    		},
        page(){
          return this.$store.getters.page
        }
    	},
      created() {
        this.changePage()
      },
      methods: {
        changePage(){
          let data = this
          this.$http.get(base_api + '/confirm-enrolled?page=' + this.page + '&token=' + window.localStorage.getItem('tokenKey')
          )
          .then(function(res){
            data.$store.dispatch('enrollees', res.data.enrollees)
          })
          .catch(function(error){
            data.$router.push('/')
          })
        },
      },
      watch: {
        search: function(val){
          var data = this
          this.$http.post(base_api + '/confirm-enrolled/search?token=' + window.localStorage.getItem('tokenKey'),{
              search: val
          })
            .then(function(res){
              data.$store.dispatch('enrollees', res.data.enrollees)
            })
            .catch()
        },
        page(){
          this.changePage()
        }
      }
  }
</script>
