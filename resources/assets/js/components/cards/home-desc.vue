<template>
  <v-container row class="ma-0 pa-0">
  <v-layout class="mr-1 mt-1">
    <v-flex xl12 lg12 class="ma-0 pa-0">
      <v-card  class="elevation-1">
         <v-toolbar color="indigo" dark>
            <v-toolbar-title>{{ title }}</v-toolbar-title>
          </v-toolbar>
        <v-card-media :src="image" :height="height">
        </v-card-media>
        <v-card-title primary-title>
          <div>
            <div>{{ desc }}</div>
          </div>
        </v-card-title>
      </v-card>
    </v-flex>
  </v-layout>
  </v-container>

</template>

<script>
  export default {
    
    props: ['image', 'title', 'desc', 'height']
  }
</script>