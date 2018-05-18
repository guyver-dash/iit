<template>
	<v-container fluid fill-height>
    <v-layout>
      <v-flex xl6 lg12 md12 sm12 xs12>
        <h1>{{ authUser.firstname }} {{ authUser.lastname }}</h1>
        <v-form ref="form" v-model="valid" lazy-validation>
          <v-text-field
          v-model="authUser.firstname"
          :rules="nameRules"
          :counter="20"
          label="Firstname"
          required
          ></v-text-field>
          <v-text-field
          v-model="authUser.lastname"
          :rules="nameRules"
          :counter="20"
          label="Lastname"
          required
          ></v-text-field>
          <v-text-field
          v-model="authUser.email"
          :rules="emailRules"
          label="E-mail"
          required
          ></v-text-field>
          <roles></roles>

          <v-text-field
          label="Change password"
          hint="At least 8 characters"
          v-model="password"
          :prepend-icon= "e1 ? 'visibility' : 'visibility_off'""
          :prepend-icon-cb="() => (e1 = !e1)"
          :type="e1 ? 'password' : 'text'"
          counter
          >

        </v-text-field>
        <v-btn color="info" @click="submit">Update</v-btn>
      </v-form>
    </v-flex>
  </v-layout>
</v-container>
</template>

<script>
  import roles from '../../components/forms/selects/roles'
  export default {
    data: () => ({
      valid: true,
      e1: true,
      password: '',
      valid: false,
      name: '',
      nameRules: [
      v => !!v || 'Name is required',
      v => v.length <= 20 || 'Name must be less than 10 characters'
      ],
      email: '',
      emailRules: [
      v => !!v || 'E-mail is required',
      v => /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'E-mail must be valid'
      ]
    }),
    created(){
      let data = this
      this.$http.get(base_api + '/roles')
      .then(function(res){
        data.$store.dispatch('roles', res.data.roles)
      })
      .catch()
    },
    components: {
      roles
    },
    computed: {
      authUser(){
       return this.$store.getters.authUser
     },
      profile(){
        return this.$store.getters.profile
      },
      role(){
        return this.$store.getters.role
      }
   },
   methods: {
    submit () {
      if (this.$refs.form.validate()) {
          var data = this
          this.$http.post(base_api + '/profile-update', 
              { 'user': this.profile, 
                'roles': this.role, 
                'token': window.localStorage.getItem('tokenKey')
              })
          .then(function(res){

               data.$store.dispatch('snackbarText', 'You have successfully updated your profile!')
               data.$store.dispatch('snackbarColor', 'info')
               data.$store.dispatch('snackbar', true)
          })
          .catch(function(res){
               data.$store.dispatch('snackbarText', 'An error occured in updating your profile')
               data.$store.dispatch('snackbarColor', 'error')
               data.$store.dispatch('snackbar', true)
          })

        }
      }
    },
    watch: {
      'authUser.firstname'(val){
        this.$store.dispatch('profile', [
          'firstname', val
          ])
      },
      'authUser.lastname'(val){
        this.$store.dispatch('profile', [
          'lastname', val
          ])
      },
      'authUser.email'(val){
        this.$store.dispatch('profile', [
          'email', val
          ])
      },
      password(val){
        this.$store.dispatch('profile', [
          'password', val
          ])
      }
    }
  }
</script>
