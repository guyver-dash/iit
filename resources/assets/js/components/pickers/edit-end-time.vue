<template>
    <v-flex xl6>
      <v-dialog
        ref="dialog"
        persistent
        v-model="modal2"
        lazy
        full-width
        width="290px"
        :return-value.sync="confirmedEnrolled.end_time"
      >
        <v-text-field
          slot="activator"
          :label="'Start time'"
          v-model="confirmedEnrolled.end_time"
          prepend-icon="access_time"
          readonly
        ></v-text-field>
        <v-time-picker v-model="confirmedEnrolled.end_time" actions>
          <v-spacer></v-spacer>
          <v-btn flat color="primary" @click="modal2 = false">Cancel</v-btn>
          <v-btn flat color="primary" @click="$refs.dialog.save(confirmedEnrolled.end_time)">OK</v-btn>
        </v-time-picker>
      </v-dialog>
    </v-flex>
</template>
<script>
  export default {
    data () {
      return {
        menu2: false,
        modal2: false
      }
    },
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
      'confirmedEnrolled.end_time': function (val){
          this.$store.dispatch('confirmedEnrolledField',{
          'field' : 'end_time',
           'value': val
          })
      }
    }
  }
</script>