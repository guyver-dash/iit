<template>
  <v-layout row justify-center>
    <v-dialog v-model="dialogAdmission" fullscreen hide-overlay transition="dialog-bottom-transition">
      <v-card>
        <v-toolbar dark color="green darken-3">
          <v-btn icon @click.native="closeDialog" dark>
            <v-icon>close</v-icon>
          </v-btn>
          <v-toolbar-title>Application for Admission</v-toolbar-title>
          <v-spacer></v-spacer>
          <v-toolbar-items>
            <v-btn dark flat @click.native="submitForm">Submit</v-btn>
          </v-toolbar-items>
        </v-toolbar>
         <v-layout>
          <v-flex xs12 >
            <v-card flat>
              <v-card-title primary-title>
                <div>
                  <h3 class="headline mb-0">INSTRUCTIONS:</h3>
                  <div class="ml-5">
                    <ol>
                      <li>Student-Applicant accomplishes this Application Form properly.</li>
                      <li>Fill-up information. Leave the field blank (if not applicable).</li>
                      <li>Submit all the requirements as needed.</li>
                    </ol>
                  </div>
                </div>
              </v-card-title>
            </v-card>
          </v-flex>
        </v-layout>
        <v-divider></v-divider>
        <v-list three-line subheader>
          <v-subheader>Enrollment Details</v-subheader>
          <enroll ref="enroll"></enroll>
        </v-list>
      </v-card>
    </v-dialog>
  </v-layout>
</template>
<script>
  import enroll from '../forms/enrollment/enroll.vue'
  export default {
    data () {
      return {
        notifications: false,
        sound: true,
        widgets: false
      }
    },
    components: {
      enroll
    },
    computed: {

        dialogAdmission(){

            return this.$store.getters.dialogAdmission
        }
    },
    methods: {

      closeDialog(){
        this.$store.dispatch('dialogAdmission', false)
      },
      submitForm(){
        this.$refs.enroll.submit()
      }
    }

  }
</script>