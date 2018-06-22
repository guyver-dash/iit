<template>
	<v-container fluid fill-height class="ma-0 pa-0">
			<home-carousel></home-carousel>
	</v-container>
</template>

<script>
  import homeCarousel from '../../components/carousel/home-carousel.vue'
  export default {
    	components: {
    		homeCarousel
    	},
    	created(){

    		this.$store.dispatch('items', [
		        { icon: 'home', text: 'Home', to: '/' },
		        {
		          icon: 'keyboard_arrow_up',
		          'icon-alt': 'keyboard_arrow_down',
		          text: 'About',
		          to: '/about-us',
		          model: false,
		          children: [
		            { text: 'School' },
		            { text: 'Students' },
		            { text: 'DepEd' },
		            { text: 'TESDA' },
		            { text: 'Industry Partner' }
		          ]
		        },
		        { icon: 'assignment_ind', text: 'Admission', to: '/admission' },
		        { icon: 'phone', text: 'Contact Us', to: '/contact-us'},
		        { icon: 'tag_faces', text: 'Facebook Page', to: 'facebook-page' }
		      ])
    	}
  }
</script>
