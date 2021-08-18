<template>
    <div :class="['Gallery', {'Gallery--no_photos': !photos.length}]">
      <template v-if="photos.length">
        <div
          v-for="photo in photos"
          :key="photo.id"
          class="Gallery__item"
          :style="{'background-image': `url(${photo.photoUrl})`}">
          <div class="Gallery__item_title">{{ photo.created_at | dateFilter }}</div>
        </div>
      </template>
      <template v-else>
        Album is empty
      </template>
    </div>
</template>

<script>
  import { mapState } from 'vuex';
  import dateFilter from '@/filters/date.js';

  export default {
    name: 'Gallery',
    filters: {dateFilter},
    computed: {
      ...mapState('auth', ['loggedIn', 'user']),
      ...mapState('photos', ['photos']),
    },
    created() {
    },
  }
</script>

<style lang="scss" scoped>
  .Gallery {
    padding-top: 24px;
    padding-left: 24px;
    display: flex;
    flex-wrap: wrap;
    overflow: auto;
    height: calc(100% - 24px);

    &--no_photos {
      justify-content: center;
      align-items: center;
      font-size: 36px;
    }

    &__item {
      box-sizing: border-box;
      position: relative;
      width: calc(20% - 24px);
      height: 196px;
      margin-right: 24px;
      margin-bottom: 24px;
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;
      border-radius: 12px;
      border: 2px solid $primary-color;
    }

    &__item_title {
      color: $white;
      text-align: center;
      position: absolute;
      bottom: 6px;
      bottom: 0;
      left: 0;
      width: 100%;
    }

    &__no_photos {

    }
  }
</style>
