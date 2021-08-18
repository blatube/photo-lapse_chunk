<template>
  <div>
    <Menu />
    <Nuxt />
    <LoginModal />
  </div>
</template>

<script>
  import Menu from '@/components/Menu';
  import LoginModal from "@/components/modals/LoginModal";

  export default {
    components: {
      Menu,
      LoginModal,
    },
  }
</script>

<style lang="scss">
  .html, .body {
    margin: 0;
    padding: 0;
  }
</style>
