<template>
	<v-container fluid fill-height>
    
      <v-layout row wrap>
        <v-flex xl12 lg12 md12 sm12 xs12>

          <h3 class="headline">About the School</h3>
          <p>We are a private Technical-Vocational Education and Training Center located at the A &amp; J Building, A.C. Cortes Avenue, Mandaue City, Cebu, Philippines. We offer 2-year Associate courses and short-term programs.

        We are registered under the Securities &amp; Exchange Commission (SEC) under registration No.CS201533190. </p>
       </v-flex>
       <v-flex xl12 lg12 md12 sm12 xs12>
          <school-img></school-img>
       </v-flex>
    </v-layout>
  </v-container>
</template>
<script>
  import schoolImg from '../../components/cards/school-img.vue'
  export default {
    components: {
      schoolImg
    }
  }
</script>

