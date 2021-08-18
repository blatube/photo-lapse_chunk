module.exports = {
  extends: ['airbnb'],
  rules: {
    'no-template-curly-in-string': 0
  },
  globals: {
    $nuxt: true
  },
  parserOptions: {
    parser: 'babel-eslint',
  },
};
