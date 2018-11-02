<template>
      <v-flex xl12 lg12 md12 sm12 xs12>
        <v-autocomplete
          :items="enrollees"
          v-model="enrollee"
          label="Search Student"
          chips
          item-text="name"
          item-value="id"
          clearable
          :search-input.sync="searchInput"
        >

        </v-autocomplete>
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
        
      },
      selectedSemester(){
        return this.$store.getters.selectedSemester
      },
      selectedSchoolYear(){
        return this.$store.getters.selectedSchoolYear
      }
    },
    methods: {
      searchEnrollee: _.debounce(function(){
        let data = this
        if (this.searchInput != null) {
          console.log(this.searchInput)
          this.$http.get( base_api + '/balance-enrollee-search?string=' + this.searchInput + '&semesterId='+ this.selectedSemester+'&schoolYearId='+ this.selectedSchoolYear +'&token=' + localStorage.getItem('tokenKey'))
          .then(function(res){
            data.$store.dispatch('enrollees', res.data.enrollees)
          })
        }
        
      }, 500)
    },
    watch: {
      enrollees(val){
         this.$store.dispatch('enrollees', val)
      },
      searchInput(){
        this.searchEnrollee()
      },
      enrollee(val){
        this.$store.dispatch('confirmEnrolledId', val)
      },
      selectedSemester(){
        this.searchEnrollee()
      },
      selectedSchoolYear(){
        this.searchEnrollee()
      }
    }
  }
</script>