module.exports = {
  env: {
    browser: true,
    es2021: true,
  },
  extends: 'airbnb-base',

  overrides: [
    {
      env: {
        node: true,
      },
      files: [
        '.eslintrc.{js,cjs}',
      ],
      parserOptions: {
        sourceType: 'script',
      },
    },
  ],
  parserOptions: {
    ecmaVersion: 'latest',
    sourceType: 'module',
  },
  rules: {
    'no-plusplus': 'off',
    'no-underscore-dangle': 'off',
    'no-new': 0,
    'class-methods-use-this': 'off',
    'import/prefer-default-export': 'off',
    'no-param-reassign': 'off',
    'linebreak-style': 'off',
  },
  settings: {
    'import/resolver': {
      node: {
        extensions: [
          '.js',
          '.jsx',
        ],
      },
    },
  },

};
