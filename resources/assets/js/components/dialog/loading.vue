<template>
  <div class="text-xs-center">
    <v-dialog
      v-model="loader"
      hide-overlay
      persistent
      width="300"
    >
      <v-card
        color="purple darken-2"
        dark
      >
        <v-card-text>
          Loading...
          <v-progress-linear
            indeterminate
            color="white"
            class="mb-0"
          ></v-progress-linear>
        </v-card-text>
      </v-card>
    </v-dialog>
  </div>
</template>
<script>
  export default {
    data () {
      return {
        dialog: false
      }
    },
        computed: {
          loader: {
            get(){
              return this.$store.getters.loader
            },
            set(val){
              this.$store.dispatch('loader', val)
            }
            
          }
        },
    watch: {
      dialog (val) {
        if (!val) return

        setTimeout(() => (this.$store.dispatch('loader', val)), 4000)
      }
    }
  }
</script>