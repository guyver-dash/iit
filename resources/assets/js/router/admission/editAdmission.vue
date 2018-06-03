<template>
	<v-container fluid fill-height>
    
    <v-form v-model="valid" ref="form" lazy-validation>
      
      <v-layout row wrap>
        
       <v-flex xl6 lg6 md6 sm6 xs6>
          <v-layout row wrap>
            <v-flex xl11 lg11 md11 sm11 xs11>
               <h1 class="pa-2">Edit Enrollee</h1>
            </v-flex>
            <v-flex xl5 lg5 md5 sm5 xs5 class='mr-2'>
              <v-switch
                label="Enrollee Status"
                v-model="confirmedEnrolled.status"
              ></v-switch>
            </v-flex>
            <v-flex xl6 lg6 md6 sm6 xs6 class='mr-2'>
              <v-select
                label="Student Type"
                :items="studentType"
                v-model="confirmedEnrolled.enrollee.student_type_id"
                item-text="name"
                item-value="id"
                :rules="[v => !!v || 'Please select a student type.']"
                required
                ></v-select>
            </v-flex>
            <v-flex xl6 lg6 md6 sm6 xs6 class='mr-2'>
              <v-text-field
              label="LRN"
              :type="'number'"
              v-model="confirmedEnrolled.enrollee.lrn"
              ></v-text-field>
            </v-flex>
            <v-flex xl5 lg5 md5 sm5 xs5>
              <v-text-field
              label="ID Number:"
              v-model="confirmedEnrolled.enrollee.idno"
              ></v-text-field>
            </v-flex>
          </v-layout>
       </v-flex>
       <v-flex xl6 lg6 md6 sm6 xs6 class="pl-3 pb-3 mt-0">
           <v-text-field
                v-model="confirmedEnrolled.enrollee.remarks"
                label="Remarks"
                textarea
              ></v-text-field>
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
        v-model="confirmedEnrolled.enrollee.admissionNo"
        
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
              <edit-start-time></edit-start-time>
              <edit-end-time></edit-end-time>
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
       v-model="confirmedEnrolled.enrollee.civil_id"
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
    input-value="true"
   required
   class="ma-0 pa-0"
   ></v-checkbox> 
   <br />
   <v-checkbox
   label="I understand that all fees are NON-REFUNDABLE UPON ENROLLMENT. I have read/understand this policy and I certify all entries are true and correct."
   v-model="policy2"
   :rules="[v => !!v || 'You must agree to continue!']"
    input-value="true"
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
  import editStartTime from '../../components/pickers/edit-start-time.vue'
  import editEndTime from '../../components/pickers/edit-end-time.vue'
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
        policy1: true,
        policy2: true,
        valid: true,
        emailRules: [
        (v) => !!v || 'E-mail is required',
        (v) => /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'E-mail must be valid'
        ]
      }
    },
    components: {
      editStartTime, editEndTime, editDatePicker
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
        data.$store.dispatch('studentType', response.data.studentType)
      }) 

      this.$http.get(base_api + '/confirm-enrolled/' + this.$route.params.id + '?token=' + window.localStorage.getItem('tokenKey'))
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
              data.requirementsDocs = res.data.enrollee.enrollee.requirements_doc.map(function(req){
                  return req.id
              })
            
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
      },
      studentType(){

        return this.$store.getters.studentType
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
         
          this.$store.dispatch('addSiblingEdit', {
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
        this.$store.dispatch('removeSiblingEdit', index)
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
        
       
        this.$http.put(base_api + '/confirm-enrolled/' + this.$route.params.id , {
          confirmedEnrolled: this.confirmedEnrolled,
          requirementsDocs: this.requirementsDocs,
          token: localStorage.getItem('tokenKey')
          
          
        })
        .then(function(res){

          data.$store.dispatch('snackbarText', 'Updated Successfully!')
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
    'confirmedEnrolled.enrollee.remarks': function(val){
      this.$store.dispatch('confirmedEnrolledEnrollee', {
          'field' : 'remarks',
          'value' : val
      })
    },
    'confirmedEnrolled.enrollee.student_type_id': function(val){
      this.$store.dispatch('confirmedEnrolledEnrollee', {
          'field' : 'student_type_id',
          'value' : val
      })
    },
    'confirmedEnrolled.enrollee.lrn': function(val){
      this.$store.dispatch('confirmedEnrolledEnrollee', {
          'field' : 'lrn',
          'value' : val
      })
    },
    'confirmedEnrolled.enrollee.idno': function(val){
      this.$store.dispatch('confirmedEnrolledEnrollee', {
          'field' : 'idno',
          'value' : val
      })
    },
    'confirmedEnrolled.status': function(val){
      this.$store.dispatch('confirmedEnrolledEnrollee', {
          'field' : 'status',
          'value' : val
      })
    },
     'confirmedEnrolled.enrollee.course_id': function(val){
      this.$store.dispatch('confirmedEnrolledEnrollee', {
          'field' : 'course_id',
          'value' : val
      })
    },
    'confirmedEnrolled.school_year_id': function(val){
      this.$store.dispatch('confirmedEnrolledEnrollee', {
          'field' : 'school_year_id',
          'value' : val
      })
    },
    'confirmedEnrolled.year_level_id': function(val){
      this.$store.dispatch('confirmedEnrolledEnrollee', {
          'field' : 'year_level_id',
          'value' : val
      })
    },
    'confirmedEnrolled.semester_id': function(val){
      this.$store.dispatch('confirmedEnrolledEnrollee', {
          'field' : 'semester_id',
          'value' : val
      })
    },
    'confirmedEnrolled.schedule_id': function(val){
      this.$store.dispatch('confirmedEnrolledEnrollee', {
          'field' : 'schedule_id',
          'value' : val
      })
    },
    'confirmedEnrolled.enrollee.lastname': function(val){
      this.$store.dispatch('confirmedEnrolledEnrollee', {
          'field' : 'lastname',
          'value' : val
      })
    },
    'confirmedEnrolled.enrollee.firstname': function(val){
      this.$store.dispatch('confirmedEnrolledEnrollee', {
          'field' : 'firstname',
          'value' : val
      })
    },
    'confirmedEnrolled.enrollee.middlename': function(val){
      this.$store.dispatch('confirmedEnrolledEnrollee', {
          'field' : 'middlename',
          'value' : val
      })
    },
    'confirmedEnrolled.enrollee.suffix': function(val){
      this.$store.dispatch('confirmedEnrolledEnrollee', {
          'field' : 'suffix',
          'value' : val
      })
    },
    'confirmedEnrolled.enrollee.nickname': function(val){
      this.$store.dispatch('confirmedEnrolledEnrollee', {
          'field' : 'nickname',
          'value' : val
      })
    },
    'confirmedEnrolled.enrollee.age': function(val){
      this.$store.dispatch('confirmedEnrolledEnrollee', {
          'field' : 'age',
          'value' : val
      })
    },
    'confirmedEnrolled.enrollee.birth_place': function(val){
      this.$store.dispatch('confirmedEnrolledEnrollee', {
          'field' : 'birth_place',
          'value' : val
      })
    },  
    'confirmedEnrolled.enrollee.educ_at_id': function(val){
      this.$store.dispatch('confirmedEnrolledEnrollee', {
          'field' : 'educ_at_id',
          'value' : val
      })
    },
    'confirmedEnrolled.enrollee.sex': function(val){
      this.$store.dispatch('confirmedEnrolledEnrollee', {
          'field' : 'sex',
          'value' : val
      })
    },
    
    'confirmedEnrolled.enrollee.civil_id': function(val){
      this.$store.dispatch('confirmedEnrolledEnrollee', {
          'field' : 'civil_id',
          'value' : val
      })
    },
    'confirmedEnrolled.enrollee.landline': function(val){
      this.$store.dispatch('confirmedEnrolledEnrollee', {
          'field' : 'landline',
          'value' : val
      })
    },
    'confirmedEnrolled.enrollee.spouse_lastname': function(val){
      this.$store.dispatch('confirmedEnrolledEnrollee', {
          'field' : 'spouse_lastname',
          'value' : val
      })
    },
    'confirmedEnrolled.enrollee.spouse_firstname': function(val){
      this.$store.dispatch('confirmedEnrolledEnrollee', {
          'field' : 'spouse_firstname',
          'value' : val
      })
    },
    'confirmedEnrolled.enrollee.spouse_middlename': function(val){
      this.$store.dispatch('confirmedEnrolledEnrollee', {
          'field' : 'spouse_middlename',
          'value' : val
      })
    },

    'confirmedEnrolled.enrollee.mobile': function(val){
      this.$store.dispatch('confirmedEnrolledEnrollee', {
          'field' : 'mobile',
          'value' : val
      })
    },
     'confirmedEnrolled.enrollee.email': function(val){
      this.$store.dispatch('confirmedEnrolledEnrollee', {
          'field' : 'email',
          'value' : val
      })
    },
    'confirmedEnrolled.enrollee.religion': function(val){
      this.$store.dispatch('confirmedEnrolledEnrollee', {
          'field' : 'religion',
          'value' : val
      })
    },
    'confirmedEnrolled.enrollee.citizenship': function(val){
      this.$store.dispatch('confirmedEnrolledEnrollee', {
          'field' : 'citizenship',
          'value' : val
      })
    },
    'confirmedEnrolled.enrollee.present_province_id' : function(val){
      var data = this
      this.$http.get(base_api + '/cities/' + val)
      .then(function(res){
        data.presentCities = res.data.cities
      })
       this.$store.dispatch('confirmedEnrolledEnrollee', {
          'field' : 'present_province_id',
          'value' : val
      })
    },
    'confirmedEnrolled.enrollee.present_city_id' : function(val){
      var data = this
      this.$http.get(base_api + '/get-city-zipcode/' + val)
      .then(function(res){
        data.$store.dispatch('confirmedEnrolledEnrollee', {
          'field' : 'present_zipcode',
          'value' : res.data.city.zipcode
        })
      })
      this.$store.dispatch('confirmedEnrolledEnrollee', {
          'field' : 'present_city_id',
          'value' : val
      })
      
    },
    'confirmedEnrolled.enrollee.present_address': function(val){
      this.$store.dispatch('confirmedEnrolledEnrollee', {
          'field' : 'present_address',
          'value' : val
      })
    },
    'confirmedEnrolled.enrollee.permanent_province_id': function(val){
      var data = this
      this.$http.get(base_api + '/cities/' + val)
      .then(function(res){
        data.permanentCities = res.data.cities
      })
      this.$store.dispatch('confirmedEnrolledEnrollee', {
          'field' : 'permanent_province_id',
          'value' : val
      })

    },
    'confirmedEnrolled.enrollee.permanent_city_id': function(val){
      var data = this
      this.$http.get(base_api + '/get-city-zipcode/' + val)
      .then(function(res){
        data.$store.dispatch('confirmedEnrolledEnrollee', {
          'field' : 'permanent_zipcode',
          'value' : res.data.city.zipcode
        })
        
      })
      this.$store.dispatch('confirmedEnrolledEnrollee', {
          'field' : 'permanent_city_id',
          'value' : val
        })
    },
    'confirmedEnrolled.enrollee.permanent_address': function(val){
      this.$store.dispatch('confirmedEnrolledEnrollee', {
          'field' : 'permanent_address',
          'value' : val
      })
    },
    'confirmedEnrolled.enrollee.father_lastname': function(val){
      this.$store.dispatch('confirmedEnrolledEnrollee', {
          'field' : 'father_lastname',
          'value' : val
      })
    },
    'confirmedEnrolled.enrollee.father_firstname': function(val){
      this.$store.dispatch('confirmedEnrolledEnrollee', {
          'field' : 'father_firstname',
          'value' : val
      })
    },
    'confirmedEnrolled.enrollee.father_middlename': function(val){
      this.$store.dispatch('confirmedEnrolledEnrollee', {
          'field' : 'father_middlename',
          'value' : val
      })
    },
    'confirmedEnrolled.enrollee.father_occupation': function(val){
      this.$store.dispatch('confirmedEnrolledEnrollee', {
          'field' : 'father_occupation',
          'value' : val
      })
    },
     'confirmedEnrolled.enrollee.father_contact_number': function(val){
      this.$store.dispatch('confirmedEnrolledEnrollee', {
          'field' : 'father_contact_number',
          'value' : val
      })
    },

    'confirmedEnrolled.enrollee.father_province_id': function(val){
      var data = this
      this.$http.get(base_api + '/cities/' + val)
      .then(function(res){
        data.fatherCities = res.data.cities
      })
      this.$store.dispatch('confirmedEnrolledEnrollee', {
          'field' : 'father_province_id',
          'value' : val
      })

    },
    'confirmedEnrolled.enrollee.father_city_id': function(val){
      var data = this
      this.$http.get(base_api + '/get-city-zipcode/' + val)
      .then(function(res){
        data.$store.dispatch('confirmedEnrolledEnrollee', {
          'field' : 'father_zipcode',
          'value' : res.data.city.zipcode
        })
        
      })
      this.$store.dispatch('confirmedEnrolledEnrollee', {
          'field' : 'father_city_id',
          'value' : val
        })
    },
    'confirmedEnrolled.enrollee.father_address': function(val){
      this.$store.dispatch('confirmedEnrolledEnrollee', {
          'field' : 'father_address',
          'value' : val
      })
    },
    'confirmedEnrolled.enrollee.mother_firstname': function(val){
      this.$store.dispatch('confirmedEnrolledEnrollee', {
          'field' : 'mother_firstname',
          'value' : val
      })
    },
    'confirmedEnrolled.enrollee.mother_lastname': function(val){
      this.$store.dispatch('confirmedEnrolledEnrollee', {
          'field' : 'mother_lastname',
          'value' : val
      })
    },
    'confirmedEnrolled.enrollee.mother_middlename': function(val){
      this.$store.dispatch('confirmedEnrolledEnrollee', {
          'field' : 'mother_middlename',
          'value' : val
      })
    },
    'confirmedEnrolled.enrollee.mother_occupation': function(val){
      this.$store.dispatch('confirmedEnrolledEnrollee', {
          'field' : 'mother_occupation',
          'value' : val
      })
    },
    'confirmedEnrolled.enrollee.mother_contact_number': function(val){
      this.$store.dispatch('confirmedEnrolledEnrollee', {
          'field' : 'mother_contact_number',
          'value' : val
      })
    },

    'confirmedEnrolled.enrollee.mother_province_id': function(val){
      var data = this
      this.$http.get(base_api + '/cities/' + val)
      .then(function(res){
        data.motherCities = res.data.cities
      })
      this.$store.dispatch('confirmedEnrolledEnrollee', {
          'field' : 'mother_province_id',
          'value' : val
      })

    },
    'confirmedEnrolled.enrollee.mother_city_id': function(val){
      var data = this
      this.$http.get(base_api + '/get-city-zipcode/' + val)
      .then(function(res){
        data.$store.dispatch('confirmedEnrolledEnrollee', {
          'field' : 'mother_zipcode',
          'value' : res.data.city.zipcode
        })
        
      })
      this.$store.dispatch('confirmedEnrolledEnrollee', {
          'field' : 'mother_city_id',
          'value' : val
        })
    },
    'confirmedEnrolled.enrollee.mother_address': function(val){
      this.$store.dispatch('confirmedEnrolledEnrollee', {
          'field' : 'mother_address',
          'value' : val
      })
    },

    'confirmedEnrolled.enrollee.name_of_school': function(val){
      this.$store.dispatch('confirmedEnrolledEnrollee', {
          'field' : 'name_of_school',
          'value' : val
      })
    },
    'confirmedEnrolled.enrollee.school_province_id': function(val){
        var data = this
        this.$http.get(base_api + '/cities/' + val)
        .then(function(res){
          data.schoolCities = res.data.cities
        })
        this.$store.dispatch('confirmedEnrolledEnrollee', {
            'field' : 'school_province_id',
            'value' : val
        })

    },
    'confirmedEnrolled.enrollee.school_city_id': function(val){
      var data = this
      this.$http.get(base_api + '/get-city-zipcode/' + val)
      .then(function(res){
        data.$store.dispatch('confirmedEnrolledEnrollee', {
          'field' : 'school_zipcode',
          'value' : res.data.city.zipcode
        })
        
      })
      this.$store.dispatch('confirmedEnrolledEnrollee', {
          'field' : 'school_city_id',
          'value' : val
        })
    },
    'confirmedEnrolled.enrollee.school_address': function(val){
      this.$store.dispatch('confirmedEnrolledEnrollee', {
          'field' : 'school_address',
          'value' : val
      })
    },
    answer1:function(val){
      this.$store.dispatch('answersEdit',{
        'index': 0,
        'value' : val
      });
    },
    answer2:function(val){
      this.$store.dispatch('answersEdit',{
        'index': 1,
        'value' : val
      });
    },
    answer3:function(val){
      this.$store.dispatch('answersEdit',{
        'index': 2,
        'value' : val
      });
    }
  }
}
</script>