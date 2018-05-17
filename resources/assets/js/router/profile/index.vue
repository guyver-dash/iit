<template>
	<v-container fluid fill-height>
        <v-layout>
            <v-flex xl6 lg12 md12 sm12 xs12>
    		<h1>{{ authUser.firstname }} {{ authUser.lastname }}</h1>
            <v-form v-model="valid">
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
                    name="input-10-1"
                    label="Enter your password"
                    hint="At least 8 characters"
                    v-model="password"
                    :rules="passwordRules"
                    :prepend-icon= "e1 ? 'visibility' : 'visibility_off'""
                    :prepend-icon-cb="() => (e1 = !e1)"
                    :type="e1 ? 'password' : 'text'"
                    counter
                    >
                      
                </v-text-field>
                 <v-btn color="info">Update</v-btn>
              </v-form>
              </v-flex>
          </v-layout>
	</v-container>
</template>

<script>
import roles from '../../components/forms/selects/roles'
  export default {
        data: () => ({

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
          ],
           passwordRules: [
            (v) => !!v || 'Password is required',
            (v) => v.length >= 8 || 'Password must be at least 8 characters'
            ]
        }),
        components: {
            roles
        },
    	computed: {
    		authUser(){
    			return this.$store.getters.authUser
    		}
    	}
  }
</script>
