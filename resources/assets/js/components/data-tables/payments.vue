<template>
  <div>
    <v-dialog v-model="dialog3" max-width="500px">
      <v-card>
        <v-card-title>
          <span class="headline">
            Summary Of Payment ({{ payment.confirm_enrolled.enrollee.firstname }} {{ payment.confirm_enrolled.enrollee.lastname }} )
          </span>
        </v-card-title>
        <v-card-text>
          <v-form ref="paymentSummary" v-model="valid" lazy-validation>
          <v-container grid-list-md>
            <v-layout wrap>
              <v-flex xs12 sm12 md12 lg12 xl12>
                <due-date></due-date>
              </v-flex>
              <v-flex xs12 sm12 md12 lg12 xl12>
                <my-currency-input v-model="dueAmount" v-bind:label="'Due Amount'"></my-currency-input>
              </v-flex>
              <v-flex xs12 sm12 md12 lg12 xl12>
                <v-select
                  :items="examPeriods"
                  v-model="examPeriod"
                  label="Exam Period"
                  chips
                  item-text="name"
                  item-value="name"
                  required
                  :rules="[v => !!v || 'Exam Period is required']"
                ></v-select>
              </v-flex>
              <v-flex xs12 sm12 md12 lg12 xl12>
                <v-select
                  :items="semesters"
                  v-model="semester"
                  label="Semester"
                  chips
                  item-text="name"
                  item-value="id"
                  required
                  :rules="[v => !!v || 'Semester is required']"
                ></v-select>
              </v-flex>
              <v-flex xs12 sm12 md12 lg12 xl12>
                <v-select
                  :items="schoolYears"
                  v-model="schoolYear"
                  label="School Year"
                  chips
                  item-text="sy"
                  item-value="id"
                  required
                  :rules="[v => !!v || 'School Year is required']"
                ></v-select>
              </v-flex>
              <v-flex xs12 sm12 md12 lg12 xl12>
                 <v-text-field
                    textarea
                    label="Remarks"
                    v-model="remarks"
                    required
                    ></v-text-field>
              </v-flex>
            </v-layout>
          </v-container>
          </v-form>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue darken-1" flat @click.native="close">Cancel</v-btn>
          <v-btn color="blue darken-1" flat @click.native="viewSummary">Summary</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
    <v-dialog v-model="dialog2" max-width="500px">
      <v-card>
        <v-card-title>
          <span class="headline">
            Edit Payment ({{ payment.confirm_enrolled.enrollee.firstname }} {{ payment.confirm_enrolled.enrollee.lastname }} {{ payment.balance_id }})
          </span>
        </v-card-title>
        <v-card-text>
          <v-form ref="form" v-model="valid" lazy-validation>
          <v-container grid-list-md>
            <v-layout wrap>
              <v-flex xs12 sm12 md12 lg12 xl12>
              <edit-payment-date></edit-payment-date>
              </v-flex>
              <v-flex xs12 sm12 md12 lg12 xl12>
                <v-select
                  :items="balancesEdit"
                  v-model="payment.balance_id"
                  label="As Payment for"
                  chips
                  item-text="name"
                  item-value="id"
                  required
                  :rules="[v => !!v || 'As Payment for is required']"
                ></v-select>
              </v-flex>
              <v-flex xs12 sm12 md12 lg12 xl12>
                <v-layout>
                  <v-flex xs3 sm3 md3 lg3 xl3>
                    <v-text-field
                    label="Prefix"
                    v-model="payment.prefix"
                    required
                    :rules="[v => !!v || 'Prefix is required']"
                    ></v-text-field>
                  </v-flex>
                  <v-flex xs8 sm8 md8 lg8 xl8>
                    <v-text-field
                    label="Receipt No"
                    v-model="payment.receipt_no"
                    required
                    :rules="[v => !!v || 'Receipt no. is required']"
                    ></v-text-field>
                  </v-flex>
                </v-layout>
              </v-flex>
              <v-flex xs12 sm12 md12 lg12 xl12>
                <my-currency-input v-model="payment.amount_charge" v-bind:label="'Paid Amount'"></my-currency-input>
              </v-flex>
              <v-flex xs12 sm12 md12 lg12 xl12>
                <my-currency-input v-model="payment.amount_given" v-bind:label="'Received Amount'"></my-currency-input>
              </v-flex>
              <v-flex xs12 sm12 md12 lg12 xl12>
                <span class="title"> Change: </span>
                <span class="display-1">{{ payment.change|currency('₱ ') }}</span>
              </v-flex>
              
            </v-layout>
          </v-container>
          </v-form>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue darken-1" flat @click.native="close">Cancel</v-btn>
          <v-btn color="blue darken-1" flat @click.native="update">Update</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
    <v-dialog v-model="dialog" max-width="500px">
      <v-card>
        <v-card-title>
          <span class="headline">
            New Payment ({{ name }})
          </span>
        </v-card-title>
        <v-card-text>
          <v-form ref="form" v-model="valid" lazy-validation>
          <v-container grid-list-md>
            <v-layout wrap>
              <v-flex xs12 sm12 md12 lg12 xl12>
              <payment-date> </payment-date>
              </v-flex>
              <v-flex xs12 sm12 md12 lg12 xl12>
                <v-select
                  :items="balances"
                  v-model="balance_id"
                  label="As Payment for"
                  chips
                  item-text="name"
                  item-value="id"
                  required
                  :rules="[v => !!v || 'As Payment for is required']"
                ></v-select>
              </v-flex>
              <v-flex xs12 sm12 md12 lg12 xl12>
                <v-layout>
                  <v-flex xs3 sm3 md3 lg3 xl3>
                    <v-text-field
                    label="Prefix"
                    v-model="prefix"
                    required
                    :rules="[v => !!v || 'Prefix is required']"
                    ></v-text-field>
                  </v-flex>
                  <v-flex xs8 sm8 md8 lg8 xl8>
                    <v-text-field
                    label="Receipt No"
                    v-model="receipt_no"
                    required
                    :rules="[v => !!v || 'Receipt no. is required']"
                    ></v-text-field>
                  </v-flex>
                </v-layout>
              </v-flex>
              <v-flex xs12 sm12 md12 lg12 xl12>
                <my-currency-input v-model="price" v-bind:label="'Paid Amount'"></my-currency-input>
              </v-flex>
              <v-flex xs12 sm12 md12 lg12 xl12>
                <my-currency-input v-model="price2" v-bind:label="'Received Amount'"></my-currency-input>
              </v-flex>
              <v-flex xs12 sm12 md12 lg12 xl12>
                <span class="title"> Change: </span>
                <span class="display-1">{{ change|currency('₱ ') }}</span>
              </v-flex>
              
            </v-layout>
          </v-container>
          </v-form>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue darken-1" flat @click.native="close">Cancel</v-btn>
          <v-btn color="blue darken-1" flat @click.native="savePrint">Save</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

  <div class="elevation-1">
  <table class="datatable table">
    <tr class="datatable__progress">
      <th>Receipt No.</th>
      <th>ID</th>
      <th>Name</th>
      <th>Balance</th>
      <th>Paid Amt</th>
      <th>Received Amt</th>
      <th>Change</th>
      <th>Date</th>
      <th style="width:210px">Action</th>
    </tr>
    <tr v-for="payment in payments.data">
      <td>{{ payment.prefix }}-{{ payment.receipt_no }}</td>
      <td>{{ payment.confirm_enrolled.enrollee.idno }}</td>
      <td>{{ payment.confirm_enrolled.enrollee.firstname|capitalize }} {{ payment.confirm_enrolled.enrollee.lastname|capitalize }} <br />({{payment.confirm_enrolled.semester.name }} {{payment.confirm_enrolled.school_year.sy }})</td>
      <td>{{ payment.balance.name }} ({{ payment.balance.amount|currency('₱ ') }})</td>
      <td>{{ payment.amount_charge|currency('₱ ') }}</td>
      <td>{{ payment.amount_given|currency('₱ ') }}</td>
      <td>{{ payment.change|currency('₱ ') }}</td>
      <td>{{ payment.created_at.substring(0, 10) }}</td>
      <td>
        <v-tooltip bottom>
            <v-btn slot="activator" icon class="mx-0" @click="newPayment(payment.confirm_enrolled.id)">
              <v-icon color="success" >credit_card</v-icon>
            </v-btn>
            <span>New Payment</span>
          </v-tooltip>
        <v-tooltip bottom>
          <v-btn slot="activator" icon class="mx-0" @click="editItem(payment.id)">
            <v-icon color="grey">mode_edit</v-icon>
          </v-btn>
          <span>Edit Payment</span>
        </v-tooltip>
        <v-tooltip bottom>
          <v-btn slot="activator" icon class="mx-0" @click="printReceipt(payment.id)">
            <v-icon color="success">print</v-icon>
          </v-btn>
          <span>Print Payment</span>
        </v-tooltip>
        <v-tooltip bottom>
          <v-btn slot="activator" icon class="mx-0" @click="summary(payment.id)">
            <v-icon color="blue">assignment</v-icon>
          </v-btn>
          <span>Summary of payments</span>
        </v-tooltip>
          <v-tooltip bottom>
          <v-btn slot="activator" icon class="mx-0" @click="deleteItem(payment.id)">
            <v-icon color="pink">delete</v-icon>
          </v-btn>
          <span>Delete</span>
          </v-tooltip>
          <v-tooltip bottom>
          <v-btn slot="activator" icon class="mx-0" @click="summaryAll(payment.confirm_enrolled.id)">
            <v-icon color="purple">date_range</v-icon>
          </v-btn>
          <span>Print all payments</span>
        </v-tooltip>
        </td>
    </tr>
  </table>
  </div>
  <div class="text-xs-center pt-2">
        <v-pagination v-model="page" :length="payments.last_page"></v-pagination>
  </div>
