<template>
      <v-flex xl12 lg12 md12 sm12 xs12>
        <v-select
          :items="enrollees"
          v-model="enrollee"
          label="Search Student"
          chips
          item-text="name"
          item-value="id"
          autocomplete
          :search-input.sync="searchInput"
        ></v-select>
      </v-flex>
</template>
<script>
import _ from 'lodash'
  export default {
    data: ()=>({
      searchInput: '',
      enrollee: ''
    }),
    computed: {
      enrollees: {
        get(){
          return this.$store.getters.enrollees
        }
        
      }
    },
    watch: {
      enrollees(val){
         this.$store.dispatch('enrollees', val)
      },
      searchInput: _.debounce(function(){
        let data = this
        if (this.searchInput != null) {
          console.log(this.searchInput)
          this.$http.get( base_api + '/balance-enrollee-search?string=' + this.searchInput + '&token=' + localStorage.getItem('tokenKey'))
          .then(function(res){
            data.$store.dispatch('enrollees', res.data.enrollees)
          })
        }
        
      }, 500)
      ,
      enrollee(val){
        this.$store.dispatch('confirmEnrolledId', val)
      }
    }
  }
</script>