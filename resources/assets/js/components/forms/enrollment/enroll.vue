<template>
  <v-container fluid>
    <v-form v-model="valid" ref="form" lazy-validation>
    <div>
                  <h3 class="headline mb-0">INSTRUCTIONS:</h3>
                    <ol>
                      <li>Student-Applicant accomplishes this Application Form properly.</li>
                      <li>Fill-up information. Leave the field blank (if not applicable).</li>
                      <li>Submit all the requirements as needed.</li>
                    </ol>
                </div>
    <v-layout row wrap>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
        <v-text-field
                label="Date"
                v-model="dateNow"
                disabled
              ></v-text-field>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
        <v-text-field
                label="Admission No:"
                v-model="admissionNo"
               
                disabled
              ></v-text-field>
      </v-flex>

      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
        <v-autocomplete
                label="Select Course"
                :items="courses"
                v-model="course"
                item-text="name"
                item-value="id"
                :rules="[v => !!v || 'Please select course.']"
                required
              ></v-autocomplete>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
        <v-autocomplete
                label="School Year"
                :items="schoolYears"
                v-model="schoolYear"
                item-value="id"
                item-text="sy"
                :rules="[v => !!v || 'Please select school year.']"
                @change="schoolYearChange"
                required
              ></v-autocomplete>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
        <v-autocomplete
                label="Year level"
                :items="yearLevels"
                v-model="yearLevel"
                item-value="id"
                item-text="name"
                :rules="[v => !!v || 'Please select year level.']"
                required
              ></v-autocomplete>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
        <v-autocomplete
                label="Semester"
                :items="semesters"
                v-model="semester"
                item-value="id"
                item-text="name"
                :rules="[v => !!v || 'Please select semester.']"
                required
              ></v-autocomplete>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
        <v-autocomplete
                label="Schedule"
                :items="schedules"
                v-model="schedule"
                item-value="id"
                item-text="name"
                :rules="[v => !!v || 'Please select schedule.']"
                required
              ></v-autocomplete>
      </v-flex>

      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
        <v-card  class="elevation-0">
            <v-card-text>
              
              <v-layout row wrap>
              <span class="subheading">Modular (Specify your 4 hours time range:)</span>
              <time-picker v-bind:label="'Start time'"></time-picker>
              <time-picker v-bind:label="'End time'"></time-picker>
              </v-layout>
          </v-card-text>
         </v-card>
      </v-flex>
      
    </v-layout>
    <v-divider></v-divider>
    <v-flex xl12>
        <br />
         <span class="subheading">Personal informations:</span>
    </v-flex>
    <v-layout row wrap>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
       
              <v-text-field
                label="Lastname"
                v-model="lastname"
                 :rules="[v => !!v || 'This field is required.']"
                required
              ></v-text-field>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
            <v-text-field
                label="Firstname"
                v-model="firstname"
                :rules="[v => !!v || 'This field is required.']"
                required
              ></v-text-field>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
            <v-text-field
                label="Middlename"
                :rules="[v => !!v || 'This field is required.']"
                v-model="middlename"
                required
              ></v-text-field>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
            <v-text-field
                label="Suffix"
                v-model="suffix"

              ></v-text-field>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
            <v-text-field
                label="Nick name"
                v-model="nickName"
              ></v-text-field>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
            <v-text-field
                label="Age"
                v-model="age"
                :type="'number'"
                :rules="[v => !!v || 'This field is required.']"
                required
              ></v-text-field>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
            <date-picker>
              
            </date-picker>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
            <v-text-field
                label="Birth Place"
                v-model="birthplace"
                required
                :rules="[v => !!v || 'This field is required.']"
              ></v-text-field>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
           <v-autocomplete
                label="Educational Attainment"
                :items="educAtt"
                v-model="selectedEducAtt"
                item-value="id"
                item-text="name"
                :rules="[v => !!v || 'This field is required.']"
                required
              ></v-autocomplete>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
           <v-autocomplete
                label="Sex"
                :items="sexs"
                v-model="sex"
                item-value="text"
                required
                :rules="[v => !!v || 'This field is required.']"
              ></v-autocomplete>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
           <v-autocomplete
                label="Civil Status"
                :items="civilStatus"
                v-model="selectedCivil"
                item-value="id"
                item-text="name"
                :rules="[v => !!v || 'This field is required.']"
                required
              ></v-autocomplete>
      </v-flex>
     

       <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2"  v-if="selectedCivil == 1">
             <v-text-field
                label="Spouse lastname"
                v-model="spouseLastname"
              ></v-text-field>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2" v-if="selectedCivil == 1">
            <v-text-field
                label="Spouse firstname"
                v-model="spouseFirstname"
              ></v-text-field>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2" v-if="selectedCivil == 1">
           <v-text-field
                label="Spouse middlename"
                v-model="spouseMiddlename"
              ></v-text-field>
      </v-flex>
      
       <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
           <v-text-field
                label="Landline"
                v-model="landline"
                :type="'number'"
                prepend-icon="phone"
              ></v-text-field>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
           <v-text-field
                label="Phone Number"
                v-model="mobile"
                :type="'number'"
                :rules="[v => !!v || 'This field is required.']"
                required
                prepend-icon="phone_android"
              ></v-text-field>
      </v-flex>
      
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
           <v-text-field
                label="Email"
                v-model="email"
                :type="'email'"
                :rules="[v => !!v || 'This field is required.']"
                required
                prepend-icon="email"
              ></v-text-field>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
           <v-text-field
                label="Religion"
                v-model="religion"
                prepend-icon="pages"
                required
                :rules="[v => !!v || 'This field is required.']"
              ></v-text-field>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
           <v-text-field
                label="Citizenship"
                v-model="citizenship"
                prepend-icon="public"
                required
                :rules="[v => !!v || 'This field is required.']"
              ></v-text-field>
      </v-flex>
