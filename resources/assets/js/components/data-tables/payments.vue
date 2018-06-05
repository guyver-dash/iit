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
                <v-text-field 
                  label="Paid amount" 
                  prefix="₱" 
                  v-model="paidAmount" 
                  ></v-text-field>
              </v-flex>
              <v-flex xs12 sm12 md12 lg12 xl12>
                <my-currency-input v-model="price"></my-currency-input>
              </v-flex>
              <v-flex xs12 sm12 md12 lg12 xl12>
                <span class="title"> Change: </span>
                <span class="display1"></span>
              </v-flex>
              
            </v-layout>
          </v-container>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue darken-1" flat @click.native="close">Cancel</v-btn>
          <v-btn color="blue darken-1" flat @click.native="save">Save</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
    <v-data-table
      :headers="headers"
      :items="desserts"
      hide-actions
      class="elevation-1"
    >
      <template slot="items" slot-scope="props">
        <td>{{ props.item.name }}</td>
        <td class="text-xs-right">{{ props.item.calories }}</td>
        <td class="text-xs-right">{{ props.item.fat }}</td>
        <td class="text-xs-right">{{ props.item.carbs }}</td>
        <td class="text-xs-right">{{ props.item.protein }}</td>
        <td class="justify-center layout px-0">
          <v-btn icon class="mx-0" @click="editItem(props.item)">
            <v-icon color="teal">edit</v-icon>
          </v-btn>
          <v-btn icon class="mx-0" @click="deleteItem(props.item)">
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
      price: 1234,
      dialog: false,
      isInputActive: false,
      paidAmount: '',
      headers: [
        {
          text: 'Dessert (100g serving)',
          align: 'left',
          sortable: false,
          value: 'name'
        },
        { text: 'Calories', value: 'calories' },
        { text: 'Fat (g)', value: 'fat' },
        { text: 'Carbs (g)', value: 'carbs' },
        { text: 'Protein (g)', value: 'protein' },
        { text: 'Actions', value: 'name', sortable: false }
      ],
      desserts: [],
      editedIndex: -1,
      editedItem: {
        name: '',
        calories: 0,
        fat: 0,
        carbs: 0,
        protein: 0
      },
      defaultItem: {
        name: '',
        calories: 0,
        fat: 0,
        carbs: 0,
        protein: 0
      }
    }),

    computed: {
        confirmEnrolledPayment(){
          return this.$store.getters.confirmEnrolledPayment
        },
        name(){
          if (this.$store.getters.confirmEnrolledPayment != null) {
            return this.confirmEnrolledPayment.enrollee.firstname + ' ' +this.confirmEnrolledPayment.enrollee.lastname
          }
          
        }


    },

    created () {
        if ( Number.isInteger(this.confirmid)) {
          this.dialog = true
        }
    },

    methods: {
      givenBlur(val){
        this.givenAmount = val
      },
      givenFocus(){
        console.log('fosuc');
      },
      editItem (item) {
        this.editedIndex = this.desserts.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialog = true
      },

      deleteItem (item) {
        const index = this.desserts.indexOf(item)
        confirm('Are you sure you want to delete this item?') && this.desserts.splice(index, 1)
      },

      close () {
        this.dialog = false
        
      },

      save () {
        if (this.editedIndex > -1) {
          Object.assign(this.desserts[this.editedIndex], this.editedItem)
        } else {
          this.desserts.push(this.editedItem)
        }
        this.close()
      }
    },
    watch: {
      
    }
  }
</script>
