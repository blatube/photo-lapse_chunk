<template>
  <Modal v-if="show" @onClose="hideLogin">
    <template v-slot:header>
      Login
    </template>
    <template v-slot:body>
      <TextInput
        v-model="email"
        :v="$v.email"
        type="email"
        label="Email"
        placeholder="example@photo-lapse.com"
      />
      <TextInput
        v-model="password"
        :v="$v.password"
        type="password"
        label="Password"
        placeholder="Type your password"
      />
      <div class="Controls">
        <input class="btn btn--submit" type="button" @click="login" value="Login" />
      </div>
    </template>
  </Modal>
</template>

<script>
  import Modal from '@/components/modals/Modal';
  import TextInput from "@/components/inputs/TextInput";
  import { minLength, required, email } from "vuelidate/lib/validators";
  import { mapState, mapMutations } from "vuex";

  export default {
    name: 'LoginModal',
    components: {
      TextInput,
      Modal,
    },
    data() {
      return {
        email: null,
        password: null,
      };
    },
    computed: {
      ...mapState('loginModal', ['show']),
    },
    validations: {
      email: {
        required,
        email,
      },
      password: {
        required,
        minLength: minLength(6),
      },
    },
    methods: {
      ...mapMutations({
        hideLogin: 'loginModal/hideLogin',
      }),
      async login() {
        this.$v.$touch();

        if (this.$v.$error) {
          return;
        }

        const { data } = await this.$auth.loginWith('local', {
          params: {
            email: this.email,
            password: this.password,
          },
        });

        if (data.success) {
          await this.$auth.fetchUser();
          this.hideLogin();
          await this.$router.push({ name: 'user-dashboard' });
        } else {
          this.$toast.error(data.data.message);
        }
      },
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
      position: relative;;
    }

    &__header_close {
      position: absolute;
      right: 0;
      top: -10px;
      width: 24px;
      height: 24px;
      background-image: url("@/assets/images/icons/close.svg");
      cursor: pointer;
    }
  }
</style>
