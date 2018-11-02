<template>
  <div>
    <v-dialog v-model="dialog3" max-width="500px">
      <v-card>
        <v-card-title>
          <span class="headline">
            New Balance
          </span>
        </v-card-title>
        <v-card-text>
          <v-container grid-list-md>
            <v-layout wrap>

              <v-flex xs12 sm12 md12 lg12 xl12>
                <v-text-field type="text" 
                label="Balance Name" 
                v-model="balanceName" 
                />
              </v-text-field>
            </v-flex>
            <v-flex xs12 sm12 md12 lg12 xl12>
              <my-currency-input v-model="balanceAmount" v-bind:label="'Amount'"></my-currency-input>
            </v-flex>
          </v-layout>
        </v-container>
      </v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn color="blue darken-1" flat @click.native="close">Cancel</v-btn>
        <v-btn color="blue darken-1" flat @click.native="save()">Save</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
  <v-dialog v-model="dialog2" max-width="500px">
    <v-card>
      <v-card-title>
        <span class="headline">
          Edit Balance
        </span>
      </v-card-title>
      <v-card-text>
        <v-container grid-list-md>
          <v-layout wrap>

            <v-flex xs12 sm12 md12 lg12 xl12>
              <v-text-field type="text" 
              label="Balance Name" 
              v-model="editBalance.name" 
              />
            </v-text-field>
          </v-flex>
          <v-flex xs12 sm12 md12 lg12 xl12>
            <my-currency-input v-model="editBalance.amount" v-bind:label="'Amount'"></my-currency-input>
          </v-flex>
        </v-layout>
      </v-container>
    </v-card-text>
    <v-card-actions>
      <v-spacer></v-spacer>
      <v-btn color="blue darken-1" flat @click.native="close">Cancel</v-btn>
      <v-btn color="blue darken-1" flat @click.native="update()">Update</v-btn>
    </v-card-actions>
  </v-card>
</v-dialog>
<v-dialog v-model="dialog" max-width="500px">
  <v-card>
    <v-card-title>
      <span class="headline">
        Attach Enrollee
      </span>
    </v-card-title>
    <v-card-text>
      <v-container grid-list-md>
        <v-layout wrap>
          <v-flex xs12 >
            <school-years></school-years>
          </v-flex>
          <v-flex xs12 >
            <semester-select></semester-select>
          </v-flex>
          <enrollees></enrollees>
          <v-flex xs12 >
            <my-currency-input v-model="discount" v-bind:label="'Discount Amount'"></my-currency-input>
          </v-flex>
          <courses></courses>
        </v-layout>
      </v-container>
    </v-card-text>
    <v-card-actions>
      <v-spacer></v-spacer>
      <v-btn color="blue darken-1" flat @click.native="close">Cancel</v-btn>
      <v-btn color="blue darken-1" flat @click.native="attachEnrollee()">Save</v-btn>
    </v-card-actions>
  </v-card>
</v-dialog>
<v-data-table
:headers="headers"
:items="balancesData"
hide-actions
class="elevation-1"
>
<template slot="items" slot-scope="props">
  <td>{{ props.item.name }}</td>
  <td>{{ props.item.amount|currency('₱ ') }}</td>
  <td>

    <v-tooltip bottom> 
      <v-btn slot="activator" icon class="mx-0" @click="addNewStudent(props.item.id)">
        <v-icon color="grey">add</v-icon>
      </v-btn>
      <span>Add New Student</span>
    </v-tooltip>
    <v-tooltip bottom> 
      <v-btn slot="activator" icon class="mx-0" @click="editItem(props.item.id)">
        <v-icon color="success">mode_edit</v-icon>
      </v-btn>
      <span>Edit Balance</span>
    </v-tooltip>
    <v-tooltip bottom>
      <v-btn slot="activator" icon class="mx-0" @click="balanceEnrollee(props.item.id)">
        <v-icon color="info">assignment</v-icon>
      </v-btn>
      <span>View Attach Enrollee</span>
    </v-tooltip>
    <v-tooltip bottom>
      <v-btn slot="activator" icon class="mx-0" @click="deleteItem(props.item.id)">
        <v-icon color="pink">delete</v-icon>
      </v-btn>
      <span>Delete Balance</span>
    </v-tooltip>

  </td>
</template>

</v-data-table>
<div class="text-xs-center pt-2">
  <v-pagination v-model="page" :length="balances.last_page"></v-pagination>
