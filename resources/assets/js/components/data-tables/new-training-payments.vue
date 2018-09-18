<template>
	<div>
		<v-data-table
		:headers="headers"
		:items="trainingPayments.data"
		hide-actions
		class="elevation-1"
		>
		<template slot="items" slot-scope="props">
			<td>{{ props.item.firstname|capitalize}} {{ props.item.lastname|capitalize}}</td>
			<td>{{ props.item.paid_amount|currency('₱ ') }}</td>
			<td>{{ props.item.received_amount|currency('₱ ') }}</td>
			<td>{{ props.item.change|currency('₱ ') }}</td>
			<td>{{ props.item.created_at}}</td>
			<td>
				<v-tooltip bottom>
					<v-btn slot="activator" icon class="mx-0" @click="edit(props.item.id)">
						<v-icon color="grey">mode_edit</v-icon>
					</v-btn>
					<span>Edit Payment</span>
				</v-tooltip>
				<v-tooltip bottom>
					<v-btn slot="activator" icon class="mx-0" @click="printReceipt(props.item.id)">
						<v-icon color="success">print</v-icon>
					</v-btn>
					<span>Print Payment</span>
				</v-tooltip>
				<v-tooltip bottom>
					<v-btn slot="activator" icon class="mx-0" @click="deleteItem(props.item.id)">
						<v-icon color="pink">delete</v-icon>
					</v-btn>
					<span>Delete</span>
				</v-tooltip>
				
			</td>

		</template>

	</v-data-table>
	<div class="text-xs-center pt-2">
		<v-pagination v-model="page" :length="trainingPayments.last_page"></v-pagination>
	</div>
	<v-dialog v-model="newTrainingDialog" max-width="500px">
		<v-card>
			<v-card-title>
				<span class="headline">
					New Training Payment
				</span>
			</v-card-title>
			<v-card-text>
				<v-form ref="trainingPayment" v-model="valid" lazy-validation>
					<v-container grid-list-md>
						<v-layout wrap>
							<v-flex xs12 sm12 md12 lg12 xl12>	
								<payment-date> </payment-date>
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
								<v-text-field type="text" 
								label="Firstname" 
								v-model="firstname"
								:rules="[v => !!v || 'Firstname field is required']"
								/>
							</v-text-field>
						</v-flex>
						<v-flex xs12 sm12 md12 lg12 xl12>
							<v-text-field type="text" 
							label="Lastname" 
							v-model="lastname"
							:rules="[v => !!v || 'Lastname field is required']"
							/>
						</v-text-field>
					</v-flex>
					<v-flex xs12 sm12 md12 lg12 xl12>
						<my-currency-input v-model="paidAmount" v-bind:label="'Paid Amount'"></my-currency-input>
					</v-flex>
					<v-flex xs12 sm12 md12 lg12 xl12>
						<my-currency-input v-model="receivedAmount" v-bind:label="'Received Amount'"></my-currency-input>
					</v-flex>
					<v-flex xs12 sm12 md12 lg12 xl12>
						<span class="title"> Change: </span>
						<span class="display-1">{{ change|currency('₱ ') }}</span>
					</v-flex>
					<v-flex xs12 sm12 md12 lg12 xl12 v-if="showRemarks==true">
						<v-text-field type="text" 
						label="Remarks" 
						v-model="remarks"
						textarea
						/>
					</v-text-field>
				</v-flex>
			</v-layout>
		</v-container>
	</v-form>

</v-card-text>
<v-card-actions>
	<v-spacer></v-spacer>
	<v-btn color="blue darken-1" flat @click.native="addRemarks()">{{ remarksDesc }}</v-btn>
	<v-btn color="blue darken-1" flat @click.native="close">Cancel</v-btn>
	<v-btn color="blue darken-1" flat @click.native="save()">Save</v-btn>
</v-card-actions>
</v-card>
</v-dialog>

