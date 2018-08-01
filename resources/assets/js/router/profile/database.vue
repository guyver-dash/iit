<template>
    <v-container class="ma-2 pa-0" fluid>
    <v-layout class="ma-0 pa-0">
      <v-flex xl12 lg12 md12 sm12 xs12>
         <h1 class="pa-2">List of Enrollees</h1>
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
  export default {

    methods: {
      generateExcel(){
        window.open(window.base_api + '/database/export');
      }
    }
  }
</script>
