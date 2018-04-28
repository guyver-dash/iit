<template>
  <v-container fluid>
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
                :rules="[() => first.length > 0 || 'This field is required']"
                disabled
                required
              ></v-text-field>
      </v-flex>

      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
        <v-select
                label="Select Course"
                :items="courses"
                v-model="course"
                item-text="name"
                item-value="id"
                required
              ></v-select>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
        <v-select
                label="School Year"
                :items="items"
                v-model="schoolYear"
                item-value="text"
                required
              ></v-select>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
        <v-select
                label="Year level"
                :items="items"
                v-model="yearLevel"
                item-value="text"
                required
              ></v-select>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
        <v-select
                label="Semester"
                :items="items"
                v-model="semester"
                item-value="text"
                required
              ></v-select>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
        <v-select
                label="Schedule"
                :items="items"
                v-model="schedule"
                item-value="text"
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
              ></v-text-field>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
            <v-text-field
                label="Firstname"
                v-model="perInfo.firstname"
              ></v-text-field>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
            <v-text-field
                label="Middlename"
                v-model="perInfo.middlename"
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
              ></v-text-field>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
            <time-picker v-bind:label="'Birthday'"></time-picker>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
            <v-text-field
                label="Birth Place"
                v-model="perInfo.birthplace"
              ></v-text-field>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
           <v-select
                label="Sex"
                :items="items"
                v-model="perInfo.sex"
                item-value="text"
                required
              ></v-select>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
           <v-select
                label="Civil Status"
                :items="items"
                v-model="perInfo.civlStatus"
                item-value="text"
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
                prepend-icon="phone_android"
              ></v-text-field>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
           <v-text-field
                label="Phone Number"
                v-model="perInfo.email"
                prepend-icon="email"
              ></v-text-field>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
           <v-text-field
                label="Religion"
                v-model="perInfo.religion"
                prepend-icon="email"
              ></v-text-field>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
           <v-text-field
                label="Citizenship"
                v-model="perInfo.citizenship"
                prepend-icon="email"
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
              ></v-select>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
           <v-text-field
                label="Present Zipcode"
                v-model="presentZipCode"
              ></v-text-field>
      </v-flex>
      
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
            <v-text-field
                label="Present Address(House No:, street)"
                v-model="presentAddress"
                color="grey"
                textarea
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
                required
              ></v-select>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
           <v-text-field
                label="Permanent Zipcode"
                v-model="permanentZipCode"
              ></v-text-field>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
            <v-text-field
                label="Permanent Address(House No:, street)"
                v-model="permanentAddress"
                color="grey"
                textarea
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
              ></v-text-field>
      </v-flex>
      <v-flex xl2 lg2 md2 sm6 xs12 class="pa-2">
            <v-text-field
                label="Father's firstname"
                v-model="fatherFirstname"
              ></v-text-field>
      </v-flex>
      <v-flex xl2 lg2 md2 sm6 xs12 class="pa-2">
            <v-text-field
                label="Father's middlename"
                v-model="fatherMiddlename"
              ></v-text-field>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
            <v-text-field
                label="Occupation"
                v-model="fatherOccupation"
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
                required
              ></v-select>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
            <v-select
                label="City"
                :items="fatherCities"
                v-model="fatherCityId"
                item-value="id"
                item-text="name"
                required
              ></v-select>
      </v-flex>
     
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
           <v-text-field
                label="Zipcode"
                v-model="fatherZipCode"
              ></v-text-field>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
            <v-text-field
                label="Present Address(House No:, street)"
                v-model="fatherAddress"
                color="grey"
                textarea
              ></v-text-field>
      </v-flex>
    </v-layout>

    <v-divider></v-divider>
    <v-layout row wrap>

      <v-flex xl2 lg2 md2 sm6 xs12 class="pa-2">
       
              <v-text-field
                label="Mother's lastname"
                v-model="motherLastname"
              ></v-text-field>
      </v-flex>
      <v-flex xl2 lg2 md2 sm6 xs12 class="pa-2">
            <v-text-field
                label="Mother's firstname"
                v-model="motherFirstname"
              ></v-text-field>
      </v-flex>
      <v-flex xl2 lg2 md2 sm6 xs12 class="pa-2">
            <v-text-field
                label="Mother's middlename"
                v-model="motherMiddlename"
              ></v-text-field>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
            <v-text-field
                label="Occupation"
                v-model="motherOccupation"
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
                label="Province"
                :items="provinces"
                v-model="motherProvinceId"
                item-value="name"
                item-text="id"
                required
              ></v-select>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
            <v-select
                label="City"
                :items="motherCities"
                v-model="motherCityId"
                item-value="name"
                item-text="id"
                required
              ></v-select>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
           <v-text-field
                label="Zipcode"
                v-model="motherZipCode"
              ></v-text-field>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
            <v-text-field
                label="Present Address(House No:, street)"
                v-model="motherAddress"
                color="grey"
                textarea
              ></v-text-field>
      </v-flex>
    </v-layout>

    <v-divider></v-divider>
    <v-flex xl12>
        <br />
         <span class="subheading">Siblings(Brothers & Sisters)</span>
    </v-flex>
    <v-layout row wrap>
      
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
              <v-text-field
                label="Name"
                v-model="perInfo.lastname"
              ></v-text-field>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
              <v-text-field
                label="Age"
                v-model="perInfo.lastname"
              ></v-text-field>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
              <v-text-field
                label="Occupation"
                v-model="perInfo.lastname"
              ></v-text-field>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
              <v-text-field
                label="Name of school"
                v-model="perInfo.lastname"
              ></v-text-field>
      </v-flex>
      <v-btn fab dark color="indigo">
        <v-icon dark>add</v-icon>
      </v-btn>
      </v-layout>



    <v-divider></v-divider>
    <v-flex xl12>
        <br />
         <span class="subheading">School Background:</span>
    </v-flex>
    <v-layout row wrap>
      
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
            <v-text-field
                label="Name of school"
                v-model="perInfo.firstname"
              ></v-text-field>
      </v-flex>
      
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
            <v-text-field
                label="Present Address(House No:, street)"
                v-model="perInfo.age"
                color="grey"
                textarea
              ></v-text-field>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
             <v-select
                label="Province"
                :items="items"
                v-model="course"
                item-value="text"
                required
              ></v-select>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
            <v-select
                label="City"
                :items="items"
                v-model="course"
                item-value="text"
                required
              ></v-select>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
            <v-select
                label="Barangay"
                :items="items"
                v-model="course"
                item-value="text"
                required
              ></v-select>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
           <v-text-field
                label="Zipcode"
                v-model="perInfo.age"
              ></v-text-field>
      </v-flex>
    </v-layout>

    <v-divider></v-divider>
    
    <v-layout row wrap>
      
      <v-flex xl4 lg4 md4 sm6 xs12 class="pa-2">
            <v-select
                label="My Parents Are"
                :items="items"
                v-model="course"
                item-value="text"
                required
              ></v-select>
      </v-flex>
      
      <v-flex xl4 lg4 md4 sm6 xs12 class="pa-2">
            <v-select
                label="Who are you living with"
                :items="items"
                v-model="course"
                item-value="text"
                required
              ></v-select>
      </v-flex>
      <v-flex xl4 lg4 md4 sm6 xs12 class="pa-2">
             <v-select
                label="Where will you live during school days:"
                :items="items"
                v-model="course"
                item-value="text"
                required
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
                :items="items"
                v-model="course"
                item-value="text"
                required
              ></v-select>
      </v-flex>
      
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
            <v-select
                label="For ALS"
                :items="items"
                v-model="course"
                item-value="text"
                required
              ></v-select>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
             <v-select
                label="For College (Level/Degree)"
                :items="items"
                v-model="course"
                item-value="text"
                required
              ></v-select>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
             <v-select
                label="Additional Requirements"
                :items="items"
                v-model="course"
                item-value="text"
                required
              ></v-select>
      </v-flex>
      <v-flex xl12 lg12 md12 sm12 xs12 class="pa-2">
             <v-checkbox
              label="I understand that I’m temporarily enrolled at Intellisense Institute of Technology and I am aware that I will only be officially enrolled once the following school requirements have been completed and submitted."
              v-model="checkbox"
              :rules="[v => !!v || 'You must agree to continue!']"
              required
              class="ma-0 pa-0"
            ></v-checkbox>
            <br />
            <v-checkbox
              label=" understand that all fees are NON-REFUNDABLE UPON ENROLLMENT. I have read/understand this policy and I certify all entries are true and correct."
              v-model="checkbox"
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
         <v-btn color="indigo" class="white--text">Save</v-btn>
    </v-flex>

  </v-container>
</template>

<script>
  import timePicker from '../../pickers/time-picker.vue'

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



        parentsAre: '',
        livingWith: '',
        liveSchoolDays: '',
        nameOfSchool: '',
        schoolAddress: '',
        schoolProvinceId: '',
        schoolCityId: '',
        schoolZipCode: '',
        requirementsDoc: '',
        items: [
          { text: 'State 1' },
          { text: 'State 2' },
          { text: 'State 3' },
          { text: 'State 4' },
          { text: 'State 5' },
          { text: 'State 6' },
          { text: 'State 7' }
        ],
      }
    },
    components: {
      timePicker
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
      courses(){

        return this.$store.getters.courses
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
      }

    }
  }
</script>