<v-dialog v-model="editTrainingDialog" max-width="500px">
	<v-card>
		<v-card-title>
			<span class="headline">
				Edit Training Payment
			</span>
		</v-card-title>
		<v-card-text>
			<v-form ref="editTrainingPayment" v-model="valid" lazy-validation>
				<v-container grid-list-md>

					<v-layout wrap>
						<v-flex xs12 sm12 md12 lg12 xl12>	
								<edit-payment-date> </edit-payment-date>
							</v-flex>
							<v-flex xs12 sm12 md12 lg12 xl12>
								<v-layout>

									<v-flex xs3 sm3 md3 lg3 xl3>
										<v-text-field
										label="Prefix"
										v-model="editTrainingPayment.prefix"
										required
										:rules="[v => !!v || 'Prefix is required']"
										></v-text-field>
									</v-flex>
									<v-flex xs8 sm8 md8 lg8 xl8>
										<v-text-field
										label="Receipt No"
										v-model="editTrainingPayment.receipt_no"
										required
										:rules="[v => !!v || 'Receipt no. is required']"
										></v-text-field>
									</v-flex>
								</v-layout>
							</v-flex>
						<v-flex xs12 sm12 md12 lg12 xl12>
							<v-text-field type="text" 
							label="Firstname" 
							v-model="editTrainingPayment.firstname"
							:rules="[v => !!v || 'Firstname field is required']"
							/>
						</v-text-field>
					</v-flex>
					<v-flex xs12 sm12 md12 lg12 xl12>
						<v-text-field type="text" 
						label="Lastname" 
						v-model="editTrainingPayment.lastname"
						:rules="[v => !!v || 'Lastname field is required']"
						/>
					</v-text-field>
				</v-flex>
				<v-flex xs12 sm12 md12 lg12 xl12>
					<my-currency-input v-model="editTrainingPayment.paid_amount" v-bind:label="'Paid Amount'"></my-currency-input>
				</v-flex>
				<v-flex xs12 sm12 md12 lg12 xl12>
					<my-currency-input v-model="editTrainingPayment.received_amount" v-bind:label="'Received Amount'"></my-currency-input>
				</v-flex>
				<v-flex xs12 sm12 md12 lg12 xl12>
					<span class="title"> Change: </span>
					<span class="display-1">{{   editTrainingPayment.received_amount - editTrainingPayment.paid_amount|currency('₱ ') }}</span>
				</v-flex>
				<v-flex xs12 sm12 md12 lg12 xl12 v-if="showRemarks==true">
					<v-text-field type="text" 
					label="Remarks" 
					v-model="editTrainingPayment.remarks"
					textarea
					/>
				</v-text-field>
			</v-flex>
		</v-layout>
	</v-container>
</v-form>

</v-card-text>
<v-card-actions>
	<v-spacer></v-spacer>
	<v-btn color="blue darken-1" flat @click.native="addRemarks()">{{ remarksDesc }}</v-btn>
	<v-btn color="blue darken-1" flat @click.native="close">Cancel</v-btn>
	<v-btn color="blue darken-1" flat @click.native="update()">Update</v-btn>
</v-card-actions>
</v-card>
</v-dialog>
</div>
</template>

