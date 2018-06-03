<template>
    <v-container class="ma-2 pa-0" >
    <v-layout class="ma-0 pa-0">
      <v-flex xl3 lg3 md3 sm3 xs3>
         <h1 class="pa-2">SHS</h1>
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
        <enrollees v-bind:printUrl="'api/example'"></enrollees>
      </v-flex>
    </v-layout>
    </v-container>
</template>

<script>
  import enrollees from '../../components/data-tables/enrollees.vue'
  export default {

        data: ()=>({
            search: ''
        }),
    
    	created(){
           
        this.changePage()
        this.$store.dispatch('page', 1);
    	},
    	computed: {
    		authUser(){
    			return this.$store.getters.authUser
    		}
    	},
      components: {
        enrollees
      },
      methods: {
        changePage(){
          let data = this
          this.$http.get(base_api + '/shs?page=' + this.page + '&token=' + window.localStorage.getItem('tokenKey')
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
          this.$http.post(base_api + '/shs/search?token=' + window.localStorage.getItem('tokenKey'),{
              search: val
          })
            .then(function(res){
              data.$store.dispatch('enrollees', res.data.enrollees)
            })
            .catch()
        }
      }
  }
</script>