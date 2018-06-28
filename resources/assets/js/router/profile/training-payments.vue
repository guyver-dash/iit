<template>
	<v-container class="ma-2 pa-0" fluid>
    <v-layout class="ma-0 pa-0 mt-2">
      <v-flex xl3 lg3 md3 sm3 xs3>
         <v-btn color="primary" dark @click="newPayment()">New Training Payment</v-btn>
      </v-flex>
      <v-flex xl12 lg12 md12 sm12 xs12>
        <h1 class="pa-2">Training Payments</h1>
      </v-flex>
    </v-layout>
    </v-container>
</template>
<script type="text/javascript">
  import _ from 'lodash'
  export default {
        data: ()=>({
            search: '',
        }),
        created(){
          this.trainingPayments()
        },
        methods: {
          trainingPayments(){
            this.$http.get(window.base_api + '/training-payments?token=' + localStorage.getItem('tokenKey'))
                    .then(function(res){
                        
                    })
          }
        }
  }
</script>

