<template>
	<v-container class="ma-2 pa-0" fluid>
    <v-layout class="ma-0 pa-0">
      <v-flex xs2>
         <h1 class="pa-2">Enrollees</h1>
      </v-flex>
      <v-flex xs4>
         <v-text-field
          v-model="search"
          append-icon="search"
          label="Search"
          single-line
          hide-details
        ></v-text-field>
      </v-flex>
      <v-flex xs2>
        <semester-select></semester-select>
      </v-flex>
      <v-flex xs2>
         <school-years></school-years>
      </v-flex>
    </v-layout>
    <v-layout class="ma-0 pa-0">
      <v-flex xl12 lg12 md12 sm12 xs12>
        <enrollees v-bind:printUrl="'/api/confirm-enrolled/print/'"></enrollees>
      </v-flex>
    </v-layout>
	</v-container>
</template>

<script>
import startUp from '../mixins/start-up.js'
import semestersSY from '../mixins/semestersSY.js'
import enrollees from '../components/data-tables/enrollees.vue'

import semesterSelect from '../components/select/semester'
import schoolYears from '../components/select/schoolYears'
  export default {

      data: ()=>({
        search: ''
      }),
      mixins: [startUp, semestersSY],
      components:{
        enrollees,
        semesterSelect,
        schoolYears
      },
    	computed: {
    		authUser(){
    			return this.$store.getters.authUser
    		},
        page(){
          return this.$store.getters.page
        },
        semesters(){
          return this.$store.getters.semesters
        },
        schoolYears(){
          return this.$store.getters.schoolYears
        },
        selectedSemester(){
          return this.$store.getters.selectedSemester
        },
        selectedSchoolYear(){
          return this.$store.getters.selectedSchoolYear
        }
    	},
      created() {
        this.$store.dispatch('page', 1)
        this.changePage();
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
        searchString(){
          var data = this
          this.$http.post(base_api + '/confirm-enrolled/search?token=' + window.localStorage.getItem('tokenKey'),{
              search: this.search,
              semesterId: this.selectedSemester,
              schoolYearId: this.selectedSchoolYear
          })
            .then(function(res){
              data.$store.dispatch('enrollees', res.data.enrollees)
            })
            .catch()
        }
      },
      watch: {
        search: function(val){
          this.searchString()
        },
        page(){
          this.changePage()
        },
        selectedSemester(){
          this.searchString()
        },
        selectedSchoolYear(){
          this.searchString()
        }
      }
  }
</script>
