<template>
	 <v-flex>
      <v-dialog
        ref="dialog"
        persistent
        v-model="modal"
        lazy
        full-width
        width="290px"
        :return-value.sync="date"
      >
        <v-text-field
          slot="activator"
          label="Due Date"
          v-model="date"
          readonly
        ></v-text-field>
        <v-date-picker v-model="date" scrollable>
          <v-spacer></v-spacer>
          <v-btn flat color="primary" @click="modal = false">Cancel</v-btn>
          <v-btn flat color="primary" @click="$refs.dialog.save(date)">OK</v-btn>
        </v-date-picker>
      </v-dialog>
    </v-flex>
</template>

<script>
  export default {
    data: () => ({
      date: null,
      modal: false,
    }),
    watch: {
      date(){
        this.$store.dispatch('dueDate', this.date)
      }
    }
  }
</script>