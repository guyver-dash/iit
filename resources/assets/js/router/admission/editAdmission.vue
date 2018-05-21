<template>
	<v-container fluid fill-height>
    
    <v-form v-model="valid" ref="form" lazy-validation>
      
      <v-layout row wrap>
        <v-flex xl12 lg12 md12 sm12 xs12>
          <h3 class="headline">INSTRUCTIONS:</h3>
          <ol class="ml-4">
           <li>Student-Applicant accomplishes this Application Form properly.</li>
           <li>Fill-up information. Leave the field blank (if not applicable).</li>
           <li>Submit all the requirements as needed.</li>
         </ol>
       </v-flex>
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
        v-model="confirmedEnrolled.enrollee.course_id"
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
        v-model="confirmedEnrolled.school_year_id"
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
        v-model="confirmedEnrolled.year_level_id"
        item-value="id"
        item-text="name"
        :rules="[v => !!v || 'Please select year level.']"
        required
        ></v-select>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
        <v-select
        label="Semester"
        :items="semesters"
        v-model="confirmedEnrolled.semester_id"
        item-value="id"
        item-text="name"
        :rules="[v => !!v || 'Please select semester.']"
        required
        ></v-select>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
        <v-select
        label="Schedule"
        :items="schedules"
        v-model="confirmedEnrolled.schedule_id"
        item-value="id"
        item-text="name"
        :rules="[v => !!v || 'Please select schedule.']"
        required
        ></v-select>
      </v-flex>

      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
        <v-card  class="elevation-0">
          <v-card-text>
            
            <v-layout row wrap>
              <span class="subheading">Modular (Specify your 4 hours time range:)</span>
              <start-time></start-time>
              <end-time></end-time>
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
        v-model="confirmedEnrolled.enrollee.lastname"
        :rules="[v => !!v || 'This field is required.']"
        required
        ></v-text-field>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
        <v-text-field
        label="Firstname"
        v-model="confirmedEnrolled.enrollee.firstname"
        :rules="[v => !!v || 'This field is required.']"
        required
        ></v-text-field>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
        <v-text-field
        label="Middlename"
        :rules="[v => !!v || 'This field is required.']"
        v-model="confirmedEnrolled.enrollee.middlename"
        required
        ></v-text-field>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
        <v-text-field
        label="Suffix"
        v-model="confirmedEnrolled.enrollee.suffix"

        ></v-text-field>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
        <v-text-field
        label="Nick name"
        v-model="confirmedEnrolled.enrollee.nickname"
        ></v-text-field>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
        <v-text-field
        label="Age"
        v-model="confirmedEnrolled.enrollee.age"
        :type="'number'"
        :rules="[v => !!v || 'This field is required.']"
        required
        ></v-text-field>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
        <edit-date-picker>
          
        </edit-date-picker>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
        <v-text-field
        label="Birth Place"
        v-model="confirmedEnrolled.enrollee.birth_place"
        required
        :rules="[v => !!v || 'This field is required.']"
        ></v-text-field>
      </v-flex>
      <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
       <v-select
       label="Educational Attainment"
       :items="educAtt"
       v-model="confirmedEnrolled.enrollee.educ_at_id"
       item-value="id"
       item-text="name"
       :rules="[v => !!v || 'This field is required.']"
       required
       ></v-select>
     </v-flex>
     <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
       <v-select
       label="Sex"
       :items="sexs"
       v-model="confirmedEnrolled.enrollee.sex"
       item-value="id"
       item-text="text"
       required
       :rules="[v => !!v || 'This field is required.']"
       ></v-select>
     </v-flex>
     <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
       <v-select
       label="Civil Status"
       :items="civilStatus"
       v-model="confirmedEnrolled.enrollee.civil"
       item-value="id"
       item-text="name"
       :rules="[v => !!v || 'This field is required.']"
       required
       ></v-select>
     </v-flex>
     

     <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2"  v-if="selectedCivil == 1">
       <v-text-field
       label="Spouse lastname"
       v-model="confirmedEnrolled.enrollee.spouse_lastname"
       ></v-text-field>
     </v-flex>
     <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2" v-if="selectedCivil == 1">
      <v-text-field
      label="Spouse firstname"
      v-model="confirmedEnrolled.enrollee.spouse_firstname"
      ></v-text-field>
    </v-flex>
    <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2" v-if="selectedCivil == 1">
     <v-text-field
     label="Spouse middlename"
     v-model="confirmedEnrolled.enrollee.spouse_middlename"
     ></v-text-field>
   </v-flex>
   
   <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
     <v-text-field
     label="Landline"
     v-model="confirmedEnrolled.enrollee.landline"
     :type="'number'"
     prepend-icon="phone"
     ></v-text-field>
   </v-flex>
   <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
     <v-text-field
     label="Phone Number"
     v-model="confirmedEnrolled.enrollee.mobile"
     :type="'number'"
     :rules="[v => !!v || 'This field is required.']"
     required
     prepend-icon="phone_android"
     ></v-text-field>
   </v-flex>
   
   <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
     <v-text-field
     label="Email"
     v-model="confirmedEnrolled.enrollee.email"
     :type="'email'"
     :rules="emailRules"
     required
     prepend-icon="email"
     ></v-text-field>
   </v-flex>
   <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
     <v-text-field
     label="Religion"
     v-model="confirmedEnrolled.enrollee.religion"
     prepend-icon="pages"
     required
     :rules="[v => !!v || 'This field is required.']"
     ></v-text-field>
   </v-flex>
   <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
     <v-text-field
     label="Citizenship"
     v-model="confirmedEnrolled.enrollee.citizenship"
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
   v-model="confirmedEnrolled.enrollee.present_province_id"
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
  v-model="confirmedEnrolled.enrollee.present_city_id"
  item-text="name"
  item-value="id"
  required
  :rules="[v => !!v || 'This field is required.']"
  ></v-select>
