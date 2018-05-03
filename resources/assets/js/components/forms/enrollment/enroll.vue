<template>
  <v-container fluid>
    <v-form v-model="valid" ref="form" lazy-validation>
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
        <v-select
                label="Select Course"
                :items="courses"
                v-model="course"
                item-text="name"
                item-value="id"
                :rules="[v => !!v || 'Please select course.']"
                required
              ></v-select>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
        <v-select
                label="School Year"
                :items="schoolYears"
                v-model="schoolYear"
                item-value="id"
                item-text="sy"
                :rules="[v => !!v || 'Please select school year.']"
                @change="schoolYearChange"
                required
              ></v-select>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
        <v-select
                label="Year level"
                :items="yearLevels"
                v-model="yearLevel"
                item-value="id"
                item-text="name"
                :rules="[v => !!v || 'Please select year level.']"
                required
              ></v-select>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
        <v-select
                label="Semester"
                :items="items"
                v-model="semester"
                item-value="text"
                :rules="[v => !!v || 'Please select semester.']"
                required
              ></v-select>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
        <v-select
                label="Schedule"
                :items="items"
                v-model="schedule"
                item-value="text"
                :rules="[v => !!v || 'Please select schedule.']"
                required
              ></v-select>
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
                v-model="perInfo.lastname"
                 :rules="[v => !!v || 'This field is required.']"
                required
              ></v-text-field>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
            <v-text-field
                label="Firstname"
                v-model="perInfo.firstname"
                :rules="[v => !!v || 'This field is required.']"
                required
              ></v-text-field>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
            <v-text-field
                label="Middlename"
                :rules="[v => !!v || 'This field is required.']"
                v-model="perInfo.middlename"
                required
              ></v-text-field>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
            <v-text-field
                label="Suffix"
                v-model="perInfo.suffix"

              ></v-text-field>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
            <v-text-field
                label="Nick name"
                v-model="perInfo.nickName"
              ></v-text-field>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
            <v-text-field
                label="Age"
                v-model="perInfo.age"
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
                v-model="perInfo.birthplace"
                required
                :rules="[v => !!v || 'This field is required.']"
              ></v-text-field>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
           <v-select
                label="Sex"
                :items="items"
                v-model="perInfo.sex"
                item-value="text"
                required
                :rules="[v => !!v || 'This field is required.']"
              ></v-select>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
           <v-select
                label="Civil Status"
                :items="items"
                v-model="perInfo.civlStatus"
                item-value="text"
                :rules="[v => !!v || 'This field is required.']"
                required
              ></v-select>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
           <v-text-field
                label="Landline"
                v-model="perInfo.landline"
                prepend-icon="phone"
              ></v-text-field>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
           <v-text-field
                label="Phone Number"
                v-model="perInfo.phone_number"
                :rules="[v => !!v || 'This field is required.']"
                required
                prepend-icon="phone_android"
              ></v-text-field>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
           <v-text-field
                label="Religion"
                v-model="perInfo.religion"
                prepend-icon="pages"
                required
                :rules="[v => !!v || 'This field is required.']"
              ></v-text-field>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
           <v-text-field
                label="Citizenship"
                v-model="perInfo.citizenship"
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
             <v-select
                autocomplete
                label="Present Province"
                :items="provinces"
                v-model="presentProvinceId"
                item-text="name"
                item-value="id"
                required
                :rules="[v => !!v || 'This field is required.']"
              ></v-select>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
            <v-select
                autocomplete
                label="Present City"
                :items="presentCities"
                v-model="presentCityId"
                item-text="name"
                item-value="id"
                required
                :rules="[v => !!v || 'This field is required.']"
              ></v-select>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
           <v-text-field
                label="Present Zipcode"
                v-model="presentZipCode"
                :rules="[v => !!v || 'This field is required.']"
                required
              ></v-text-field>
      </v-flex>
      
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
            <v-text-field
                label="Present Address(House No:, street)"
                v-model="presentAddress"
                color="grey"
                textarea
                :rules="[v => !!v || 'This field is required.']"
                required
              ></v-text-field>
      </v-flex>
    </v-layout>

    <v-flex xl12>
        <br />
         <span class="subheading">Permanent address</span>
    </v-flex>
    <v-layout row wrap>
       <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
             <v-select
                label="Permanent Province"
                :items="provinces"
                v-model="permanentProvinceId"
                item-value="id"
                item-text="name"
                :rules="[v => !!v || 'This field is required.']"
                required
              ></v-select>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
            <v-select
                label="Permanent City"
                :items="permanentCities"
                v-model="permanentCityId"
                item-value="id"
                item-text="name"
                :rules="[v => !!v || 'This field is required.']"
                required
              ></v-select>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
           <v-text-field
                label="Permanent Zipcode"
                v-model="permanentZipCode"
                :rules="[v => !!v || 'This field is required.']"
                required
              ></v-text-field>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
            <v-text-field
                label="Permanent Address(House No:, street)"
                v-model="permanentAddress"
                color="grey"
                textarea
                :rules="[v => !!v || 'This field is required.']"
                required
              ></v-text-field>
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

              ></v-text-field>
      </v-flex>
      
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
             <v-select
                label="Province"
                :items="provinces"
                v-model="fatherProvinceId"
                item-value="id"
                item-text="name"
                autocomplete
                required
                :rules="[v => !!v || 'This field is required.']"
              ></v-select>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
            <v-select
                label="City"
                :items="fatherCities"
                v-model="fatherCityId"
                item-value="id"
                item-text="name"
                autocomplete
                :rules="[v => !!v || 'This field is required.']"
                required
              ></v-select>
      </v-flex>
     
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
           <v-text-field
                label="Zipcode"
                v-model="fatherZipCode"
                :rules="[v => !!v || 'This field is required.']"
                required
              ></v-text-field>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
            <v-text-field
                label="Present Address(House No:, street)"
                v-model="fatherAddress"
                color="grey"
                textarea
                :rules="[v => !!v || 'This field is required.']"
                required
              ></v-text-field>
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
              ></v-text-field>
      </v-flex>
      
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
             <v-select
                autocomplete
                label="Province"
                :items="provinces"
                v-model="motherProvinceId"
                item-value="id"
                item-text="name"
                required
                :rules="[v => !!v || 'This field is required.']"
              ></v-select>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
            <v-select
                autocomplete
                label="City"
                :items="motherCities"
                v-model="motherCityId"
                item-value="id"
                item-text="name"
                :rules="[v => !!v || 'This field is required.']"
                required
              ></v-select>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
           <v-text-field
                label="Zipcode"
                v-model="motherZipCode"
                :rules="[v => !!v || 'This field is required.']"
                required
              ></v-text-field>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
            <v-text-field
                label="Present Address(House No:, street)"
                v-model="motherAddress"
                color="grey"
                textarea
                :rules="[v => !!v || 'This field is required.']"
                required
              ></v-text-field>
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
             <v-select
                label="Province"
                :items="provinces"
                v-model="schoolProvinceId"
                item-value="id"
                item-text="name"
                required
                :rules="[v => !!v || 'This field is required.']"
              ></v-select>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
            <v-select
                label="City"
                :items="schoolCities"
                v-model="schoolCityId"
                item-value="id"
                item-text="name"
                required
                :rules="[v => !!v || 'This field is required.']"
              ></v-select>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
           <v-text-field
                label="Zipcode"
                v-model="schoolZipCode"
                :rules="[v => !!v || 'This field is required.']"
                required
              ></v-text-field>
      </v-flex>
       <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
            <v-text-field
                label="Present Address(House No:, street)"
                v-model="schoolAddress"
                color="grey"
                textarea
                :rules="[v => !!v || 'This field is required.']"
                required
              ></v-text-field>
      </v-flex>
    </v-layout>

    <v-divider></v-divider>
    
    <v-layout row wrap>
      
      <v-flex xl4 lg4 md4 sm6 xs12 class="pa-2">
            <v-select
                :label="'My Parents Are'"
                :items="answers1"
                item-value="id"
                item-text="text"
                v-model="selectedAnswer1"
                :rules="[v => !!v || 'This field is required.']"
                required
              ></v-select>
      </v-flex>
      <v-flex xl4 lg4 md4 sm6 xs12 class="pa-2">
            <v-select
                :label="'Who are you living with'"
                :items="answers2"
                item-value="id"
                item-text="text"
                v-model="selectedAnswer2"
                required
                :rules="[v => !!v || 'This field is required.']"
              ></v-select>
      </v-flex>
       <v-flex xl4 lg4 md4 sm6 xs12 class="pa-2">
            <v-select
                :label="'Where will you live during school days'"
                :items="answers2"
                item-value="id"
                item-text="text"
                v-model="selectedAnswer3"
                required
                :rules="[v => !!v || 'This field is required.']"
              ></v-select>
      </v-flex>

    </v-layout>


    <v-divider></v-divider>
    <v-flex xl12>
        <br />
         <span class="subheading">REQUIREMENTS: (Please check the documents submitted)</span>
    </v-flex>
    <v-layout row wrap>
      
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
            <v-select
                label="For Highschool Graduate"
                :items="requireHighschool"
                item-value="id"
                item-text="text"
                multiple
                :rules="[v => !!v || 'This field is required.']"
              ></v-select>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
            <v-select
                label="For ALS"
                :items="requireAls"
                v-model="answerRequiredAls"
                item-value="id"
                item-text="text"
                multiple
              ></v-select>
      </v-flex>
        <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
            <v-select
                label="For College (Level/Degree)"
                :items="requireCollege"
                v-model="answerRequiredCollege"
                item-value="id"
                item-text="text"
                multiple
              ></v-select>
      </v-flex>
         <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
            <v-select
                label="ADDITIONAL REQUIREMENTS"
                :items="requireAdd"
                v-model="answerRequiredAdd"
                item-value="id"
                item-text="text"
                multiple
              ></v-select>
      </v-flex>
      <v-flex xl12 lg12 md12 sm12 xs12 class="pa-2">
             <v-checkbox
              label="I understand that I’m temporarily enrolled at Intellisense Institute of Technology and I am aware that I will only be officially enrolled once the following school requirements have been completed and submitted."
              v-model="policy1"
              :rules="[v => !!v || 'You must agree to continue!']"
              required
              class="ma-0 pa-0"
            ></v-checkbox>
            <br />
            <v-checkbox
              label=" understand that all fees are NON-REFUNDABLE UPON ENROLLMENT. I have read/understand this policy and I certify all entries are true and correct."
              v-model="policy2"
              :rules="[v => !!v || 'You must agree to continue!']"
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
     <snackbar v-bind:color="'error'" v-bind:text="'Please correct the errors!'"></snackbar>
  </v-container>
