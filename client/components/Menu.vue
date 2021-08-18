<template>
    <div class="Menu">
      <nuxt-link class="Menu__item" :to="{ name: 'index' }">Home</nuxt-link>
      <nuxt-link class="Menu__item" :to="{ name: 'privacy' }">Privacy</nuxt-link>
      <client-only>
        <nuxt-link v-if="loggedIn" class="Menu__item" :to="{ name: 'user-dashboard' }">Dashboard</nuxt-link>
        <span v-if="!loggedIn" href="#" class="Menu__item" @click="showLogin">Login</span>
      </client-only>
    </div>
</template>

<script>
import { mapMutations, mapState } from 'vuex';

  export default {
    name: 'Menu',
    computed: {
      ...mapState('auth', ['loggedIn', 'user']),
    },
    methods: {
      ...mapMutations({
        showLogin: 'loginModal/showLogin',
      }),
    },
  }
</script>

<style lang="scss" scoped>
  .Menu {
    width: 100%;
    position: sticky;
    top: 0;
    left: 0;
    background: $primary-color;
    padding: 24px 0;
    display: flex;
    justify-content: center;
    box-shadow: 0 0 8px $primary-color-dark;

    .Menu__item {
      margin-right: 24px;
      font-weight: bold;
      color: white;
      text-decoration: none;
      cursor: pointer;
    }
  }
</style>
