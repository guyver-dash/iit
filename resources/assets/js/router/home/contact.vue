<template>
	<v-container fluid fill-height>
    
      <v-layout row wrap>
        <v-flex xl6 lg6 md6 sm12 xs12>
          <div class="text-md-left text-lg-left text-xl-left text-sm-center text-xs-center">

          <h3 class="headline">Intellisense Institute of Technology, Inc.</h3>
            <p class="subheading">2F Aspac Bank Building		<br />
            M. C. Briones Avenue, Guizo, <br />
            Mandaue City, Cebu, Phils. 6014 <br />
            (Landmark:  Maguikay fly over, National Hiway)
            <br />
            <br />
            <v-icon>phone</v-icon>  (032)-3165477 <br />
            <v-icon>phone_iphone</v-icon> 0917-1166853
             </p>
          </div>
          <br />
       </v-flex>
       <v-flex xl6 lg6 md6 sm12 xs12>
          <gmap-map :center="center" :zoom="16" style="width: 100%; height: 500px">
            <gmap-info-window :options="infoOptions" :position="infoWindowPos" :opened="infoWinOpen" @closeclick="infoWinOpen=false">
              <div><h4>{{infoContent}} </h4></div>
              <div>{{ address }}</div>
              <div>{{ address2 }}</div>
              <div>(032)-3165477</div>
            </gmap-info-window>

            <gmap-marker :key="i" v-for="(m,i) in markers" :position="m.position" :clickable="true" @click="toggleInfoWindow(m,i)"></gmap-marker>
          </gmap-map>
       </v-flex>
      
    </v-layout>
</v-container>
</template>
<script type="text/javascript">
export default{
  data() {
      return {
          center: {
            lat: 10.33492,
            lng: 123.93975
          },
          infoContent: '',
          address: '',
          address2: '',
          infoWindowPos: null,
          infoWinOpen: false,
          currentMidx: null,
          //optional: offset infowindow so it visually sits nicely on top of our marker
          infoOptions: {
            pixelOffset: {
              width: 0,
              height: -35
            }
          },
          markers: [
          {
            position: {
              lat: 10.33485,
              lng: 123.93980
            },
            infoText: "Intellisense Institute of Technology",
            address: "Aspac Building, Guizo",
            address2: "Mandaue City, Cebu, Phils. 6014"
          }
          ]
        }
      },
      methods: {
          toggleInfoWindow: function(marker, idx) {
            this.infoWindowPos = marker.position;
            this.infoContent = marker.infoText;
            this.address = marker.address;
            this.address2 = marker.address2;
            //check if its the same marker that was selected if yes toggle
            if (this.currentMidx == idx) {
              this.infoWinOpen = !this.infoWinOpen;
            }
            //if different marker set infowindow to open and reset current marker index
            else {
              this.infoWinOpen = true;
              this.currentMidx = idx;
            }
          }
        }
}
    
</script>
