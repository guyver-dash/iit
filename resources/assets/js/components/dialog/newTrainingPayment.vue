<template>
	<v-dialog v-model="newTrainingDialog" max-width="500px">
      <v-card>
        <v-card-title>
          <span class="headline">
            New Training Payment
          </span>
        </v-card-title>
        <v-card-text>
          <v-container grid-list-md>
            <v-layout wrap>
              <v-flex xs12 sm12 md12 lg12 xl12>
                <v-text-field type="text" 
                  label="Firstname" 
                  />
                  </v-text-field>
              </v-flex>
              <v-flex xs12 sm12 md12 lg12 xl12>
                <v-text-field type="text" 
                  label="Lastname" 
                  />
                  </v-text-field>
              </v-flex>
              <v-flex xs12 sm12 md12 lg12 xl12>
                <my-currency-input v-model="trainingPaymentAmt" v-bind:label="'Amount'"></my-currency-input>
              </v-flex>
            </v-layout>
          </v-container>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue darken-1" flat @click.native="close">Cancel</v-btn>
          <v-btn color="blue darken-1" flat @click.native="save()">Save</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
</template>

<script type="text/javascript">
	export default {
    
    data: () => ({
    	trainingPaymentAmt: 0
    })
  }
</script>