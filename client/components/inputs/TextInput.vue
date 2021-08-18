<template>
  <div :class="{ 'TextInput': true, 'TextInput--hasError': v.$error }">
    <input :value="value" :name="name" type="hidden" :id="id" />
    <label class="TextInput__label">
      <span v-show="label">{{ label }}</span>
      <input class="TextInput__input" :type="type" :value="value" :placeholder="placeholder" @input="handleInput" />
    </label>
  </div>
</template>

<script>
  export default {
    name: 'TextInput',
    props: {
      id: {
        type: String,
      },
      type: {
        type: String,
        default: 'text',
      },
      name: {
        type: String,
      },
      value: {
        required: true,
      },
      placeholder: {
        type: String,
      },
      label: {
        type: String,
      },
      v: {
        type: Object,
      },
    },
    methods: {
      handleInput(e) {
        this.$emit('input', e.target.value)
      }
    },
  }
</script>

<style lang="scss" scoped>
  .TextInput {
    margin-bottom: 12px;

    &__input {
      width: 100%;
      margin: 8px 0;
      display: inline-block;
      border: 1px solid #ccc;
      box-shadow: inset 0 1px 3px #ddd;
      border-radius: 4px;
      box-sizing: border-box;
      padding: 12px 20px;
      outline: none;
    }

    &--hasError &__input {
      border-color: red;
    }

    &__label {
      // ...

      &--hasError {
        background-color: red;
      }
    }
  }
</style>
