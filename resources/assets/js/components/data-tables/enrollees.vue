<template>
  <span>
    <v-data-table
      :headers="headers"
      :items="enrollees.data"
      hide-actions
      class="elevation-1 mt-1"
    >
      <template slot="items" slot-scope="props">
        <td>
          <v-badge left color="success" v-if="props.item.status == 1">

            <v-icon slot="badge" color="white" small >check</v-icon>
            <span> {{ props.item.enrollee.idno }}</span>
          </v-badge>
          <v-badge left color="error" v-else>
            <v-icon slot="badge" color="white" small >close</v-icon>
          </v-badge>
       </td>
        <td>{{ props.item.enrollee.firstname }}</td>
        <td>{{ props.item.enrollee.lastname }}</td>
        <td>{{ props.item.schedule.name }}</td>
        <td>{{ props.item.semester.name }}</td>
        <td>{{ props.item.school_year.sy }}</td>
        <td>{{ props.item.course.name }}</td>
        <td class="justify-center layout px-0">
          <v-btn icon class="mx-0" @click="balance(props.item.id)">
            <v-icon color="grey" >format_bold</v-icon>
          </v-btn>
          <v-btn icon class="mx-0" @click="payment(props.item.id)">
            <v-icon color="yellow darken-3" >attach_money</v-icon>
          </v-btn>
          <v-btn icon class="mx-0" :to="'/admin/admission/'+props.item.id">
            <v-icon color="teal">edit</v-icon>
          </v-btn>
          <v-btn icon class="mx-0" @click="createPDF(props.item.id)">
            <v-icon color="info">print</v-icon>
          </v-btn>
          <v-btn icon class="mx-0" @click="deleteItem(props.item.id)">
            <v-icon color="pink">delete</v-icon>
          </v-btn>
        </td>
      </template>
      </v-data-table>
      <div class="text-xs-center pt-2">
        <v-pagination v-model="page" :length="enrollees.last_page"></v-pagination>
    </div>
    
  </span>
</template>
<script>
  export default {
    props: ['printUrl'],
    data: () => ({
      dialog: false,
      headers: [
        {
          text: 'ID #',
          sortable: true,
          value: 'idno'
        },
        { text: 'Firstname', value: 'firstname', sortable: true },
        { text: 'Lastname', value: 'lastname', sortable: true },
        { text: 'Schedule', value: 'schedule', sortable: true},
        { text: 'Semester', value: 'semester', sortable: true},
        { text: 'SY', value: 'school_year', sortable: true},
        { text: 'Course', value: 'course', sortable: true},
        { text: 'Actions', value: 'actions', sortable: false }
      ],
     
    }),

    computed: {
      formTitle () {
        return this.editedIndex === -1 ? 'New Item' : 'Edit Item'
      },
      enrollees(){
        return this.$store.getters.enrollees
      },
      page: {
        get(){
          return this.$store.getters.page
        },
        set(val){
          this.$store.dispatch('page', val)
        }
      }
    },

    

    methods: {
      balance(confirmEnrolleeId){
        this.$router.push({name: 'balance', params: { id: confirmEnrolleeId }})
      },
      payment(confirmEnrolleeId){
          this.$router.push({name: 'payments', params: { id: confirmEnrolleeId }})
      },
      createPDF(confirmEnrolleeId) {
        
        window.open(window.base + this.printUrl + confirmEnrolleeId + '?token=' + localStorage.getItem('tokenKey'));
      },

      editItem (item) {
        this.editedIndex = this.desserts.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialog = true
      },

      deleteItem (enrolleeId) {
        var z = confirm('Are you sure you want to delete this item?') 
        if (z == true) {
          this.$http.delete(window.base + 'api/confirm-enrolled/' + enrolleeId + '?token=' + localStorage.getItem('tokenKey'))
          .then(function(res){
              data.$store.dispatch('enrollees', res.data.enrollees)
          })
          .catch(function(){

          })
          this.$store.dispatch('snackbarText', 'Enrollee Deleted Successfully!')
          this.$store.dispatch('snackbarColor', 'success')
          this.$store.dispatch('snackbar', true)
        }
      },

      close () {
        this.dialog = false
        setTimeout(() => {
          this.editedItem = Object.assign({}, this.defaultItem)
          this.editedIndex = -1
        }, 300)
      },

      save () {
        if (this.editedIndex > -1) {
          Object.assign(this.desserts[this.editedIndex], this.editedItem)
        } else {
          this.desserts.push(this.editedItem)
        }
        this.close()
      }
    }
  }
</script>