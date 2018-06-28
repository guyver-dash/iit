<template>
  <v-layout column>
    <v-flex xs12 sm12 md12 lg12 xl12>
      <v-card>
        <v-container fluid grid-list-md>
          <v-layout row wrap>
            <v-flex
              v-for="card in cards"
              v-bind="{ [`xs${card.flex}`]: true }"
              :key="card.title"
            >
              <v-card>
                <img :src="card.src" class="responsive" height="300">
              </v-card>
            </v-flex>
          </v-layout>
        </v-container>
      </v-card>
    </v-flex>
  </v-layout>
</template>
<script>
  export default {
    data: () => ({
      cards: [
        { id: 1,  title: 'Pre-fab homes', src: window.base + 'images/industry-partner/unifeeds.png', flex: 3 },
        { id: 2, title: 'Favorite road trips', src: window.base + 'images/industry-partner/residenz.jpg', flex: 3 },
        { id: 3, title: 'Best airlines', src: window.base + 'images/industry-partner/vinrio.png', flex: 3 },
        { id: 4, title: 'Best airlines', src: window.base + 'images/industry-partner/shemberg.jpg', flex: 3 },
        { id: 5, title: 'Best airlines', src: window.base + 'images/industry-partner/rico.jpg', flex: 3 },
        { id: 6, title: 'Best airlines', src: window.base + 'images/industry-partner/copenhagen.jpg', flex: 3 },
        { id: 7, title: 'Best airlines', src: window.base + 'images/industry-partner/Teleperformance.jpg', flex: 3 },
        { id: 8, title: 'Best airlines', src: window.base + 'images/industry-partner/papakits.jpg', flex: 3 },
        { id: 9, title: 'Best airlines', src: window.base + 'images/industry-partner/dohera.png', flex: 3 },
        { id: 10, title: 'Best airlines', src: window.base + 'images/industry-partner/bir.png', flex: 3 },
        { id: 11, title: 'Best airlines', src: window.base + 'images/industry-partner/careerfirst_1.jpg', flex: 3 },
        { id: 12, title: 'Best airlines', src: window.base + 'images/industry-partner/thinking_tools_1.jpg', flex: 3 },
        { id: 13, title: 'Best airlines', src: window.base + 'images/industry-partner/manulife.jpg', flex: 3 },
        { id: 14, title: 'Best airlines', src: window.base + 'images/industry-partner/interasian.jpg', flex: 3 },
        { id: 15, title: 'Best airlines', src: window.base + 'images/industry-partner/princewarehouse.jpg', flex: 3 }
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