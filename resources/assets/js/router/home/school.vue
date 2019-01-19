<template>
	<v-container fluid fill-height>
    
      <v-layout row wrap>
        <v-flex xl12 lg12 md12 sm12 xs12>

          <h3 class="headline">About the School</h3>
          <p class="subheading">IIT is a private technical-vocational institution accredited by the <strong> Technical Education Skills Development Authority (TESDA) </strong> and the <strong>Department of Education (DepEd) </strong> offering skills training in computer (handware and software), business office/clerical support and senior high school.
        </p>
        <p class="subheading">
          We train students the non-traditional way with the use of community classrooms, industry partners, on-the-job training and many more. <br />Among the requirements for graduation are mock interviews and career panels. <br />Needless to say, all students go through rigorous training in the preparation of <strong>portfolio and letters of introduction/application.</strong>  <br /> We are proud to say that not so many graduates have these opportunities before graduation.
        </p>

        <p class="subheading">
          It is our hope that you will send your youth to IIT to learn and be trained to be responsible professionals and constituents.

          <br />We are proud to be the skills academy.<strong> “Your new career starts here!”</strong>
        </p>
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

