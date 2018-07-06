<template>
    <v-container class="ma-2 pa-0" fluid>
    <v-layout class="ma-0 pa-0">
      <v-flex xl12 lg12 md12 sm12 xs12>
         <h1 class="pa-2">Collection Reports</h1>
      </v-flex>
      
    </v-layout>
    <v-layout class="ma-0 pa-0">
      <v-flex xl12 lg12 md12 sm12 xs12>
         <collection-reports></collection-reports>
      </v-flex>
      
    </v-layout>
    <v-layout class="ma-0 pa-0">
    <v-flex xl6 lg6 md6 sm6 xs12 class="ml-3">
         <start-collection-date></start-collection-date>
      </v-flex>
    </v-layout>
    <v-layout class="ma-0 pa-0">
    <v-flex xl6 lg6 md6 sm6 xs12 class="ml-3">
         <end-collection-date></end-collection-date>
      </v-flex>
    </v-layout>
    <v-layout class="ma-0 pa-0">
    <v-flex xl6 lg6 md6 sm6 xs12 class="ml-3">
         <v-btn color="primary" @click="generateExcel()">Generate Excel</v-btn>
      </v-flex>
    </v-layout>
    </v-container>
</template>
<script type="text/javascript">
  import collectionReports from '../../components/forms/checkbox/collection-reports'
  import startCollectionDate from '../../components/pickers/start-collection-date'
  import endCollectionDate from '../../components/pickers/end-collection-date'
  export default {

    components: {
      collectionReports, startCollectionDate, endCollectionDate
    },
    computed: {
      startCollectionDate(){
        return this.$store.getters.startCollectionDate
      },
      endCollectionDate(){
        return this.$store.getters.endCollectionDate
      },
      checkCollectionPayment: {
        get(){
          return this.$store.getters.checkCollectionPayment
        }
        
      },
      checkCollectionTrainingPayment: {
        get(){
          return this.$store.getters.checkCollectionTrainingPayment
        }
        
      }
    },
    methods: {
      generateExcel(){
        window.open(window.base_api + '/collections/export?startDate=' + this.startCollectionDate + '&endDate=' + this.endCollectionDate + '&payment=' + this.checkCollectionPayment + '&trainingPayment='+ this.checkCollectionTrainingPayment + '&token='+ localStorage.getItem('tokenKey'));
      }
    }
  }
</script>
