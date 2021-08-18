<template>
  <div class="Modal" @click.self="$emit('onClose')">
    <div class="Modal__content">
      <div class="Modal__header">
        <slot name="header" />
        <div class="Modal__header_close" @click="$emit('onClose')" />
      </div>
      <div class="Modal__body">
        <slot name="body" />
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    name: 'Modal',
    data() {
      return {
      };
    },
  }
</script>

<style lang="scss" scoped>
  .Modal {
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba($primary-color-dark, .7);

    &__content {
      background-color: #fefefe;
      margin: 15% auto;
      padding: 20px;
      border: 1px solid #888;
      width: 50%;
      border-radius: 4px;
    }

    &__header {
      position: relative;
      font-weight: bold;
      font-size: 18px;
      padding-bottom: 24px;
      margin-bottom: 24px;
      border-bottom: 1px solid #cecece;
    }

    &__header_close {
      position: absolute;
      right: 0;
      top: -3px;
      width: 24px;
      height: 24px;
      background-image: url("@/assets/images/icons/close.svg");
      cursor: pointer;
    }
  }
</style>
