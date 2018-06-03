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
          v-if="changePassWord == true"
          label="Change password"
          hint="At least 8 characters"
          :rules="passwordRules"
          v-model="password"
          :prepend-icon= "e1 ? 'visibility' : 'visibility_off'""
          :prepend-icon-cb="() => (e1 = !e1)"
          :type="e1 ? 'password' : 'text'"
          counter

          >
        </v-text-field>
        <v-btn color="success" @click="clickPassword()">{{passwordText}}</v-btn>
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
      changePassWord: false,
      passwordText: 'Change Password',
      valid: true,
      e1: true,
      valid: false,
      name: '',
      nameRules: [
      v => !!v || 'Name is required',
      v => v.length <= 20 || 'Name must be less than 10 characters'
      ],
      passwordRules: [
        (v) => !!v || 'Password is required',
        (v) => v.length >= 8 || 'Password must be at least 8 characters'
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
      password: {
        get(){
          return this.$store.getters.password
        },
        set(val){
          this.$store.dispatch('password', val)
        }
        
      },
      role(){
        return this.$store.getters.role
      }
   },
   methods: {
    clickPassword(){
      if (this.changePassWord == false) {
        this.changePassWord = true
        this.passwordText = 'Hide Password'
      }else{
        this.changePassWord = false
        this.passwordText = 'Change Password'
      }
    },
    submit () {
      if (this.$refs.form.validate()) {
          var data = this
          this.$http.post(base_api + '/profile-update', 
              { 'user': this.authUser, 
                'roles': this.role,
                'password': this.password,
                'token': window.localStorage.getItem('tokenKey')
              })
          .then(function(res){

               data.$store.dispatch('snackbarText', 'You have successfully updated your profile!')
               data.$store.dispatch('snackbarColor', 'success')
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
        this.$store.dispatch('authUserField', [
          'firstname', val
          ])
      },
      'authUser.lastname'(val){
        this.$store.dispatch('authUserField', [
          'lastname', val
          ])
      },
      'authUser.email'(val){
        this.$store.dispatch('authUserField', [
          'email', val
          ])
      }
    }
  }
</script>