</v-flex>
<v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
 <v-text-field
 label="Present Zipcode"
 v-model="confirmedEnrolled.enrollee.present_zipcode"
 :type="'number'"
 :rules="[v => !!v || 'This field is required.']"
 required
 ></v-text-field>
</v-flex>

<v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
  <v-text-field
  label="Present Address(House No:, street)"
  v-model="confirmedEnrolled.enrollee.present_address"
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
   v-model="confirmedEnrolled.enrollee.permanent_province_id"
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
  v-model="confirmedEnrolled.enrollee.permanent_city_id"
  item-value="id"
  item-text="name"
  :rules="[v => !!v || 'This field is required.']"
  required
  ></v-select>
</v-flex>
<v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
 <v-text-field
 label="Permanent Zipcode"
 v-model="confirmedEnrolled.enrollee.permanent_zipcode"
 :type="'number'"
 :rules="[v => !!v || 'This field is required.']"
 required
 ></v-text-field>
</v-flex>
<v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
  <v-text-field
  label="Permanent Address(House No:, street)"
  v-model="confirmedEnrolled.enrollee.permanent_address"
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
    v-model="confirmedEnrolled.enrollee.father_lastname"
    :rules="[v => !!v || 'This field is required.']"
    required
    ></v-text-field>
  </v-flex>
  <v-flex xl2 lg2 md2 sm6 xs12 class="pa-2">
    <v-text-field
    label="Father's firstname"
    v-model="confirmedEnrolled.enrollee.father_firstname"
    :rules="[v => !!v || 'This field is required.']"
    required
    ></v-text-field>
  </v-flex>
  <v-flex xl2 lg2 md2 sm6 xs12 class="pa-2">
    <v-text-field
    label="Father's middlename"
    v-model="confirmedEnrolled.enrollee.father_middlename"
    :rules="[v => !!v || 'This field is required.']"
    required
    ></v-text-field>
  </v-flex>
  <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
    <v-text-field
    label="Occupation"
    v-model="confirmedEnrolled.enrollee.father_occupation"
    :rules="[v => !!v || 'This field is required.']"
    required
    ></v-text-field>
  </v-flex>
  <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
    <v-text-field
    label="Contact Number"
    v-model="confirmedEnrolled.enrollee.father_contact_number"
    :type="'number'"

    ></v-text-field>
  </v-flex>
  
  <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
   <v-select
   label="Province"
   :items="provinces"
   v-model="confirmedEnrolled.enrollee.father_province_id"
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
  v-model="confirmedEnrolled.enrollee.father_city_id"
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
 v-model="confirmedEnrolled.enrollee.father_zipcode"
 :type="'number'"
 :rules="[v => !!v || 'This field is required.']"
 required
 ></v-text-field>
