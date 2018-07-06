<template>
   <v-flex>
      <v-dialog
        ref="dialog"
        persistent
        v-model="modal"
        lazy
        full-width
        width="290px"
        :return-value.sync="editTrainingPayment.created_at"
      >
        <v-text-field
          slot="activator"
          label="Payment Date"
          v-model="editTrainingPayment.created_at"
          readonly
        ></v-text-field>
        <v-date-picker v-model="editTrainingPayment.created_at" scrollable>
          <v-spacer></v-spacer>
          <v-btn flat color="primary" @click="modal = false">Cancel</v-btn>
          <v-btn flat color="primary" @click="$refs.dialog.save(editTrainingPayment.created_at)">OK</v-btn>
        </v-date-picker>
      </v-dialog>
    </v-flex>
</template>

<script>
  export default {
    data: () => ({
      date: null,
      modal: false,
    }),
    computed: {
      editTrainingPayment: {
        get(){
          return this.$store.getters.editTrainingPayment
        },
        set(val){
           
        }
      }
    },
    watch: {
      'editTrainingPayment.created_at': function(val){
        this.$store.dispatch('editTrainingPaymentField', {
          'created_at': val
        })
      }
    }
  }
</script>