<template>
  <div class="Dashboard">
    <div class="Dashboard__content">
      <div class="Dashboard__albums_container">
        <div class="Dashboard__albums_title">
          Albums
        </div>
        <div
          v-for="album in albums"
          :class="['Dashboard__album', { 'Dashboard__album--active': album.id === currentAlbumId }]"
          :key="album.id"
          :style="{'background-image': `url(/photos/${album.user_id}/${album.id}/${album.last_photo})`}"
          @click="changeAlbum(album.id)"
        >
          <div class="Dashboard__album_title">{{ album.title }}</div>
        </div>
      </div>
      <div class="Dashboard__gallery">
        <Gallery />
      </div>
    </div>
  </div>
</template>

<script>
  import { mapState } from 'vuex';
  import Gallery from '@/components/Gallery';

  export default {
    name: 'Dashboard',
    middleware: ['guest'],
    components: {
      Gallery
    },
    data() {
      return {
        currentAlbumId: null,
      };
    },
    computed: {
      ...mapState('auth', ['user']),
      ...mapState('albums', ['albums']),
    },
    methods: {
      changeAlbum(albumId) {
        this.currentAlbumId = albumId;
        this.$store.dispatch('photos/fetchPhotos', albumId);
      },
    },
    mounted() {
      this.$store.dispatch('albums/fetchAlbums');
    },
  }
</script>

<style lang="scss" scoped>
  .Dashboard {
    // ...

    &__content {
      display: flex;
      height: calc(100vh - 66px);
    }

    &__albums_container {
      flex-basis: 20%;
      padding: 24px;
      border-right: 2px solid $white;
      background: linear-gradient(135deg, $primary-color 0%, $primary-color-dark 100%);
      overflow: auto;

      scrollbar-width: thin;
      scrollbar-color: $primary-color-dark $primary-color;

      &::-webkit-scrollbar {
        width: 12px;
      }

      &::-webkit-scrollbar-track {
        background: $primary-color-dark;
      }

      &::-webkit-scrollbar-thumb {
        background-color: $primary-color;
        border-radius: 20px;
        border: 3px solid $primary-color-dark;
      }
    }

    &__albums_title {
      text-align: center;
      color: $white;
      font-size: 18px;
      margin-bottom: 24px;
    }

    &__album {
      position: relative;
      padding-top: 52.5%;
      border-radius: 24px;
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
      border: 2px solid $primary-color-dark;
      margin-bottom: 24px;
      cursor: pointer;
      transition: box-shadow .3s, border-color .3s;

      &:hover {
        box-shadow: 0 0 8px $white;
      }

      &--active {
        border-color: $white;
      }
    }

    &__album_title {
      color: $white;
      font-weight: bold;
      position: absolute;
      left: 0;
      top: 6px;
      width: 100%;
      text-align: center;
    }

    &__gallery {
      flex-basis: 80%;
    }
  }
</style>