</v-flex>
<v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
  <v-text-field
  label="Present Address(House No:, street)"
  v-model="confirmedEnrolled.enrollee.father_address"
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
    v-model="confirmedEnrolled.enrollee.mother_lastname"
    :rules="[v => !!v || 'This field is required.']"
    required
    ></v-text-field>
  </v-flex>
  <v-flex xl2 lg2 md2 sm6 xs12 class="pa-2">
    <v-text-field
    label="Mother's firstname"
    v-model="confirmedEnrolled.enrollee.mother_firstname"
    :rules="[v => !!v || 'This field is required.']"
    required
    ></v-text-field>
  </v-flex>
  <v-flex xl2 lg2 md2 sm6 xs12 class="pa-2">
    <v-text-field
    label="Mother's middlename"
    v-model="confirmedEnrolled.enrollee.mother_middlename"
    :rules="[v => !!v || 'This field is required.']"
    required
    ></v-text-field>
  </v-flex>
  <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
    <v-text-field
    label="Occupation"
    v-model="confirmedEnrolled.enrollee.mother_occupation"
    :rules="[v => !!v || 'This field is required.']"
    required
    ></v-text-field>
  </v-flex>
  <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
    <v-text-field
    label="Contact Number"
    v-model="confirmedEnrolled.enrollee.mother_contact_number"
    :type="'number'"
    ></v-text-field>
  </v-flex>
  
  <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
   <v-select
   autocomplete
   label="Province"
   :items="provinces"
   v-model="confirmedEnrolled.enrollee.mother_province_id"
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
  v-model="confirmedEnrolled.enrollee.mother_city_id"
  item-value="id"
  item-text="name"
  :rules="[v => !!v || 'This field is required.']"
  required
  ></v-select>
</v-flex>
<v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
 <v-text-field
 label="Zipcode"
 v-model="confirmedEnrolled.enrollee.mother_zipcode"
 :type="'number'"
 :rules="[v => !!v || 'This field is required.']"
 required
 ></v-text-field>
</v-flex>
<v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
  <v-text-field
  label="Present Address(House No:, street)"
  v-model="confirmedEnrolled.enrollee.mother_address"
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
    <v-chip close  v-for="(sibling, i) in confirmedEnrolled.enrollee.siblings" :key="i" @input="removeSibling(i)">{{ sibling.name }}</v-chip>
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
    v-model="confirmedEnrolled.enrollee.name_of_school"
    :rules="[v => !!v || 'This field is required.']"
    required
    ></v-text-field>
  </v-flex>
  
  
  <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
   <v-select
   label="Province"
   :items="provinces"
   v-model="confirmedEnrolled.enrollee.school_province_id"
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
  v-model="confirmedEnrolled.enrollee.school_city_id"
  item-value="id"
  item-text="name"
  required
  :rules="[v => !!v || 'This field is required.']"
  ></v-select>
</v-flex>
<v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
 <v-text-field
 label="Zipcode"
 v-model="confirmedEnrolled.enrollee.school_zipcode"
 :type="'number'"
 :rules="[v => !!v || 'This field is required.']"
 required
 ></v-text-field>
</v-flex>
<v-flex xl3 lg3 md3 sm6 xs12 class="pa-2">
  <v-text-field
  label="Present Address(House No:, street)"
  v-model="confirmedEnrolled.enrollee.school_address"
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
            :label="'My parents are:'"
            :items="questions1"
            item-value="id"
            item-text="text"
            v-model="answer1"
            >
        </v-select>
   
  </v-flex>
  <v-flex xl4 lg4 md4 sm6 xs12 class="pa-2">
        <v-select
            :label="'Who are you living with:'"
            :items="questions2"
            item-value="id"
            item-text="text"
            v-model="answer2"
            >
        </v-select>
   
  </v-flex>
  <v-flex xl4 lg4 md4 sm6 xs12 class="pa-2">
        <v-select
            :label="'Who are you living with:'"
            :items="questions3"
            item-value="id"
            item-text="text"
            v-model="answer3"
            >
        </v-select>
   
  </v-flex>
  