</v-layout>

    <v-flex xl12>
        <br />
         <span class="subheading">Present address</span>
    </v-flex>
    <v-layout row wrap>
       <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
             <v-autocomplete
                autocomplete
                label="Present Province"
                :items="provinces"
                v-model="presentProvinceId"
                item-text="name"
                item-value="id"
                required
                :rules="[v => !!v || 'This field is required.']"
              ></v-autocomplete>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
            <v-autocomplete
                autocomplete
                label="Present City"
                :items="presentCities"
                v-model="presentCityId"
                item-text="name"
                item-value="id"
                required
                :rules="[v => !!v || 'This field is required.']"
              ></v-autocomplete>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
           <v-text-field
                label="Present Zipcode"
                v-model="presentZipCode"
                :type="'number'"
                :rules="[v => !!v || 'This field is required.']"
                required
              ></v-text-field>
      </v-flex>
      
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
            <v-textarea
                label="Present Address(House No:, street)"
                v-model="presentAddress"
                color="grey"
                :rules="[v => !!v || 'This field is required.']"
                required
              ></v-textarea>
      </v-flex>
    </v-layout>

    <v-flex xl12>
        <br />
         <span class="subheading">Permanent address</span>
    </v-flex>
    <v-layout row wrap>
       <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
             <v-autocomplete
                label="Permanent Province"
                :items="provinces"
                v-model="permanentProvinceId"
                item-value="id"
                item-text="name"
                :rules="[v => !!v || 'This field is required.']"
                required
              ></v-autocomplete>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
            <v-autocomplete
                label="Permanent City"
                :items="permanentCities"
                v-model="permanentCityId"
                item-value="id"
                item-text="name"
                :rules="[v => !!v || 'This field is required.']"
                required
              ></v-autocomplete>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
           <v-text-field
                label="Permanent Zipcode"
                v-model="permanentZipCode"
                :type="'number'"
                :rules="[v => !!v || 'This field is required.']"
                required
              ></v-text-field>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
            <v-textarea
                label="Permanent Address(House No:, street)"
                v-model="permanentAddress"
                color="grey"
                :rules="[v => !!v || 'This field is required.']"
                required
              ></v-textarea>
      </v-flex>
    </v-layout>




    <v-divider></v-divider>
    <v-flex xl12>
        <br />
         <span class="subheading">Family informations:</span>
    </v-flex>
    <v-layout row wrap>
      <v-flex xl2 lg2 md2 sm6 xs12 class="pa-2">
       
              <v-text-field
                label="Father's lastname"
                v-model="fatherLastname"
                :rules="[v => !!v || 'This field is required.']"
                required
              ></v-text-field>
      </v-flex>
      <v-flex xl2 lg2 md2 sm6 xs12 class="pa-2">
            <v-text-field
                label="Father's firstname"
                v-model="fatherFirstname"
                :rules="[v => !!v || 'This field is required.']"
                required
              ></v-text-field>
      </v-flex>
      <v-flex xl2 lg2 md2 sm6 xs12 class="pa-2">
            <v-text-field
                label="Father's middlename"
                v-model="fatherMiddlename"
                :rules="[v => !!v || 'This field is required.']"
                required
              ></v-text-field>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
            <v-text-field
                label="Occupation"
                v-model="fatherOccupation"
                :rules="[v => !!v || 'This field is required.']"
                required
              ></v-text-field>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
            <v-text-field
                label="Contact Number"
                v-model="fatherContactNo"
                :type="'number'"

              ></v-text-field>
      </v-flex>
      
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
             <v-autocomplete
                label="Province"
                :items="provinces"
                v-model="fatherProvinceId"
                item-value="id"
                item-text="name"
                autocomplete
                required
                :rules="[v => !!v || 'This field is required.']"
              ></v-autocomplete>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
            <v-autocomplete
                label="City"
                :items="fatherCities"
                v-model="fatherCityId"
                item-value="id"
                item-text="name"
                autocomplete
                :rules="[v => !!v || 'This field is required.']"
                required
              ></v-autocomplete>
      </v-flex>
     
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
           <v-text-field
                label="Zipcode"
                v-model="fatherZipCode"
                :type="'number'"
                :rules="[v => !!v || 'This field is required.']"
                required
              ></v-text-field>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
                
            <v-textarea
                label="Present Address(House No:, street)"
                v-model="fatherAddress"
                color="grey"
                :rules="[v => !!v || 'This field is required.']"
                required
              ></v-textarea>
      </v-flex>
    </v-layout>

    <v-divider></v-divider>
    <v-layout row wrap>

      <v-flex xl2 lg2 md2 sm6 xs12 class="pa-2">
       
              <v-text-field
                label="Mother's lastname"
                v-model="motherLastname"
                :rules="[v => !!v || 'This field is required.']"
                required
              ></v-text-field>
      </v-flex>
      <v-flex xl2 lg2 md2 sm6 xs12 class="pa-2">
            <v-text-field
                label="Mother's firstname"
                v-model="motherFirstname"
                :rules="[v => !!v || 'This field is required.']"
                required
              ></v-text-field>
      </v-flex>
      <v-flex xl2 lg2 md2 sm6 xs12 class="pa-2">
            <v-text-field
                label="Mother's middlename"
                v-model="motherMiddlename"
                :rules="[v => !!v || 'This field is required.']"
                required
              ></v-text-field>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
            <v-text-field
                label="Occupation"
                v-model="motherOccupation"
                :rules="[v => !!v || 'This field is required.']"
                required
              ></v-text-field>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
            <v-text-field
                label="Contact Number"
                v-model="motherContactNo"
                :type="'number'"
              ></v-text-field>
      </v-flex>
      
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
             <v-autocomplete
                autocomplete
                label="Province"
                :items="provinces"
                v-model="motherProvinceId"
                item-value="id"
                item-text="name"
                required
                :rules="[v => !!v || 'This field is required.']"
              ></v-autocomplete>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
            <v-autocomplete
                autocomplete
                label="City"
                :items="motherCities"
                v-model="motherCityId"
                item-value="id"
                item-text="name"
                :rules="[v => !!v || 'This field is required.']"
                required
              ></v-autocomplete>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
           <v-text-field
                label="Zipcode"
                v-model="motherZipCode"
                :type="'number'"
                :rules="[v => !!v || 'This field is required.']"
                required
              ></v-text-field>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
            <v-textarea
                label="Present Address(House No:, street)"
                v-model="motherAddress"
                color="grey"
                :rules="[v => !!v || 'This field is required.']"
                required
              ></v-textarea>
      </v-flex>
    </v-layout>

    <v-divider></v-divider>
    <v-flex xl12>
        <br />
         <span class="subheading">Siblings(Brothers & Sisters)</span>
    </v-flex>
    <v-layout row wrap>
      <v-flex xl12 lg12 md12 sm12 xs12>
          <v-chip close  v-for="(sibling, i) in siblings" :key="i" @input="removeSibling(i)">{{ sibling.name }}</v-chip>
      </v-flex>
      
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
              <v-text-field
                label="Name"
                v-model="siblingName"
              ></v-text-field>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
              <v-text-field
                label="Age"
                v-model="siblingAge"
                :type="'number'"
              ></v-text-field>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
              <v-text-field
                label="Occupation"
                v-model="siblingOcc"
              ></v-text-field>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
              <v-text-field
                label="Name of school"
                v-model="siblingNameOfSchool"
              ></v-text-field>
      </v-flex>
      <v-btn dark color="indigo" @click="addSibling">
        More Sibling
        
      </v-btn>
       
      </v-layout>

    <v-divider></v-divider>
    <v-flex xl12>
        <br />
         <span class="subheading">School Background:</span>
    </v-flex>
    <v-layout row wrap>
      
      <v-flex xl12 lg12 md12 sm6 xs12 class="pa-2">
            <v-text-field
                label="Name of school"
                v-model="schoolName"
                :rules="[v => !!v || 'This field is required.']"
                required
              ></v-text-field>
      </v-flex>
      
     
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
             <v-autocomplete
                label="Province"
                :items="provinces"
                v-model="schoolProvinceId"
                item-value="id"
                item-text="name"
                required
                :rules="[v => !!v || 'This field is required.']"
              ></v-autocomplete>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
            <v-autocomplete
                label="City"
                :items="schoolCities"
                v-model="schoolCityId"
                item-value="id"
                item-text="name"
                required
                :rules="[v => !!v || 'This field is required.']"
              ></v-autocomplete>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
           <v-text-field
                label="Zipcode"
                v-model="schoolZipCode"
                :type="'number'"
                :rules="[v => !!v || 'This field is required.']"
                required
              ></v-text-field>
      </v-flex>
       <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
            <v-textarea
                label="Present Address(House No:, street)"
                v-model="schoolAddress"
                color="grey"
                :rules="[v => !!v || 'This field is required.']"
                required
              ></v-textarea>
      </v-flex>
    </v-layout>

    <v-divider></v-divider>
    
    <v-layout row wrap>
      
      <v-flex xl4 lg4 md4 sm6 xs12 class="pa-2" v-for="question in questions" :key="question.id">
            <v-autocomplete
                :label="question.name"
                :items="question.answers"
                item-value="id"
                item-text="name"
                @change="myAnswer"
              ></v-autocomplete>
      </v-flex>
     
    </v-layout>


    <v-divider></v-divider>
    <v-flex xl12>
        <br />
         <span class="subheading">REQUIREMENTS: (Please check the documents submitted)</span>
    </v-flex>
    <v-layout row wrap>
      
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2" v-for="requirement in requirements" :key="requirement.id">
            <v-autocomplete
                :label="requirement.name"
                :items="requirement.requirements_doc"
                v-model="requirementsDocs"
                item-value="id"
                item-text="name"
                multiple
              ></v-autocomplete>
      </v-flex>
        
      <v-flex xl12 lg12 md12 sm12 xs12 class="pa-2">
             <v-checkbox
              label="I will only be officially enrolled once the following school requirements have been completed and submitted."
              v-model="policy1"
              :rules="[v => !!v || 'You must agree to continue!']"
              value="1"
              required
              class="ma-0 pa-0"
            ></v-checkbox> <span></span>
            <br />
            <v-checkbox
              label="I understand that all fees are NON-REFUNDABLE UPON ENROLLMENT. I have read/understand this policy and I certify all entries are true and correct."
              v-model="policy2"
              :rules="[v => !!v || 'You must agree to continue!']"
              value="2"
              required
              class="ma-0 pa-0"
            ></v-checkbox>
      </v-flex>
    </v-layout>
      <v-flex xl12>
        <br />
         <span class="subheading red--text">Your personal information will be kept in strictest confidence. None of your information will be disclosed without your consent.</span>
         <br />
         <v-btn
          color="info"
          @click="submit"
          :disabled="!valid"
        >
          submit
        </v-btn>
    </v-flex>
     </v-form>
     <snackbar v-bind:color="snackbarColor" v-bind:text="snackbarText" ></snackbar>
     <registration-completed v-bind:color="snackbarColor" v-bind:text="snackbarText" ></registration-completed>
  </v-container>