</template>

<script>
  import timePicker from '../../pickers/time-picker.vue'
  import datePicker from '../../pickers/date-picker.vue'
  import snackbar from '../../snackbar/snackbar.vue'

  export default {
    data () {
      return {
        checkbox: '',
        first: '',
        perInfo: {

            firstname: '',
            middlename: '',
            lastname: '',
            suffix: '',
            age: '',
            birthday: '',
            birthplace: '',
            sex: '',
            civilStatus: '',
            spouseLastname: '',
            spouseFirstname: '',
            spouseMiddlename: '',
            landline: '',
            mobile: '',
            email: '',
            religion: '',
            citizenship: ''
        },
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

        answers1: [
          { id: 1, text: 'Living Together'},
          { id: 2, text: 'Father/Mother working abroad'},
          { id: 3, text: 'Separated'},
          { id: 4, text: 'Deceased Mother/Father'}
        ],
        answers2: [
          { id: 1, text: 'Parents/in Laws'},
          { id: 2, text: 'Stepfather/Stepmother'},
          { id: 3, text: 'Guardians/Relatives'},
          { id: 4, text: 'Spouse'}
        ],
        selectedAnswer1: '',
        selectedAnswer2: '',
        selectedAnswer3: '',

        requireHighschool:[
          { id: 1, text: 'Report card (original)'},
          { id: 2, text: 'Good moral' },
          { id: 3, text: 'FORM 137(school to school)' }
        ],
        requireAls:[
          { id: 1, text: 'ALS Certification'}
        ],
        requireCollege:[
          { id: 1, text: 'Honorable Dismissal'},
          { id: 2, text: 'TOR' },
          { id: 3, text: 'Good Moral' }
        ],
        requireAdd:[
          { id: 1, text: 'NSO Birth Certificate (original)'},
          { id: 2, text: '2x2 colored picture white background (2 pcs)  ' },
          { id: 3, text: 'long brown envelope with plastic' }
        ],
        answerRequiredHighschool: [],
        answerRequiredAls: [],
        answerRequiredCollege: [],
        answerRequiredAdd: [],
        snackbar: true,

        policy1: '',
        policy2: '',
        items: [
          { text: 'State 1' },
          { text: 'State 2' },
          { text: 'State 3' },
          { text: 'State 4' },
          { text: 'State 5' },
          { text: 'State 6' },
          { text: 'State 7' }
        ],
        valid: true,
      }
    },
    components: {
      timePicker, datePicker, snackbar
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
      answers(){

        return this.$store.getters.answers
      },
      yearLevels(){
        return this.$store.getters.yearLevel
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
      },
      removeSibling(index){
        this.$store.dispatch('removeSibling', index)
      },
      submit () {
        if (this.$refs.form.validate()) {
          
          
        }else{
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