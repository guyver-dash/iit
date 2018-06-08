<template>
  <div>
    <v-dialog v-model="dialog" max-width="500px">
      <v-card>
        <v-card-title>
          <span class="headline">
            New Payment ({{ name }})
          </span>
        </v-card-title>
        <v-card-text>
          <v-container grid-list-md>
            <v-layout wrap>

              <v-flex xs12 sm12 md12 lg12 xl12>
                <my-currency-input v-model="price" v-bind:label="'Paid Amount'"></my-currency-input>
              </v-flex>
              <v-flex xs12 sm12 md12 lg12 xl12>
                <my-currency-input v-model="price2" v-bind:label="'Given Amount'"></my-currency-input>
              </v-flex>
              <v-flex xs12 sm12 md12 lg12 xl12>
                <span class="title"> Change: </span>
                <span class="display-1">{{ change|currency('₱ ') }}</span>
              </v-flex>
              
            </v-layout>
          </v-container>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue darken-1" flat @click.native="close">Cancel</v-btn>
          <v-btn color="blue darken-1" flat @click.native="print">print</v-btn>
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
          <v-btn icon class="mx-0" @click="deleteItem(props.item.id)">
            <v-icon color="pink">delete</v-icon>
          </v-btn>
        </td>
    </template>

  </v-data-table>
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
      givenFocus(){
        console.log('fosuc');
      },
      editItem (item) {
        
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
        
      },

      print() {
        let data = this
        this.$http.post(window.base_api + '/payments?&token=' + localStorage.getItem('tokenKey'),{
           confirm_enrollee_id : this.confirmEnrolledPayment.id, 
           amount_charge: this.price, 
           amount_given: this.price2, 
           change: this.change
        }).then(function(res){
            data.allPayments()
             window.open(window.base_api + '/payments/print/' + res.data.id + '?token=' + localStorage.getItem('tokenKey'));
        })
        this.dialog = false
      },
      allPayments(){
        let data = this
        this.$http.get(window.base_api + '/payments?page=' + this.page + '&token=' + localStorage.getItem('tokenKey'))
        .then(function(res){
            data.$store.dispatch('payments', res.data.payments);
        })
      }
    },
    watch: {
      page(val){
        this.allPayments()
      }
    }
  }
</script>
