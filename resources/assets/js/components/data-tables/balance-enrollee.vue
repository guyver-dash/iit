<template>
	<div>
    <v-data-table
      :headers="headers"
      :items="balanceEnrollees.data"
      hide-actions
      class="elevation-1"
    >
      <template slot="items" slot-scope="props">
        <td> {{ props.item.enrollee.firstname }} {{ props.item.enrollee.lastname }}</td>
        <td>{{ balance.name }}</td>
        <td>{{ balance.amount|currency('₱ ') }}</td>
        <td>{{ props.item.balances[0].pivot.discount }}%</td>
        <td>{{ props.item.balances[0].pivot.created_at }}</td>
        <td>
        <v-tooltip bottom>
            <v-btn slot="activator" icon class="mx-0" @click="deleteItem(balance.id, props.item.id)">
              <v-icon color="pink">delete</v-icon>
            </v-btn>
            <span>Delete Balance</span>
          </v-tooltip>

        </td>
      </template>
     
    </v-data-table>
    <div class="text-xs-center pt-2">
        <v-pagination v-model="page" :length="balanceEnrollees.last_page"></v-pagination>
    </div>
  </div>
</template>

<script type="text/javascript">
	export default {
		data: () => ({
			page: 1,
			headers: [
		        {
		          text: 'Student Name',
		          align: 'left',
		          sortable: false,
		          value: 'name'
		        },
		        { 
		          text: 'Balance', 
		          value: 'amount',
		          align: 'left',
		          sortable: false,
		        },
		        { 
		          text: 'Amount', 
		          value: 'amount',
		          align: 'left',
		          sortable: false,
		        },
		        { 
		          text: 'Discount', 
		          value: 'discount',
		          align: 'left',
		          sortable: false,
		        },
		        { 
		          text: 'Date', 
		          value: 'date',
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
			balanceEnrollees(){
				return this.$store.getters.balanceEnrollees
			},
			balance(){
				return this.$store.getters.balance
			}
		},
		created(){

			this.getEnrollees()
			if (this.$route.params.id == null) {
				this.$router.push('balance')
			}
		},
		methods: {

			getEnrollees(){
				let data = this
				this.$http.get(base_api + '/balance-enrollee/' + this.$route.params.id + '?page=' + this.page + '&token=' + localStorage.getItem('tokenKey'))
					.then(function(res){
						data.$store.dispatch('balanceEnrollees', res.data.enrollees)
						data.$store.dispatch('balance', res.data.balance) 
					})
			},
			deleteItem(balanceId, confirmEnrollId){
		        var data = this
		         var z = confirm('Are you sure you want to delete this item?') 
		          if (z == true) {
		           this.$http.delete(base_api + '/balance-confirm-enrolled/' + balanceId + '/' + confirmEnrollId +'?token=' + localStorage.getItem('tokenKey'))
		           .then(function(res){
		              data.$store.dispatch('snackbarText', 'Balance Deleted Successfully!')
		              data.$store.dispatch('snackbarColor', 'success')
		              data.$store.dispatch('snackbar', true)
		              data.getEnrollees()
		           })
		           .catch(function(error){
		            data.$store.dispatch('snackbarText', 'ERROR:' + error.response.data.message.substring(53, 90))
		            data.$store.dispatch('snackbarColor', 'error')
		            data.$store.dispatch('snackbar', true)
		           })
		            
		          }
		         
		      }
		},
		watch: {
			page(val){
				this.getEnrollees()
			}
		}
	}
</script>