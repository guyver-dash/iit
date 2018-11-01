<template>
	<v-container class="ma-2 pa-0" fluid>
    <v-layout class="ma-0 pa-0">
      <v-flex xs2>
         <h1 class="pa-2">Payments</h1>
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
        <payments ref="newPayment" v-bind:confirmid="this.$route.params.id"></payments>
      </v-flex>
    </v-layout>
    </v-container>
</template>

<script>
  import payments from '../../components/data-tables/payments.vue'

  import semestersSY from '../../mixins/semestersSY.js'

  import semesterSelect from '../../components/select/semester'
  import schoolYears from '../../components/select/schoolYears'
  import _ from 'lodash'
  export default {
      mixins: [semestersSY],
        data: ()=>({
            search: '',
        }),
    	components: {
            payments, semesterSelect, schoolYears
    	},
    	created(){
            
            if (Number.isInteger(this.$route.params.id)) {
                this.confirmEnrolled()
            }
             
      
    	},
    	computed: {
    		authUser(){
    			return this.$store.getters.authUser
    		},
        selectedSemester(){
          return this.$store.getters.selectedSemester
        },
        selectedSchoolYear(){
          return this.$store.getters.selectedSchoolYear
        }
    	},
        methods: {
            confirmEnrolled(){
                var data = this
                this.$http.get(window.base_api + '/confirm-enrolled/' + this.$route.params.id + '?token=' + localStorage.getItem('tokenKey'))
                    .then(function(res){
                        data.$store.dispatch('confirmEnrolledPayment', res.data.enrollee)
                    })
            },
            newSearch: _.debounce(function(){
                let data = this
                this.$refs.newPayment.page = 1
                this.$http.post(base_api + '/payments/search?token=' + localStorage.getItem('tokenKey'),{
                  search: this.search,
                  semesterId: this.selectedSemester,
                  schoolYearId: this.selectedSchoolYear
                }).then(function(res){
                    data.$store.dispatch('payments', res.data.payments);
                })

            }, 500)
        },
        watch: {

          search(val){
            this.newSearch()
          },
          selectedSemester(){
            this.newSearch()
          },
          selectedSchoolYear(){
            this.newSearch()
          }
        }
  }
</script>
