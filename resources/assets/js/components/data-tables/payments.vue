<template>
  <div>
    <v-dialog v-model="dialog2" max-width="500px">
      <v-card>
        <v-card-title>
          <span class="headline">
            New Payment ({{ payment.confirm_enrolled.enrollee.firstname }} {{ payment.confirm_enrolled.enrollee.lastname }} {{ payment.balance_id }})
          </span>
        </v-card-title>
        <v-card-text>
          <v-form ref="form" v-model="valid" lazy-validation>
          <v-container grid-list-md>
            <v-layout wrap>
              <v-flex xs12 sm12 md12 lg12 xl12>
                <v-select
                  :items="balances"
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
          <v-btn color="blue darken-1" flat @click.native="savePrint">Save &amp; Print</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
    <v-data-table
    :headers="headers"
    :items="payments.data"
    hide-actions
    class="elevation-1"
    >
    <template slot="items" slot-scope="props">
      <td>{{ props.item.confirm_enrolled.enrollee.firstname|capitalize }} {{ props.item.confirm_enrolled.enrollee.lastname|capitalize }}</td>
      <td>{{ props.item.amount_charge|currency('₱ ') }}</td>
      <td>{{ props.item.amount_given|currency('₱ ') }}</td>
      <td>{{ props.item.change|currency('₱ ') }}</td>
      <td >
          <v-btn icon class="mx-0" @click="editItem(props.item.id)">
            <v-icon color="success">mode_edit</v-icon>
          </v-btn>
          <v-btn icon class="mx-0" @click="printReceipt(props.item.id)">
            <v-icon color="info">print</v-icon>
          </v-btn>
          <v-btn icon class="mx-0" @click="deleteItem(props.item.id)">
            <v-icon color="pink">delete</v-icon>
          </v-btn>
        </td>
    </template>

  </v-data-table>
  <div class="text-xs-center pt-2">
        <v-pagination v-model="page" :length="payments.last_page"></v-pagination>
  </div>
</div>
</template>
<script>
  import myCurrencyInput from '../../components/currency-format/my-currency-input'
  export default {
   
    props:['confirmid'],
    components: {
      myCurrencyInput
    },
    data: () => ({
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
        text: 'Name',
        align: 'left',
        sortable: false,
        value: 'name'
      },
      { text: 'Paid Amount', value: 'paidAmount', sortable: false  },
      { text: 'Given Amount', value: 'givenAmount', sortable: false  },
      { text: 'Change', value: 'change', sortable: false },
      { text: 'Action', value: 'action', sortable: false }
      ],
     
    }),

    computed: {
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
          return this.confirmEnrolledPayment.enrollee.firstname + ' ' +this.confirmEnrolledPayment.enrollee.lastname
        }

      },
      change(){

        return this.price - this.price2
      },
        payments(){
          return this.$store.getters.payments
      }


    },

    created () {
      if ( Number.isInteger(this.confirmid)) {
        this.dialog = true
      }
      this.allPayments()
      
    },

    methods: {
      givenBlur(val){
        this.givenAmount = val
      },
  
      editItem (id) {
        this.dialog2 = true
        let data = this
        this.$http.get(window.base_api + '/payments/' + id)
        .then(function(res){
          data.payment = res.data.payment

          data.$store.dispatch('balances', res.data.balances.balances)
        })
      },

      update(){
        var data = this
        this.$http.put(window.base_api + '/payments/' + this.payment.id, {
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
          this.$http.delete(window.base_api + '/payments/' + id)
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
           balance_id: this.balance_id
          }).then(function(res){
              data.allPayments()
               window.open(window.base_api + '/payments/print/' + res.data.id + '?token=' + localStorage.getItem('tokenKey'));
          })
          this.dialog = false
        }
        
      },
      allPayments(){
        let data = this
        this.$http.get(window.base_api + '/payments?confirmEnrolledId='+ this.$route.params.id +'&page=' + this.page + '&token=' + localStorage.getItem('tokenKey'))
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
