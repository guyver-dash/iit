<template>
	<v-container class="ma-2 pa-0" fluid>
    <v-layout class="ma-0 pa-0 mt-2">
      <v-flex xl3 lg3 md3 sm3 xs3>
       <v-btn color="primary" dark @click="newPayment()">New Training Payment</v-btn>
     </v-flex>
     <v-flex xl7 lg7 md7 sm7 xs7>
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
      <new-training-payments ref="getReceipt"> </new-training-payments>
    </v-flex>
  </v-layout>
</v-container>
</template>
<script type="text/javascript">
 

  import newTrainingPayments from '../../components/data-tables/new-training-payments'
  import _ from 'lodash'
  export default {
    data: ()=>({
      search: '',
    }),
    components: {
      newTrainingPayments
    },
    
    methods: {
      newPayment(){
        this.$store.dispatch('newTrainingDialog', true);
        this.$refs.getReceipt.getReceipt();
       
      },
      searchNewTrainingPayments(){
        let data = this
        this.$http.get(window.base_api + '/training-payments-search?string=' + this.search +'&token=' + localStorage.getItem('tokenKey'))
        .then(function(res){
          data.$store.dispatch('trainingPayments', res.data.trainingPayments);
        })
      }
    },
    watch: {
      search: _.debounce(function(){
        this.searchNewTrainingPayments()
      }, 500)
    }
  }
</script>

