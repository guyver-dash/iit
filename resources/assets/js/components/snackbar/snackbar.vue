<template>
  <v-card>
    <v-snackbar
      :timeout="6000"
      :color="color"
      v-model="snackbar"
    >
      {{ text }}
      <v-btn dark flat @click.native="snackbar = false">Close</v-btn>
    </v-snackbar>
  </v-card>
</template>
<script>
  export default {
    props: ['text', 'color'],
    data () {
      return {
        mode: '',
        timeout: 6000,
      }
    },
    computed: {
       snackbar: {
          get(){
            return this.$store.getters.snackbar
          },
          set(){

          }
       }
    }
  }
</script>