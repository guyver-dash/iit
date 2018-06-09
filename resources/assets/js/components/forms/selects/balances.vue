<template>
      <v-flex xl12 lg12 md12 sm12 xs12>
        <v-select
          :items="balances"
          v-model="balance_ids"
          label="As Payment for"
          chips
          item-text="name"
          item-value="id"
          required
          :rules="[v => !!v || 'As Payment for is required']"
        ></v-select>
      </v-flex>
</template>
<script>
  export default {
    data: ()=>({
      balance_ids:[]
    }),
    computed: {
      balances: {
        get(){
          return this.$store.getters.balances
        }
        
      },

    },
    watch: {
      balance_ids(val){
         this.$store.dispatch('balance_ids', val)
      }
    }
  }
</script>