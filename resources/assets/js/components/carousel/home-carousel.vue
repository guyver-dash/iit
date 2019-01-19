<template>
	<v-layout row wrap>
		<v-flex xl12 lg12 md12 sm12 xs12>
		        <v-carousel delimiter-icon="stop" prev-icon="mdi-arrow-left" next-icon="mdi-arrow-right">
				    <v-carousel-item v-for="(item,i) in items" :src="item.src" :key="i"></v-carousel-item>
				</v-carousel>
		</v-flex>

    <v-flex xs12>
      <br />
        <p class="headline">
          <center>
          Technology is everywhere and in every part of our culture. <br /> It affects how we live, work, play, and most importantly learn. 
          </center>
        </p>
        <p class="subheading">
          <center>
          Together with technology, we at IIT enhance learning by providing well-rounded education through the following:
          </center>
        </p>
        <ul class="subheading pl-5 ml-5">
            <li>providing each student with hands-on computer experience</li>
            <li>making available community classrooms where students see actual workplace and job</li>
            <li>organizing life coaching, motivational sessions all year round</li>
            <li>simulated sessions in job search activities like portfolio planning, construction and job interviews.</li>
        </ul>
        <br />
        <p class="subheading"> <center> Technology in the classroom and on campus can make a difference in Education if used properly.  <br />It will prepare students for their future careers where it starts <br /><h3 class="headline">HERE @IIT!</h3> </center>
        </p>
		</v-flex>
		<v-flex xl6 lg6 md6 sm6 xs12>
      <home-special v-bind:image="lecture3"  v-bind:title="'K12 READY!'"></home-special>
			<home-desc v-bind:image="lecture1" v-bind:title="title1" v-bind:desc="desc1" v-bind:height="'300px'"></home-desc>

      
		</v-flex>
	 	<v-flex xl6 lg6 md6 sm6 xs12 class="pa-1 elevation-2">
		       <a class="twitter-timeline" href="https://twitter.com/IIT_Mandaue?ref_src=twsrc%5Etfw" data-tweet-limit="6">Tweets by IIT_Mandaue</a> 
		 </v-flex>
	 </v-layout>
	 
</template>
<script>
  import homeDesc from '../../components/cards/home-desc.vue'
  import homeSpecial from '../../components/cards/home-special.vue'
  export default {
    data () {
      return {
        items: [
          {
            src: window.base + '/images/carousel/car-1.jpg'
          },
          {
            src: window.base + '/images/carousel/car-2.jpg'
          },
          {
            src: window.base + '/images/carousel/car-3.jpg'
          },
          {
            src: window.base + '/images/carousel/car-4.jpg'
          }
        ],
        lecture1: window.base + '/images/lectures/1.jpg',
        title1: 'Computer Laboratory',
        desc1: 'Technology is used by IIT students to access the web and learn more about Information Technology. Computer laboratories are equipped with brand new computers and will provide each student hands on experience with a unit assigned to each.',
        lecture2: window.base + '/images/lectures/2.jpg',
        title2: 'The lecture rooms',
        desc2: 'Lecture rooms are equipped with state-of-the art teaching equipments configured to support instructional activities such as lectures, discussions and off-site instruction.',
        lecture3: window.base + '/images/lectures/3.jpg',
        title3: 'Associate Programs',
        desc3: 'Successful graduates of the IIT will receive diplomas, certificates of completion and transcipts of record. All subjects offered by IIT are TESDA accredited.'
      }
    },
    components: {
    	homeDesc, homeSpecial
    }
  }
</script>
