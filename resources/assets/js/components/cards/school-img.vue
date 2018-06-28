<template>
  <v-card>
        <v-container fluid grid-list-md>
          <v-layout row wrap>
            <v-flex
              v-for="card in cards"
              v-bind="{ [`xs${card.flex}`]: true }"
              :key="card.id"
            >
              <v-card>
                <v-card-media
                  :src="card.src"
                  height="300px"
                  class="responsive"
                >
                  
                </v-card-media>
                
              </v-card>
            </v-flex>
          </v-layout>
        </v-container>
      </v-card>
</template>
<script>
  export default {
    data: () => ({
      cards: [
        { id: 1,  title: 'Pre-fab homes', src: window.base + 'images/school/school1.jpg', flex: 6 },
        { id: 2, title: 'Favorite road trips', src: window.base + 'images/school/school2.jpg', flex: 6 },
        { id: 3, title: 'Best airlines', src: window.base + 'images/school/school3.jpg', flex: 6 },
        { id: 4, title: 'Best airlines', src: window.base + 'images/school/school4.jpg', flex: 6 },
        { id: 5, title: 'Best airlines', src: window.base + 'images/school/school5.jpg', flex: 6 },
        { id: 6, title: 'Best airlines', src: window.base + 'images/school/school6.jpg', flex: 6 },
        { id: 7, title: 'Best airlines', src: window.base + 'images/school/school7.jpg', flex: 6 },
        { id: 8, title: 'Best airlines', src: window.base + 'images/school/school8.jpg', flex: 6 },
        { id: 9, title: 'Best airlines', src: window.base + 'images/school/school9.jpg', flex: 6 },
        { id: 9, title: 'Best airlines', src: window.base + 'images/school/school10.jpg', flex: 6 }
      ]
    })
  }
</script>
<style type="text/css">
  .responsive {
    width: 100%;
    height: auto;
}
</style>