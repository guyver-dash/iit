<template>
	<v-container fluid fill-height>
    
      <v-layout row wrap>
        <v-flex xl12 lg12 md12 sm12 xs12>

          <h3 class="headline">About the Students</h3>
          <p>Student responsibility occurs when students take an active role in their learning by recognizing they are accountable for their academic success. Student responsibility is demonstrated when students make choices and take actions which lead them toward their educational goals.</p>
       </v-flex>
       <v-flex xl12 lg12 md12 sm12 xs12>
          <students-img></students-img>
       </v-flex>
    </v-layout>
  </v-container>
</template>
<script>
  import studentsImg from '../../components/cards/students-img.vue'
  export default {
    components: {
      studentsImg
    }
  }
</script>