</template>

<script>
  import timePicker from '../../pickers/time-picker.vue'
  import datePicker from '../../pickers/date-picker.vue'
  import snackbar from '../../snackbar/snackbar.vue'
  import registrationCompleted from '../../snackbar/registration-completed.vue'

  export default {
    data () {
      return {
        checkbox: '',
        firstname: '',
        middlename: '',
        lastname: '',
        suffix: '',
        age: '',
        birthplace: '',
        selectedEducAtt: '',
        sex: '',
        sexs:['Male', 'Female'],
        selectedCivil: '',
        nickName: '',
        spouseLastname: '',
        spouseFirstname: '',
        spouseMiddlename: '',
        landline: '',
        mobile: '',
        email: '',
        religion: '',
        citizenship: '',
        course: '',
        schoolYearError: ['Please select school year'],
        schoolYear: '',
        yearLevel: '',
        semester: '',
        schedule: '',

        presentProvinceId: '',
        presentCityId: '',
        presentCities: [],
        presentZipCode: '',
        presentAddress: '',



        permanentProvinceId: '',
        permanentCityId: '',
        permanentCities: [],
        permanentZipCode: '',
        permanentAddress: '',

        fatherLastname: '',
        fatherMiddlename: '',
        fatherFirstname: '',
        fatherOccupation: '',
        fatherContactNo: '',
        fatherProvinceId: '',
        fatherCities: [],
        fatherCityId: '',
        fatherZipCode: '',
        fatherAddress: '',

        motherLastname: '',
        motherMiddlename: '',
        motherFirstname: '',
        motherOccupation: '',
        motherContactNo: '',
        motherProvinceId: '',
        motherCities: [],
        motherCityId: '',
        motherZipCode: '',
        motherAddress: '',


        siblingName: '',
        siblingAge: '',
        siblingOcc: '',
        siblingNameOfSchool: '',

        schoolName: '',
        schoolAddress: '',
        schoolProvinceId: '',
        schoolCities: [],
        schoolCityId: '',
        schoolZipCode: '',
        answer: [],
        requirementsDocs: [],
        snackbar: true,
        snackbarColor: 'error',
        snackbarText: '',
        policy1: '',
        policy2: '',
        valid: true,
      }
    },
    components: {
      timePicker, datePicker, snackbar, registrationCompleted
    },
    computed: {

      dateNow(){
        var d = new Date();
        return  d.getDate() + '/' + d.getDay() + '/' + d.getFullYear();
      },
      admissionNo(){

        return new Date().valueOf();


      },
      provinces(){
        return this.$store.getters.provinces
      },
      schoolYears(){
        return this.$store.getters.schoolYears
      },
      courses(){

        return this.$store.getters.courses
      },
      siblings(){

        return this.$store.getters.siblings
      },
      questions(){

        return this.$store.getters.questions
      },
      yearLevels(){
        return this.$store.getters.yearLevel
      },
      semesters(){
        return this.$store.getters.semesters
      },
      schedules(){
        return this.$store.getters.schedules
      },
      requirements(){
        return this.$store.getters.requirements
      },
      policies(){
        return this.$store.getters.policies
      },
      civilStatus(){
        return this.$store.getters.civilStatus
      },
      birthday(){
        return this.$store.getters.birthday
      },
      educAtt(){
        return this.$store.getters.educAtt
      },
      startTime(){
        return this.$store.getters.startTime
      },
      endTime(){
        return this.$store.getters.endTime
      }

    },
    methods: {
      schoolYearChange(schoolYear){
        if(schoolYear != ''){
          this.schoolYearError = []
        }else{
          this.schoolYearError = ['Please select school year']
        }
      },
      addSibling(){

        if (this.siblingName != '' && this.siblingAge != '' && this.siblingOcc != '' && this.siblingNameOfSchool != '') {
          this.$store.dispatch('addSibling', {
              name: this.siblingName,
              age: this.siblingAge,
              occupation: this.siblingOcc,
              school_name: this.siblingNameOfSchool
          })
          this.siblingName = ''
          this.siblingAge = ''
          this.siblingOcc = ''
          this.siblingNameOfSchool = ''
          this.$store.dispatch('snackbar', false)
         
        }else {
            this.snackbarColor = 'error'
            this.snackbarText = 'Sibling fields are required!'
            this.$store.dispatch('snackbar', true)
        }
          
      },
      removeSibling(index){
        this.$store.dispatch('removeSibling', index)
      },
      myAnswer(answerId){
        var data = this
        this.$http.get(base_api + '/get-question-id/' + answerId)
        .then(function(res){

            if ( data.answer.length > 0) {
              for (var i=0; i < data.answer.length; i++) {

                 if(data.answer[i].questionId === res.data.questionId){
                   delete data.answer[i] 
                 }
              }

              data.answer.push({
                  questionId: res.data.questionId,
                  answerId: answerId
                })

              var cleanArray = []
              for (var a=0; a < data.answer.length; a++) {
                if(data.answer[a] != undefined){
                  cleanArray.push(data.answer[a])
                }
                
              }

              data.answer = cleanArray
            }

            if (data.answer.length === 0) {
              data.answer.push({
                  questionId: res.data.questionId,
                  answerId: answerId
                })
            }

            
        })
      },
      submit () {
        if (this.siblingName != '' && this.siblingAge != '' && this.siblingOcc != '' && this.siblingNameOfSchool != '') {
            this.addSibling()
          }

        

        if (this.$refs.form.validate()) {
          
          var data = this
          this.$http.post(base_api + '/enrollment', {
            start_time: this.startTime,
            end_time: this.endTime,
            semester_id: this.semester,
            school_year_id: this.schoolYear,
            year_level_id: this.yearLevel,
            schedule_id: this.schedule,
            start_time: this.startTime,
            admissionNo: this.admissionNo,
            course_id: this.course,
            firstname: this.firstname,
            middlename: this.middlename,
            lastname: this.lastname,
            suffix: this.suffix,
            nickname: this.nickName,
            age: this.age,
            birthday: this.birthday,
            birth_place: this.birthplace,
            sex: this.sex,
            educ_at_id: this.EducAtt,
            civil: this.selectedCivil,
            spouse_lastname: this.spouseLastname,
            spouse_firstname: this.spouseFirstname,
            spouse_middlename: this.spouseMiddlename,
            landline: this.landline,
            mobile: this.mobile,
            email: this.email,
            religion: this.religion,
            citizenship: this.citizenship,
            present_address: this.presentAddress,
            present_province_id: this.presentProvinceId,
            present_city_id: this.presentCityId,
            present_zipcode: this.presentZipCode,
            permanent_address: this.permanentAddress,
            permanent_province_id: this.permanentProvinceId,
            permanent_city_id: this.permanentCityId,
            permanent_zipcode: this.permanentZipCode,
            father_firstname: this.fatherFirstname,
            father_lastname: this.fatherLastname,
            father_middlename: this.fatherMiddlename,
            father_occupation: this.fatherOccupation,
            father_contact_number: this.fatherContactNo,
            father_address: this.fatherAddress,
            father_province_id: this.fatherProvinceId,
            father_city_id: this.fatherCityId,
            father_zipcode: this.fatherZipCode,
            mother_firstname: this.motherFirstname,
            mother_lastname: this.motherLastname,
            mother_middlename: this.motherMiddlename,
            mother_occupation: this.motherOccupation,
            mother_contact_number: this.motherContactNo,
            mother_address: this.motherAddress,
            mother_province_id: this.motherProvinceId,
            mother_city_id: this.motherCityId,
            mother_zipcode: this.motherZipCode,
            name_of_school: this.schoolName,
            school_address: this.schoolAddress,
            school_province_id: this.schoolProvinceId,
            school_city_id: this.schoolCityId,
            school_zipcode: this.schoolZipCode,
            siblings: this.siblings,
            answers: this.answer,
            requirementsDocs: this.requirementsDocs
            
            
          })
          .then(function(res){
              data.snackbarColor = 'success'
              data.snackbarText = 'Registration completed!'
              data.$store.dispatch('registrationCompleted', true)
          })
          
        }else{
            this.snackbarColor = 'error'
            this.snackbarText = 'Please correct some errors!'
            this.$store.dispatch('snackbar', true)
        }
      },
    },
    watch: {

      presentProvinceId(){
        var data = this
        this.$http.get(base_api + '/cities/' + this.presentProvinceId)
        .then(function(res){
            data.presentCities = res.data.cities
        })
      },
      presentCityId(){
        var data = this
        this.$http.get(base_api + '/get-city-zipcode/' + this.presentCityId)
        .then(function(res){
            data.presentZipCode = res.data.city.zipcode
        })
      },
      permanentProvinceId(){
        var data = this
        this.$http.get(base_api + '/cities/' + this.permanentProvinceId)
        .then(function(res){
            data.permanentCities = res.data.cities
        })

      },
      permanentCityId(){
        var data = this
        this.$http.get(base_api + '/get-city-zipcode/' + this.permanentCityId)
        .then(function(res){
            data.permanentZipCode = res.data.city.zipcode
        })
      },
      fatherProvinceId(){
        var data = this
        this.$http.get(base_api + '/cities/' + this.fatherProvinceId)
        .then(function(res){
            data.fatherCities = res.data.cities
        })
      },
      fatherCityId(){
        var data = this
        this.$http.get(base_api + '/get-city-zipcode/' + this.fatherCityId)
        .then(function(res){
            data.fatherZipCode = res.data.city.zipcode
        })
      },
      motherProvinceId(){
        var data = this
        this.$http.get(base_api + '/cities/' + this.motherProvinceId)
        .then(function(res){
            data.motherCities = res.data.cities
        })
      },
      motherCityId(){
        var data = this
        this.$http.get(base_api + '/get-city-zipcode/' + this.motherCityId)
        .then(function(res){
            data.motherZipCode = res.data.city.zipcode
        })
      },
      schoolProvinceId(){
        var data = this
        this.$http.get(base_api + '/cities/' + this.schoolProvinceId)
        .then(function(res){
            data.schoolCities = res.data.cities
        })
      },
      schoolCityId(){
        var data = this
        this.$http.get(base_api + '/get-city-zipcode/' + this.schoolCityId)
        .then(function(res){
            data.schoolZipCode = res.data.city.zipcode
        })
      },

    }
  }
</script>