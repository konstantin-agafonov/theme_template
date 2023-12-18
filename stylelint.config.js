module.exports = {
  extends: [
    'stylelint-config-sass-guidelines',
  ],
  plugins: [
    'stylelint-scss',
    'stylelint-prettier',
  ],
  rules: {

    'max-nesting-depth': 5,
    'selector-max-compound-selectors': 5,
    'declaration-block-single-line-max-declarations': 0,
    'scss/dollar-variable-pattern': null,
    'selector-class-pattern': null,
    'selector-no-qualifying-type': null,
    'prettier/prettier': [true, { singleQuote: true, tabWidth: 4, useTabs: false, endOfLine: 'auto' }],

  },
};
