<template>
      <v-flex xl12 lg12 md12 sm12 xs12>
        <v-select
          :items="courses"
          v-model="course"
          label="Apply Balance"
          multiple
          chips
          item-text="name"
          item-value="id"
        ></v-select>
      </v-flex>
</template>
<script>
  export default {
    data: ()=>({
      course:[]
    }),
    computed: {
      courses: {
        get(){
          return this.$store.getters.courses
        }
        
      }
    },
    watch: {
      course(val){
         this.$store.dispatch('course_ids', val)
      }
    }
  }
</script>