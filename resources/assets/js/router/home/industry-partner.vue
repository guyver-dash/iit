<template>
	<v-container fluid fill-height>
    
      <v-layout row wrap>
        <v-flex xl12 lg12 md12 sm12 xs12>

          <h3 class="headline">About the Industry Partner</h3>
          <p>IIT is affiliated with various companies that will assist aspiring graduates experience the following learning activities:

          </p>
       </v-flex>
       <v-flex xl5 lg5 md5 sm5 xs5 class="pa-2">

          <ul>
            <li>Career panel/mock interview</li>
            <li>Job shadow</li>
            <li>Mentoring</li>
            <li>Internship</li>
            <li>Apprenticeship</li>
            <li>Work experience</li>
          </ul>
       </v-flex>
       <v-flex xl6 lg6 md6 sm6 xs6 class="pa-2">

          <ul>
            <li>Clinical experience</li>
            <li>Worksite visitatio</li>
            <li>Business - teachers event</li>
            <li>community service</li>
            <li>Informational interview</li>
            <li>Career Fair</li>
          </ul>
       </v-flex>
       
       <v-flex xl12 lg12 md12 sm12 xs12>
          <industry-partner></industry-partner>
       </v-flex>
    </v-layout>
  </v-container>
</template>
<script>
  import industryPartner from '../../components/cards/industry-partner.vue'
  export default {
    data () {
      return {
        industry1: window.base + 'images/industry-partner/thinking_tools_1.jpg',
        title1: 'Thinking Tools, Inc.',
        industry2: window.base + 'images/industry-partner/careerfirst_1.jpg',
        title2: 'Career First Institute',
      }
    },
    components: {
      industryPartner
    }
  }
</script>

