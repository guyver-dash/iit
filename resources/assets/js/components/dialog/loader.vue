<template>
  <v-layout row justify-center>
    <v-dialog v-model="loader" persistent content content-class="centered-dialog">
      <v-container fill-height>
        <v-layout column justify-center align-center>
          <v-progress-circular indeterminate :size="70" :width="7" :color="progressColor"></v-progress-circular>
          <h1 v-if="loaderMessage != null">{{loaderMessage}}</h1>
        </v-layout>
      </v-container>
    </v-dialog>
  </v-layout>
</template>

<script>
    export default {
        name: "Loading",
        data: function () {
            return {}
        },
        props: {
            progressColor: {type: String, default: 'purple'},
        },
        computed: {
          loader: {
            get(){
              return this.$store.getters.loader
            },
            set(){
              
            }
            
          },
          loaderMessage(){
            return this.$store.getters.loaderMessage
          }
        }
    }
</script>

<style>
  .dialog.centered-dialog {
    background: #282c2dad;
    box-shadow: none;
    border-radius: 6px;
    width: auto;
    color: whitesmoke;
  }
</style>