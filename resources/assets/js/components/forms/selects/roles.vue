<template>
      <v-flex xl12 lg12 md12 sm12 xs12>
        <v-select
          :items="roles"
          v-model="role"
          label="Select Roles"
          multiple
          chips
          item-text="name"
          item-value="id"
          hint="User Roles"
          persistent-hint
        ></v-select>
      </v-flex>
</template>
<script>
  export default {
    computed: {
      roles(){
        return this.$store.getters.roles
      },
      role: {
        get(){
          return this.$store.getters.role
        },
        set(val){
          this.$store.dispatch('role', val)
        }
        
      }
    }
  }
</script>