</div>
</div>
</template>
<script>
  import myCurrencyInput from '../../components/currency-format/my-currency-input'
  import courses from '../../components/forms/selects/courses.vue'
  import enrollees from '../../components/forms/selects/enrollees.vue'


  import semesterSelect from '../../components/select/semester'
  import schoolYears from '../../components/select/schoolYears'

  import _ from 'lodash'
  export default {
    props:['confirmid'],
    components: {
      myCurrencyInput, courses, enrollees, semesterSelect, schoolYears
    },
    data: () => ({
      balanceId: null,
      input: '',
      chosenStudent: '',
      searchStudent: [

      ],
      dialog3: false,
      discount: 0,
      balanceName: '',
      balanceAmount: 0,
      editBalance: {
        name: '',
        amount: 0
      },
      price: 0,
      dialog: false,
      dialog2: false,
      isInputActive: false,
      paidAmount: '',
      headers: [
      {
        text: 'Name',
        align: 'left',
        sortable: false,
        value: 'name'
      },
      { 
        text: 'Amount', 
        value: 'amount',
        align: 'left',
        sortable: false,
      },
      { 
        text: 'Action', 
        value: 'action',
        align: 'left',
        sortable: false,
      }
      ],
      
    }),

    computed: {
      confirmEnrolledId(){
        return this.$store.getters.confirmEnrolledId
      },
      balancesData(){
        return _.values(this.$store.getters.balances.data)
      },
      balances(){
        return this.$store.getters.balances
      },
      course_ids(){
        return this.$store.getters.course_ids
      },
      confirmEnrolledPayment(){
        return this.$store.getters.confirmEnrolledPayment
      },
      name(){
        if (this.$store.getters.confirmEnrolledPayment != null) {
          return ' - ' + this.confirmEnrolledPayment.enrollee.firstname + ' ' +this.confirmEnrolledPayment.enrollee.lastname
        }

      },
      change(){

        return this.price - this.price2
      },
      page: {
        get(){
          return this.$store.getters.page
        },
        set(val){
          this.$store.dispatch('page', val);
        }

      }


    },

    created () {
      if ( Number.isInteger(this.confirmid)) {
        this.dialog = true
      }
      this.$store.dispatch('page', 1);

      this.courses()
      this.balancesM()
    },

    methods: {
      searchInput(){
        var data = this
        this.$http.get(base_api + '/balance-enrollee-search?string=' + this.chosenStudent + '&token='+ localStorage.getItem('tokenKey'))
        .then(function(res){
          data.chosenStudent = res.data.enrollees
          
        })
        
        
      },
      addNewStudent(balanceId){
        this.dialog = true
        this.balanceId = balanceId
      },
      balanceEnrollee(balanceId){
        this.$router.push({name: 'balanceEnrollee', params: { id: balanceId }});
      },
      close () {
        this.dialog = false
        this.dialog2 = false
        this.dialog3 = false
        
      },

      courses(){
        let data = this
        this.$http.get(base_api + '/courses')
        .then(function(res){
          data.$store.dispatch('courses', res.data.courses);
        })
        
      },
      balancesM(){

        let data = this 
        this.$http.get(base_api + '/balance?page=' + this.page + '&token=' + localStorage.getItem('tokenKey'))
        .then(function(res){
          data.$store.dispatch('balances', res.data.balances);
        })
      },
      deleteItem(balanceId){
        var data = this
        var z = confirm('Are you sure you want to delete this item?') 
        if (z == true) {
         this.$http.delete(base_api + '/balance/'+ balanceId +'?token=' + localStorage.getItem('tokenKey'))
         .then(function(res){
          data.$store.dispatch('snackbarText', 'Balance Deleted Successfully!')
          data.$store.dispatch('snackbarColor', 'success')
          data.$store.dispatch('snackbar', true)
          data.balancesM()
        })
         .catch(function(error){
          data.$store.dispatch('snackbarText', 'ERROR:' + error.response.data.message.substring(53, 90))
          data.$store.dispatch('snackbarColor', 'error')
          data.$store.dispatch('snackbar', true)
        })

       }

     },
     editItem(balanceId){
      let data = this
      this.$http.get(base_api + '/balance/'+ balanceId +'?token=' + localStorage.getItem('tokenKey'))
      .then(function(res){
        data.editBalance = res.data.balance
        data.dialog2 = true
        data.balancesM();
      })
    },

    update(){
      let data = this
      this.$http.put(base_api + '/balance/'+ this.editBalance.id +'?token=' + localStorage.getItem('tokenKey'), {
        editBalance: data.editBalance
      })
      .then(function(res){
        data.balancesM()

      })
      this.$store.dispatch('snackbarText', 'Balance Updated Successfully!')
      this.$store.dispatch('snackbarColor', 'success')
      this.$store.dispatch('snackbar', true)
      this.dialog2 = false
    },

    save() {
      let data = this
      this.$http.post(base_api + '/balance?token=' + localStorage.getItem('tokenKey'),{
        name: this.balanceName,
        amount: this.balanceAmount,
      }).then(function(res){
        data.balancesM();
        data.$store.dispatch('snackbarText', 'Balance Created Successfully!')
        data.$store.dispatch('snackbarColor', 'success')
        data.$store.dispatch('snackbar', true)
        data.dialog3 = false
      });

    },

    attachEnrollee() {
      let data = this
      this.$http.post(base_api + '/balance-attach-enrollee?token=' + localStorage.getItem('tokenKey'),{
        balanceId: this.balanceId,
        discount: this.discount,
        course_ids: this.course_ids,
        confirmEnrolledId: this.confirmEnrolledId,
        semesterId: this.selectedSemester,
        schoolYearId: this.selectedSchoolYear
      }).then(function(res){
        data.$store.dispatch('snackbarText', 'Balance Successfully attach to Enrollee!')
        data.$store.dispatch('snackbarColor', 'success')
        data.$store.dispatch('snackbar', true)
        data.dialog = false
        data.$store.dispatch('course_ids', []);
      });

    }
  },
  watch: {

    page(){
      this.balancesM()
    }
  }
}
</script>
