<template>
  <v-card>
    <v-snackbar
      :timeout="0"
      :color="color"
      v-model="registrationCompleted"
    >
      {{ text }}
      <v-btn dark flat @click.native="snackbarClose">Close</v-btn>
    </v-snackbar>
  </v-card>
</template>
<script>
  export default {
    props: ['text', 'color'],
    data () {
      return {
        mode: '',
      }
    },
    computed: {
       registrationCompleted: {
          get(){
            return this.$store.getters.registrationCompleted
          },
          set(){

          }
       }
    },
    methods: {
      snackbarClose(){
        this.$store.dispatch('registrationCompleted', false);
        this.$store.dispatch('dialogAdmission', false)
      }
    }
  }
</script>