</div>
</template>
<script>
  import myCurrencyInput from '../../components/currency-format/my-currency-input'
  import dueDate from '../../components/pickers/due-date'
  import paymentDate from '../../components/pickers/created-at'
  import editPaymentDate from '../../components/pickers/edit-payment-date'
  import _ from 'lodash'
  export default {
   
    props:['confirmid'], 
    components: {
      myCurrencyInput, dueDate, paymentDate, editPaymentDate
    },
    data: () => ({
      remarks: '',
      arOr: true,
      pagination: {
        sortBy: 'or',
        descending: false
      },
      dueAmount: 0,
      dialog3: false,
      balancesEdit:[],
      examPeriod: '',
      examPeriods: [
        { id: 0, name: 'Pre-test'},
        { id: 1,  name: 'Prelim'},
        { id: 2,  name: 'Midterm'},
        { id: 3,  name: 'Final'}
      ],
      semester: '',
      semesters: [
        { id: 1, name: 'First Semester'},
        { id: 2, name: 'Second Semester'}
      ],
      schoolYears: [],
      schoolYear:'',
      payment:{
        balance_id: 0,
        prefix: '',
        receipt_no: '',
        amount_given: 0,
        amount_charge: 0,
        change: 0,
        confirm_enrolled : {
          enrollee: {
            firstname: '',
            lastname: ''
          }
        }
      },
      dialog2: false,
      valid: false,
      prefix: '00',
      receipt_no: '',
      balance_id: null,
      page: 1, 
      price: 0,
      price2: 0,
      dialog: false,
      isInputActive: false,
      paidAmount: '',
      headers: [
      {
        text: 'ID No.',
        align: 'left',
        sortable: false,
        value: 'idno'
      },
      {
        text: 'OR|AR',
        align: 'left',
        sortable: true,
        value: 'or'
      },
      {
        text: 'Name',
        align: 'left',
        sortable: false,
        value: 'name'
      },
      { text: 'Balance', value: 'balance', sortable: false  },
      { text: 'Paid Amount', value: 'paidAmount', sortable: false  },
      { text: 'Received Amount', value: 'givenAmount', sortable: false  },
      { text: 'Change', value: 'change', sortable: false },
      { text: 'Date', value: 'date', sortable: false },
      { text: 'Action', value: 'action', sortable: false }
      ],
     
    }),

    computed: {
      paymentDate(){
        return this.$store.getters.paymentDate
      },
      dueDate(){
        return this.$store.getters.dueDate
      },
      balances: {
        get(){
          return this.$store.getters.balances
        }
        
      },
      confirmEnrolledPayment(){
        return this.$store.getters.confirmEnrolledPayment
      },
      name(){
        if (this.$store.getters.confirmEnrolledPayment != null) {
          return this.confirmEnrolledPayment.enrollee.firstname + ' ' +this.confirmEnrolledPayment.enrollee.lastname + '-' + this.confirmEnrolledPayment.semester.name + ' ' + this.confirmEnrolledPayment.school_year.sy + ''
        }

      },
      change(){

        return  this.price2 -this.price
      },
        paymentsData(){
         
           let payments = this.$store.getters.payments.data

           console.log(_.orderBy(payments, 'receipt_no', 'desc')) 
           return _.orderBy(payments, 'receipt_no', 'desc')
      },
       payments(){
           return this.$store.getters.payments
      },

    },

    created () {
      if ( Number.isInteger(this.confirmid)) {
        this.dialog = true
      }
      this.allPayments()
      
    },

    methods: {
      newPayment(confirmEnrolleeId){
       let data = this
         this.$http.get(window.base_api + '/confirm-enrolled/' + confirmEnrolleeId + '?token=' + localStorage.getItem('tokenKey'))
                    .then(function(res){
                        data.$store.dispatch('confirmEnrolledPayment', res.data.enrollee)
                    })

        this.$http.get(window.base_api + '/payments?confirmEnrolledId='+ confirmEnrolleeId +'&page=' + this.page + '&sortBy=' + this.arOr + '&token=' + localStorage.getItem('tokenKey'))
        .then(function(res){
            data.$store.dispatch('payments', res.data.payments);
            data.receipt_no = parseInt(res.data.receipt_no) + 1;
            if (res.data.confirmEnrolled == null){
             data.$store.dispatch('balances', []);
            }else{
              
               data.$store.dispatch('balances', res.data.confirmEnrolled.balances);
            }
        })

        this.dialog = true

      },
      changeSort (column) {
        this.pagination.sortBy = column
        if ( this.pagination.descending == true) {
          this.pagination.descending = false
          this.arOr = true
        } else {
          this.pagination.descending = true
          this.arOr = false
        }
        this.allPayments()
      },
      givenBlur(val){
        this.givenAmount = val
      },
  
      editItem (id) {
        this.dialog2 = true
        let data = this
        this.$http.get(window.base_api + '/payments/' + id + '?token=' + localStorage.getItem('tokenKey'))
        .then(function(res){
          data.payment = res.data.payment
          data.$store.dispatch('paymentDate', res.data.payment.created_at.substring(0, 10));
          data.balancesEdit = res.data.balances.balances
        })
      },
      summary(id){
        let data = this
        this.$http.get(window.base_api + '/payments/' + id + '?token=' + localStorage.getItem('tokenKey'))
        .then(function(res){
          data.payment = res.data.payment
          data.balancesEdit = res.data.balances.balances
          data.schoolYears = res.data.schoolYears
        })
        this.dialog3 = true

      },
      viewSummary(){
        window.open(window.base_api + '/payments/view/summary?dueAmount=' + this.dueAmount + '&examPeriod=' + this.examPeriod + '&confirmEnrolledId=' + this.payment.confirm_enrollee_id + '&dueDate='+ this.dueDate + '&schoolYear=' + this.schoolYear +'&semester=' + this.semester +'&remarks=' + this.remarks + '&token='+ localStorage.getItem('tokenKey'));
      },

      summaryAll(confirmEnrolledId){
        window.open(window.base_api + '/payments/all/summary?confirmEnrolledId=' + confirmEnrolledId + '&token='+ localStorage.getItem('tokenKey'));
      },

      update(){
        var data = this
        this.$http.put(window.base_api + '/payments/' + this.payment.id + '?token=' + localStorage.getItem('tokenKey'), {
          payment: this.payment
        })
        .then(function(res){
          data.dialog2 = false
          data.allPayments()

        })
      },

      deleteItem (id) {
        var data = this
        var z = confirm('Are you sure you want to delete this item?')
        if (z === true) {
          this.$http.delete(window.base_api + '/payments/' + id + '?token=' + localStorage.getItem('tokenKey'))
          .then(function(res){
            data.allPayments()
            data.$store.dispatch('snackbarText', 'Balance Deleted Successfully!')
            data.$store.dispatch('snackbarColor', 'success')
            data.$store.dispatch('snackbar', true)
          })
        }
      },

      close () {
        this.dialog = false
        this.dialog2 = false
        this.dialog3 = false
        
      },
      printReceipt(id){
         window.open(window.base_api + '/payments/print/' + id + '?token=' + localStorage.getItem('tokenKey'));
      },
      savePrint() {
        let data = this

        if (this.$refs.form.validate()) {
          this.$http.post(window.base_api + '/payments?&token=' + localStorage.getItem('tokenKey'),{
           confirm_enrollee_id : this.confirmEnrolledPayment.id, 
           amount_charge: this.price, 
           amount_given: this.price2, 
           change: this.change,
           prefix: this.prefix,
           receipt_no: this.receipt_no,
           balance_id: this.balance_id,
           created_at: this.paymentDate
          }).then(function(res){
              data.allPayments()
               // window.open(window.base_api + '/payments/print/' + res.data.id + '?token=' + localStorage.getItem('tokenKey'));
          })
          this.dialog = false
        }
        
      },
      allPayments(){
        let data = this
        this.$http.get(window.base_api + '/payments?confirmEnrolledId='+ this.$route.params.id +'&page=' + this.page + '&sortBy=' + this.arOr + '&token=' + localStorage.getItem('tokenKey'))
        .then(function(res){
            data.$store.dispatch('payments', res.data.payments);
            data.receipt_no = parseInt(res.data.receipt_no) + 1;
            if (res.data.confirmEnrolled == null){
             data.$store.dispatch('balances', []);
            }else{
              
               data.$store.dispatch('balances', res.data.confirmEnrolled.balances);
            }
        })
      },
      deduct(){
        var total = this.payment.amount_charge - this.payment.amount_given;
        this.payment.change = total;
      }
    },
    watch: {
      page(val){
        this.allPayments()
      },
      'payment.amount_charge': function(){
        this.deduct()
      },
      'payment.amount_given': function(){
        this.deduct()
      },
    }
  }
</script>
<style type="text/css" scoped>
  table{
    padding: 5px;
    border-collapse: collapse;
    
  }
  table tr th, table tr td{
    border-bottom: 1px solid gray;
    padding: 5px;
  }

  tr:hover{
    background-color: #E1E1E1;
  }

</style>
