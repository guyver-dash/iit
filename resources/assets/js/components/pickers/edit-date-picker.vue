<template>
	 <v-flex>
      <v-dialog
        ref="dialog"
        persistent
        v-model="modal"
        lazy
        full-width
        width="290px"
        :return-value.sync="birthday"
      >
        <v-text-field
          slot="activator"
          label="Birthday"
          v-model="birthday"
          prepend-icon="event"
          readonly
        ></v-text-field>
        <v-date-picker v-model="birthday" scrollable>
          <v-spacer></v-spacer>
          <v-btn flat color="primary" @click="modal = false">Cancel</v-btn>
          <v-btn flat color="primary" @click="$refs.dialog.save(birthday)">OK</v-btn>
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
      birthday: {
        get(){
          return this.$store.getters.confirmedEnrolled.enrollee.birthday
        },
        set(val){
           this.$store.dispatch('confirmedEnrolledEnrollee', {
              'field': 'birthday',
              'value': val
           })
        }
      }
    }
  }
</script>