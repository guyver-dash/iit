<template>
	<v-select
         v-model="selectedSchoolYear"
          :items="schoolYears"
          label="School Year"
          item-value="id"
          item-text="sy"
          class="pl-1 pr-1"
        ></v-select>
</template>

<script type="text/javascript">
	
	export default{

		computed: {

			schoolYears(){

				return this.$store.getters.schoolYears

			},

			selectedSchoolYear: {

				get(){

					return this.$store.getters.selectedSchoolYear
				},

				set(val){

					this.$store.dispatch('selectedSchoolYear', val)
				}
			}

		}
		
	}
</script>