<script>
	import myCurrencyInput from '../../components/currency-format/my-currency-input'
	import paymentDate from '../../components/pickers/created-at'
	import editPaymentDate from '../../components/pickers/edit-payment-date'
	export default {
		data: () => ({
			prefix: '00',
			receipt_no: '',
			editTrainingDialog: false,
			
			valid: false,
			paidAmount: 0,
			receivedAmount: 0,
			change: 0,
			firstname: '',
			lastname: '',
			remarks: '',
			showRemarks: false,
			remarksDesc: 'Add Remarks',
			page: 1,
			headers: [
			{
				text: 'Name',
				align: 'left',
				sortable: false,
				value: 'name'
			},
			{ text: 'Paid Amount', value: 'paidAmount', sortable: false  },
			{ text: 'Received Amount', value: 'givenAmount', sortable: false  },
			{ text: 'Change', value: 'change', sortable: false },
			{ text: 'Date', value: 'date', sortable: false },
			{ text: 'Action', value: 'action', sortable: false }
			],

		}),
		components: {
			myCurrencyInput, paymentDate, editPaymentDate
		},
		created(){
			this.getTrainingPayments()

		},
		computed: {
			trainingPayments(){
				return this.$store.getters.trainingPayments
			},
			newTrainingDialog(){
				return this.$store.getters.newTrainingDialog
			},
			paymentDate(){
				return this.$store.getters.paymentDate
			},
			editTrainingPayment(){
				return this.$store.getters.editTrainingPayment
			}
		},
		methods: {
			getReceipt(){
				let data = this
				this.$http.get(window.base_api + '/training-payments-receipt-no?token=' + localStorage.getItem('tokenKey'))
				.then(function(res){
					if (res.data.receiptNo != null) {
						data.receipt_no = res.data.receiptNo + 1
					}

				})
			},
			getTrainingPayments(){
				let data = this
				this.$http.get(window.base_api + '/training-payments?page=' + this.page +'&token=' + localStorage.getItem('tokenKey'))
				.then(function(res){
					data.$store.dispatch('trainingPayments', res.data.trainingPayments);
				})
			},
			addRemarks(){
				if (this.showRemarks === true) {
					this.remarksDesc = 'Add Remarks'
					this.showRemarks = false
				}else{
					this.showRemarks = true
					this.remarksDesc = 'Hide Remarks'
				}

			},
			close(){
				this.$store.dispatch('newTrainingDialog', false);
				this.editTrainingDialog  = false;
			},
			edit(trainingId){
				let data = this
				this.editTrainingDialog = true
				this.$http.get(window.base_api + '/training-payments/' + trainingId + '/edit?token=' + localStorage.getItem('tokenKey'))
				.then(function(res){
					data.$store.dispatch('editTrainingPayment', res.data.trainingPayment);
				})
			},
			deleteItem(trainingId){
				var data = this
				var z = confirm('Are you sure you want to delete this item?')
				if (z === true) {
					this.$http.delete(window.base_api + '/training-payments/' + trainingId + '?token=' + localStorage.getItem('tokenKey'))
					.then(function(res){
						data.getTrainingPayments();
						data.$store.dispatch('snackbarText', 'Training Payment was successfully deleted')
						data.$store.dispatch('snackbarColor', 'success')
						data.$store.dispatch('snackbar', true)
						data.close();
					}).catch(function(err){
						data.$store.dispatch('snackbarText', 'ERROR:' + err.response.data.message)
						data.$store.dispatch('snackbarColor', 'error')
						data.$store.dispatch('snackbar', true)
					}); 
				}
				
			},
			update(){
				let data = this

				if (this.$refs.editTrainingPayment.validate()) {
					this.$http.put(window.base_api + '/training-payments/' + this.editTrainingPayment.id + '?token=' + localStorage.getItem('tokenKey'), this.editTrainingPayment)
					.then(function(res){
						data.getTrainingPayments();
						data.$store.dispatch('snackbarText', 'Training Payment updated successfully')
						data.$store.dispatch('snackbarColor', 'success')
						data.$store.dispatch('snackbar', true)
						data.close();
					})
					.catch(function(err){
						data.$store.dispatch('snackbarText', 'ERROR:' + err.response.data.message)
						data.$store.dispatch('snackbarColor', 'error')
						data.$store.dispatch('snackbar', true)
					}); 
				}
			},
			printReceipt(trainingId){
				window.open(window.base_api + '/training-payments-print/' + trainingId + '?token=' + localStorage.getItem('tokenKey'));
			},
			save(){
				let data = this
				if (this.$refs.trainingPayment.validate()) {
					this.$http.post(window.base_api + '/training-payments?token=' + localStorage.getItem('tokenKey'),{
						firstname: this.firstname,
						lastname: this.lastname,
						paid_amount: this.paidAmount,
						received_amount: this.receivedAmount,
						change: this.change,
						remarks: this.remarks,
						prefix: this.prefix,
						receipt_no: this.receipt_no,
						created_at: this.paymentDate

					})
					.then(function(res){
						data.getTrainingPayments();
						data.$store.dispatch('snackbarText', 'Training Payment created successfully')
						data.$store.dispatch('snackbarColor', 'success')
						data.$store.dispatch('snackbar', true)
						data.close();
					})
					.catch(function(err){
						data.$store.dispatch('snackbarText', 'ERROR:' + err.response.data.message)
						data.$store.dispatch('snackbarColor', 'error')
						data.$store.dispatch('snackbar', true)
					}); 
				}

			},
			deduct(){
				var change =  this.receivedAmount - this.paidAmount;
				this.change = change;
			},
			createChange(paidAmount, receivedAmount){
				let change = 0;  
				change = paidAmount - receivedAmount;

				this.$store.dispatch('editTrainingPaymentField', {
					'change' : change
				});
			}
		},
		watch: {
			page(val){
				this.getTrainingPayments()
			},
			paidAmount(){
				this.deduct()
			},
			receivedAmount(){
				this.deduct()
			},
			'editTrainingPayment.paid_amount': function(val){
				this.$store.dispatch('editTrainingPaymentField', {
					'paid_amount' : val
				});
				
							
			},
			'editTrainingPayment.received_amount': function(val){
				this.$store.dispatch('editTrainingPaymentField', {
					'received_amount' : val
				});
				
			},
			'editTrainingPayment.prefix': function(val){
				this.$store.dispatch('editTrainingPaymentField', {
					'prefix' : val
				});
			},
			'editTrainingPayment.receipt_no': function(val){
				this.$store.dispatch('editTrainingPaymentField', {
					'receipt_no' : val
				});
			},
			'editTrainingPayment.firstname': function(val){
				this.$store.dispatch('editTrainingPaymentField', {
					'firstname' : val
				});
			},
			'editTrainingPayment.lastname': function(val){
				this.$store.dispatch('editTrainingPaymentField', {
					'lastname' : val
				});
			},
			'editTrainingPayment.remarks': function(val){
				this.$store.dispatch('editTrainingPaymentField', {
					'remarks' : val
				});
			}
		}







	}
</script>



