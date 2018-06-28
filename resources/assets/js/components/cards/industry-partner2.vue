<template>
  <v-container row class="ma-0 pa-0">
  <v-layout class="mr-1 mt-1">
    <v-flex xl12 lg12 class="ma-0 pa-0">
      <v-card  class="elevation-1">
         <v-toolbar :color="color" dark>
            <v-toolbar-title>{{ title }}</v-toolbar-title>
          </v-toolbar>
        <img :src="image" class="responsive">
        <v-card-title primary-title>
          <slot></slot>
        </v-card-title>
      </v-card>
    </v-flex>
  </v-layout>
  </v-container>

</template>

<script>
  export default {
    
    props: ['image', 'title', 'desc', 'color']
  }
</script>

<style type="text/css">
  .responsive {
    width: 100%;
    height: auto;
}
</style>