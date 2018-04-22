<template>
  <div id="app">
    <p>Welcome to your Vue.js lightbox!</p>

    <lightbox
      id="mylightbox"
      :images="images"
      :image_class=" 'img-responsive img-rounded' "
      :album_class=" 'my-album-class' "
      :options="options">
    </lightbox>

  </div>
</template>

<script>
  import Lightbox from 'vue-simple-lightbox'

  export default {
    components: {
      Lightbox
    },
    data(){
        return{
          images : [
            {
                src : 'https://cdn.rawgit.com/vrajroham/vrajroham.github.io/85d64ac5/imgs/img1.jpg',
                title : 'Image 2'
            },
            {
                src : 'https://cdn.rawgit.com/vrajroham/vrajroham.github.io/85d64ac5/imgs/img2.jpg',
                title : 'Image 3'
            },
            {
                src : 'https://cdn.rawgit.com/vrajroham/vrajroham.github.io/85d64ac5/imgs/img3.jpg',
                title : ''
            },
            {
                src : 'https://cdn.rawgit.com/vrajroham/vrajroham.github.io/85d64ac5/imgs/img4.jpg',
                title : ''
            },
          ],
          options : {
            closeText : 'X'
          }
        }
      }
  }
</script>