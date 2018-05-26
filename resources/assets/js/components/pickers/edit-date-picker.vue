<template>
	 <v-flex>
      <v-dialog
        ref="dialog"
        persistent
        v-model="modal"
        lazy
        full-width
        width="290px"
        :return-value.sync="confirmedEnrolled.enrollee.birthday"
      >
        <v-text-field
          slot="activator"
          label="Birthday"
          v-model="confirmedEnrolled.enrollee.birthday"
          prepend-icon="event"
          readonly
        ></v-text-field>
        <v-date-picker v-model="confirmedEnrolled.enrollee.birthday" scrollable>
          <v-spacer></v-spacer>
          <v-btn flat color="primary" @click="modal = false">Cancel</v-btn>
          <v-btn flat color="primary" @click="$refs.dialog.save(confirmedEnrolled.enrollee.birthday)">OK</v-btn>
        </v-date-picker>
      </v-dialog>
    </v-flex>
</template>

<script>
  export default {
    data: () => ({
      modal: false,
    }),
    computed: {
      confirmedEnrolled: {
        get(){
          return this.$store.getters.confirmedEnrolled
        },
        set(val){
           
        }
      }
    },
    watch: {
      'confirmedEnrolled.enrollee.birthday': function(val){
        this.$store.dispatch('confirmedEnrolledEnrollee', {
              'field': 'birthday',
              'value': val
           })
      }
    }
  }
</script>