</v-layout>


<v-divider></v-divider>
<v-flex xl12>
  <br />
  <span class="subheading">REQUIREMENTS: (Please check the documents submitted)</span>
</v-flex>
<v-layout row wrap>
  
  <v-flex xl3 lg3 md3 sm6 xs12 class="pa-2" v-for="requirement in requirements" :key="requirement.id">
    <v-select
    :label="requirement.name"
    :items="requirement.requirements_doc"
    v-model="requirementsDocs"
    item-value="id"
    item-text="name"
    multiple
    ></v-select>
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
</v-container>
</template>
<script>
  import startTime from '../../components/pickers/start-time.vue'
  import endTime from '../../components/pickers/end-time.vue'
  import editDatePicker from '../../components/pickers/edit-date-picker.vue'

  export default {
    data () {
      return {
        questions1: [
          {id: 1, text: 'Living Together'},
          {id: 2, text: 'Father/Mother working abroad'},
          {id: 3, text: 'Separated'},
          {id: 4, text: 'Deceased Mother/Father'},
        ],
        answer1: '',
        questions2: [
          {id: 5, text: 'Parents/in law'},
          {id: 6, text: 'Stepfather/Stepmother'},
          {id: 7, text: 'Guardians/Relatives'},
          {id: 8, text: 'Spoused'},
        ],
        answer2: '',
        questions3: [
          {id: 9, text: 'Parents/in law'},
          {id: 10, text: 'Stepfather/Stepmother'},
          {id: 11, text: 'Guardians/Relatives'},
          {id: 12, text: 'Spoused'},
        ],
        answer3: '',
        questionSecond: 6,
        questionThird: 9,
        date:null,
        checkbox: '',
        birthplace: '',
        selectedEducAtt: '',
        sexs:[
            {id: 1, text: 'Male'}, 
            {id: 2, text: 'Female'}
        ]
        ,
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
        emailRules: [
        (v) => !!v || 'E-mail is required',
        (v) => /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'E-mail must be valid'
        ]
      }
    },
    components: {
      startTime, endTime, editDatePicker
    },
    created(){
      let data = this
      this.$http
      .get(base_api + '/start-up')
      .then(function(response){
        data.$store.dispatch('courses', response.data.courses)
        data.$store.dispatch('provinces', response.data.provinces)
        data.$store.dispatch('schoolYears', response.data.schoolYears)
        data.$store.dispatch('yearLevel', response.data.yearLevels)
        data.$store.dispatch('schedules', response.data.schedules)
        data.$store.dispatch('semesters', response.data.semesters)
        data.$store.dispatch('questions', response.data.questions)
        data.$store.dispatch('requirements', response.data.requirements)
        data.$store.dispatch('policies', response.data.policies)
        data.$store.dispatch('civilStatus', response.data.civilStatus)
        data.$store.dispatch('educAtt', response.data.educAtt)
      }) 

      this.$http.get(base_api + '/confirm-enrolled/' + this.$route.params.id)
        .then(function(res){

            data.$store.dispatch('confirmedEnrolled',  res.data.enrollee)

                for (var i=0; res.data.enrollee.enrollee.answers.length -1 >= i; i++){
                    if(res.data.enrollee.enrollee.answers[i].question.id === 1){
                      data.answer1 = res.data.enrollee.enrollee.answers[i].id
                      }
                      if(res.data.enrollee.enrollee.answers[i].question.id === 2){
                          data.answer2 = res.data.enrollee.enrollee.answers[i].id
                      }
                      if(res.data.enrollee.enrollee.answers[i].question.id === 3){
                          data.answer3 = res.data.enrollee.enrollee.answers[i].id
                      }
                }

              // data.requirementsDocs = res.data.enrollee.enrollee.requirementsDocs.map(a=>{a.id})
              // console.log(data.requirementsDocs)
            
        })
        
    },
    computed: {
      confirmedEnrolled(){
        return this.$store.getters.confirmedEnrolled
      },
      
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
      questionEnrollee(questionId, index){
        console.log(questionId, index)
         
      },
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
          this.$store.dispatch('snackbarText', 'Sibling fields are required!')
          this.$store.dispatch('snackbarColor', 'error')
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

       var data = this
       if (this.siblingName != '' && this.siblingAge != '' && this.siblingOcc != '' && this.siblingNameOfSchool != '') {
        this.addSibling()
      }


      if (this.$refs.form.validate()) {
        
       
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

          data.$store.dispatch('snackbarText', 'Registration completed!')
          data.$store.dispatch('snackbarColor', 'success')
          data.$store.dispatch('snackbar', true)
        })
        
      }else{
        data.$store.dispatch('snackbarText', 'Please correct some errors!')
        data.$store.dispatch('snackbarColor', 'error')
        data.$store.dispatch('snackbar', true)

      }
    },
  },
  watch: {

    'confirmedEnrolled.enrollee.present_province_id' : function(){
      var data = this
      this.$http.get(base_api + '/cities/' + this.confirmedEnrolled.enrollee.present_province_id)
      .then(function(res){
        data.presentCities = res.data.cities
      })
    },
    'confirmedEnrolled.enrollee.present_city_id' : function(){
      var data = this
      this.$http.get(base_api + '/get-city-zipcode/' + this.confirmedEnrolled.enrollee.present_city_id)
      .then(function(res){
        data.presentZipCode = res.data.city.zipcode
      })
    },
    'confirmedEnrolled.enrollee.permanent_province_id': function(){
      var data = this
      this.$http.get(base_api + '/cities/' + this.confirmedEnrolled.enrollee.permanent_province_id)
      .then(function(res){
        data.permanentCities = res.data.cities
      })

    },
    'confirmedEnrolled.enrollee.permanent_city_id': function(){
      var data = this
      this.$http.get(base_api + '/get-city-zipcode/' + this.confirmedEnrolled.enrollee.permanent_city_id)
      .then(function(res){
        data.permanentZipCode = res.data.city.zipcode
      })
    },
    'confirmedEnrolled.enrollee.father_province_id': function(){
      var data = this
      this.$http.get(base_api + '/cities/' + this.confirmedEnrolled.enrollee.father_province_id)
      .then(function(res){
        data.fatherCities = res.data.cities
      })
    },
    'confirmedEnrolled.enrollee.father_city_id': function(){
      var data = this
      this.$http.get(base_api + '/get-city-zipcode/' + this.confirmedEnrolled.enrollee.father_city_id)
      .then(function(res){
        data.fatherZipCode = res.data.city.zipcode
      })
    },
    'confirmedEnrolled.enrollee.mother_province_id': function(){
      var data = this
      this.$http.get(base_api + '/cities/' + this.confirmedEnrolled.enrollee.mother_province_id)
      .then(function(res){
        data.motherCities = res.data.cities
      })
    },
    'confirmedEnrolled.enrollee.mother_city_id': function(){
      var data = this
      this.$http.get(base_api + '/get-city-zipcode/' + this.confirmedEnrolled.enrollee.mother_city_id)
      .then(function(res){
        data.motherZipCode = res.data.city.zipcode
      })
    },
    'confirmedEnrolled.enrollee.school_province_id': function(){
      var data = this
      this.$http.get(base_api + '/cities/' + this.confirmedEnrolled.enrollee.school_province_id)
      .then(function(res){
        data.schoolCities = res.data.cities
      })
    },
    'confirmedEnrolled.enrollee.school_city_id': function(){
      var data = this
      this.$http.get(base_api + '/get-city-zipcode/' + this.confirmedEnrolled.enrollee.school_city_id)
      .then(function(res){
        data.schoolZipCode = res.data.city.zipcode
      })
    },
    

  }
}
</script>