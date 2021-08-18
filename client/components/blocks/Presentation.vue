<template>
  <div class="Presentation">
    <div class="Presentation__container Presentation__container--left">
      <div class="Presentation__logo" />
      <div class="Presentation__slogan">
        Photo-Lapse is a photo diary that makes it easy
        <br>
        to take your day-to-day moments and create a
        <br>
        progress movie of your life
      </div>
      <a class="Presentation__download_button" href="https://play.google.com/apps/testing/com.blatube.mytimelapse" />
    </div>
    <div class="Presentation__container Presentation__container--right">
      <div class="Presentation__phone_plug" />
    </div>
  </div>
</template>

<script>
  export default {
    name: 'Presentation',
  }
</script>

<style lang="scss" scoped>
  .Presentation {
    width: 100vw;
    height: calc(100vh - 66px);
    display: flex;
    background: $primary-color;
    background: linear-gradient(135deg, $primary-color 0%, $primary-color-dark 100%);

    @include _SD {
      flex-direction: column-reverse;
    }

    &__container {
      flex-basis: 50%;

      @include _SD {
        flex-basis: unset;
      }

      &--left {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-top: 20vh;

        @include _SD {
          flex: 1;
          margin-top: 18px;
        }
      }

      &--right {
        display: flex;
        justify-content: center;
        align-items: center;

        @include _SD {
          margin-top: 18px;
        }
      }
    }

    &__logo {
      width: 196px;
      height: 100px;
      background-size: contain;
      background-repeat: no-repeat;
      background-image: url("@/assets/images/logo.png");
      margin-bottom: 18px;

      @include _SD {
        display: none;
      }
    }

    &__slogan {
      color: white;
      font-size: 18px;
      text-align: center;
      line-height: 25px;
      margin-bottom: 18px;

      @include _SD {
        font-size: 16px;
        line-height: 18px;
      }
    }

    &__download_button {
      display: block;
      width: 153px;
      height: 46px;
      background-image: url("@/assets/images/play_market.png");
    }

    &__phone_plug {
      position: relative;
      width: 28vh;
      height: 61vh;
      background-size: 98%;
      background-repeat: no-repeat;
      background-position: center;
      background-image: url("@/assets/images/plug.png");

      &:after {
        content: " ";
        display: block;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url("@/assets/images/phone.png");
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center;
      }
    }
  }
</style>
