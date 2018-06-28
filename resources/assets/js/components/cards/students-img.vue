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
        { id: 1,  title: 'Pre-fab homes', src: window.base + 'images/students/students1.jpg', flex: 6 },
        { id: 2, title: 'Favorite road trips', src: window.base + 'images/students/students2.jpg', flex: 6 },
        { id: 3, title: 'Best airlines', src: window.base + 'images/students/students3.jpg', flex: 6 },
        { id: 4, title: 'Best airlines', src: window.base + 'images/students/students4.jpg', flex: 6 },
        { id: 5, title: 'Best airlines', src: window.base + 'images/students/students5.jpg', flex: 6 },
        { id: 6, title: 'Best airlines', src: window.base + 'images/students/students6.jpg', flex: 6 },
        { id: 7, title: 'Best airlines', src: window.base + 'images/students/students7.jpg', flex: 6 },
        { id: 8, title: 'Best airlines', src: window.base + 'images/students/students8.jpg', flex: 6 },
        { id: 9, title: 'Best airlines', src: window.base + 'images/students/students9.jpg', flex: 6 },
        { id: 10, title: 'Best airlines', src: window.base + 'images/students/students10.jpg', flex: 6 }
      ]
    })
  }
</script>
<style type="text/css">
  img{
    width: 100%;
    height: auto;
}
</style>