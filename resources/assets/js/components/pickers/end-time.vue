<template>
    <v-flex xl6>
      <v-dialog
        ref="dialog"
        persistent
        v-model="modal2"
        lazy
        full-width
        width="290px"
        :return-value.sync="time"
      >
        <v-text-field
          slot="activator"
          :label="'End time'"
          v-model="time"
          prepend-icon="access_time"
          readonly
        ></v-text-field>
        <v-time-picker v-model="time" actions>
          <v-spacer></v-spacer>
          <v-btn flat color="primary" @click="modal2 = false">Cancel</v-btn>
          <v-btn flat color="primary" @click="$refs.dialog.save(time)">OK</v-btn>
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
      time(){
        return this.$store.getters.confirmedEnrolled.end_time
      }
    },
    watch: {
      time(val){
        
        console.log(val)
      }
    }
  }
</script>