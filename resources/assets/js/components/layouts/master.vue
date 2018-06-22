<template>
  <v-app id="inspire">
    <v-navigation-drawer
      fixed
      :clipped="$vuetify.breakpoint.lgAndUp"
      app
      v-model="drawer"
    >
      <v-list dense>
        <template v-for="item in items">
          <v-layout
            row
            v-if="item.heading"
            align-center
            :key="item.heading"
          >
            <v-flex xs6>
              <v-subheader v-if="item.heading">
                {{ item.heading }} 
              </v-subheader>
            </v-flex>
            <v-flex xs6 class="text-xs-center">
              <a href="#!" class="body-2 black--text">EDIT</a>
            </v-flex>
          </v-layout>
          <v-list-group
            v-else-if="item.children"
            v-model="item.model"
            :key="item.text"
            :prepend-icon="item.model ? item.icon : item['icon-alt']"
            append-icon=""
          >
            <v-list-tile slot="activator">
              <v-list-tile-content>
                <v-list-tile-title>
                  {{ item.text }} 
                </v-list-tile-title>
              </v-list-tile-content>
            </v-list-tile>
            <v-list-tile
              v-for="(child, i) in item.children"
              :key="i"
              @click=""
            >
              <v-list-tile-action v-if="child.icon">
                <v-icon>{{ child.icon }}</v-icon>
              </v-list-tile-action>
              <v-list-tile-content>
                <v-list-tile-title>
                  {{ child.text }} 
                </v-list-tile-title>
              </v-list-tile-content>
            </v-list-tile>
          </v-list-group>
          <v-list-tile v-else :to="item.to" :key="item.text" @click="sidebarClick(item.text)">
            <v-list-tile-action>
              <v-icon>{{ item.icon }}</v-icon>
            </v-list-tile-action>
            <v-list-tile-content>
              <v-list-tile-title>
                {{ item.text }} 
              </v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>
        </template>
      </v-list>
    </v-navigation-drawer>
    <v-toolbar
      color="green darken-3"
      dark
      app
      :clipped-left="$vuetify.breakpoint.lgAndUp"
      fixed
    >
      <v-toolbar-title style="width: 300px" class="ml-0 pl-3 ">
        <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
        <span>IIT Cebu</span>
      </v-toolbar-title>
      
      <v-text-field
        flat
        solo-inverted
        prepend-icon="search"
        label="Search"
        class="hidden-sm-and-down"
      ></v-text-field>
      <v-spacer></v-spacer>
        <v-btn icon  v-if="userLogin"
        :to="'/profile'" 
        >
          <v-icon>account_circle</v-icon>
        </v-btn>
        <v-btn icon  v-if="userLogin" @click.stop="logout">
          <v-icon>power_settings_new</v-icon>
        </v-btn>
      <v-btn icon
         @click.stop="dialog = !dialog"
         v-if="userLogin == false"
      >
        <v-icon>lock</v-icon>
      </v-btn>
      <v-spacer></v-spacer>
    </v-toolbar>
    <v-content>

       <v-fade-transition mode="out-in">
          <v-container fluid class="ma-1 pa-0">
                <router-view></router-view>
          </v-container>
      </v-fade-transition>

    </v-content>
    <v-btn
      fab
      top
      right
      color="pink"
      dark
      fixed
      class="mr-3 hidden-xs-only"
    >
      <v-avatar size="100px" tile class="mt-4 pt-3">
          <img
            :src= "base + '/images/logos/logo.png'"
            alt="Vuetify"
          >
       </v-avatar>

    </v-btn>
    <v-dialog v-model="dialog" width="800px">
      <v-card>
        <v-card-title
          class="grey lighten-4 py-4 title"
        >
          Sign-in
        </v-card-title>
        <v-container grid-list-sm class="pa-4">
        <v-form v-model="valid" ref="login" lazy-validation>
           <v-alert :value="loginAlert" outline color="error" icon="warning" dismissible @click="loginAlert = false">
            {{ alertText }}
          </v-alert>
          <v-layout row wrap>
                <v-flex xs12 lg12 sm12 md 12 lx12>
                  <v-text-field
                    prepend-icon="mail"
                    placeholder="Email"
                    v-model="email"
                    :rules="emailRules"
                  ></v-text-field>
                </v-flex>
                <v-flex xs12 lg12 sm12 md 12 lx12>
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
                </v-flex>
          </v-layout>
         </v-form>
        </v-container>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn flat color="primary" @click="dialog = false">Cancel</v-btn>
          <v-btn flat @click="signin">Sign-in</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
    <admission></admission>
    <main-snack-bar v-bind:text="snackbarText" v-bind:color="snackbarColor"></main-snack-bar>
  </v-app>
</template>

<script>
  import admission from '../../components/dialog/admission.vue'
  import mainSnackBar from '../../components/snackbar/snackbar.vue'

  export default {
    data: () => ({
     
      e1: true,
      dialog: false,
      alertText: '',
      loginAlert: false,
      drawer: null,
      password: '',
      email: '',
       passwordRules: [
        (v) => !!v || 'Password is required',
        (v) => v.length >= 8 || 'Password must be at least 8 characters'
        ],
      emailRules: [
      (v) => !!v || 'E-mail is required',
      (v) => /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'E-mail must be valid'
      ],
      valid: true,
      base: window.base
     
    }),
    components: {
      admission, mainSnackBar
    },
    computed: {
      items(){
        return this.$store.getters.items
      },
      userLogin(){
        return this.$store.getters.userLogin
      },
      authUser(){
        return this.$store.getters.authUser
      },
      snackbarText(){
        return this.$store.getters.snackbarText
      },
      snackbarColor(){
        return this.$store.getters.snackbarColor
      }
    },
    methods: {
        sidebarClick(value){
          if(value === 'Facebook Page'){
              window.open('https://www.facebook.com/pg/iitmandaue/posts/?ref=page_internal')
              this.$router.push('/');
          }
        },
        signin(){
          var data = this
          if(this.$refs.login.validate()){
              this.$http.post(base_api + '/auth/login',{

                email: this.email,
                password: this.password
              }).then((res)=>{

                  localStorage.setItem('tokenKey', res.data.token)
                  data.$store.dispatch('authUser', res.data.user)
                  data.$store.dispatch('userLogin', true)
                  window.localStorage.setItem('userLogin', true)
                  window.localStorage.setItem('roles', res.data.roles)
                  data.dialog = false

                  data.$store.dispatch('snackbarText', 'You have successfully sign-in!')
                  data.$store.dispatch('snackbarColor', 'success')
                  data.$store.dispatch('snackbar', true)

              })
              .catch(function(error){
                data.alertText = error.response.data
                data.loginAlert = true
              })
          }
          
        },
        logout(){
          var data = this
          this.$http.get(base_api + '/auth/logout?token=' + localStorage.getItem('tokenKey'))
            .then((res) => {
               localStorage.setItem('tokenKey', res.data.result)
               data.$router.push('/')
               data.$store.dispatch('userLogin', false)
               data.$store.dispatch('snackbarText', 'You have successfully log-out!')
               data.$store.dispatch('snackbarColor', 'success')
               data.$store.dispatch('snackbar', true)
               window.localStorage.setItem('roles', null)
               window.localStorage.setItem('userLogin', false)
            })
          
        }
    },
    props: {
      source: String
    }
  }
</script>