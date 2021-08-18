<template>
  <div class="IndexPage">
    <Presentation />
  </div>
</template>

<script>
  import Menu from "@/components/Menu";
  import Presentation from "@/components/blocks/Presentation";

  export default {
    name: 'IndexPage',
    components: {
      Menu,
      Presentation,
    },
  }
</script>

<style lang="scss" scoped>
  .IndexPage {
    // ...
  }
</style>
