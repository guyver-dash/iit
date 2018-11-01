<template>
	<v-select
          v-model="selectedSemester"
          :items="semesters"
          item-value="id"
          item-text="name"
          label="Semester"
          class="pl-1 pr-1"
        ></v-select>
</template>

<script type="text/javascript">
	
	export default {

		computed: {

			semesters(){

				return this.$store.getters.semesters
			},
			selectedSemester: {
				get(){

					return this.$store.getters.selectedSemester
				},
				set(val){

					this.$store.dispatch('selectedSemester', val)
				}
			}
		}
	}
</script>