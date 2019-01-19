<template>
	<v-container fluid fill-height>
    
      <v-layout row wrap>
        <v-flex xl12 lg12 md12 sm12 xs12>

          <h3 class="headline">About the Students</h3>
          <p class="subheading">IIT students generally take interests in <strong>Information Technology (IT) </strong>.  Our students belong to the underprivileged to middle class segment of society.  Approximately 50% are working in full time and/or part time jobs.</p>
          <p class="subheading">We cultivate in our students the values of <strong>INNOVATIVENESS, INTEGRITY & TEAMWORK.</strong></p>

          <p>We at IIT understand the importance of creating a culture of innovation in classrooms thus, we don’t just prepare our senior high school students to be “college ready.” <br /> They, together with post-secondary students are given a grounding on creativity, inventiveness to be “innovation ready.”  <br />Our instruction is geared toward producing graduates who <strong>think critically and creatively, communicate effectively and collaborate.</strong> <br /> Students are required to work cooperatively with classmates, with each other towards a shared purpose.</p>
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

