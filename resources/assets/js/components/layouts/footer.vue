<template>
  <v-footer height="auto" class="green darken-4">
    <v-layout row wrap justify-center>
      <v-btn
        v-for="link in links"
        :key="link.id"
        color="white"
        flat
        :to="link.to"
      >
        {{ link.text }}
      </v-btn>
      <v-flex xs12 py-3 text-xs-center white--text>
        &copy;2018 — <strong>IIT</strong>
      </v-flex>
    </v-layout>
  </v-footer>
</template>
<script>
  export default {
    data: () => ({
      links: [{ id: 1, text: 'Home', to: '/home'}, { id: 2, text: 'School', to: '/school'}, { id: 3, text:'Students', to: '/students'}, { id: 4,  text: 'Deped', to: 'deped'}, { id: 5, text: 'TESDA', to: '/tesda'}, { id: 6, text: 'Industry Partner', to: '/industry-partner'}, { id: 7, text: 'Admission', to: '/admission'}, { id: 8, text: 'Contact Us', to: '/contact-us'}]
    })
  }
</script>