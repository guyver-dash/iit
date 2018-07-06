<template>
  <v-container fluid class="mb-0 pb-0">
    <v-checkbox :label="`Payments`" v-model="checkCollectionPayment"></v-checkbox>
    <v-checkbox :label="`Training Payments`" v-model="checkCollectionTrainingPayment"></v-checkbox>
  </v-container>
</template>
<script>
  export default {
    
    computed: {
    	checkCollectionPayment: {
    		get(){
    			return this.$store.getters.checkCollectionPayment
    		},
    		set(val){
    			this.$store.dispatch('checkCollectionPayment', val)
    		}
    		
    	},
    	checkCollectionTrainingPayment: {
    		get(){
    			return this.$store.getters.checkCollectionTrainingPayment
    		},
    		set(val){
    			this.$store.dispatch('checkCollectionTrainingPayment', val)
    		}
    		
    	}
    }
  }
</script>