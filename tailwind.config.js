const plugin = require('tailwindcss/plugin')

module.exports = {
  purge: [
      './resources/views/public/**/*.blade.php',
      './resources/**/*.js',
      './resources/**/*.vue',
  ],
  darkMode: false, // or 'media' or 'class'
  theme: {
      container: {
          // padding: '1rem',
          // center: true,
      },
    extend: {},
  },
  variants: {
    extend: {},
  },
  plugins: [
      require('@tailwindcss/forms'),
      plugin(function({ addBase, theme }) {
          addBase({
              'h1': { fontSize: theme('fontSize.4xl') },
              'h2': { fontSize: theme('fontSize.xl') },
              'h3': { fontSize: theme('fontSize.lg') },
              'main': { padding: theme('spacing.4') },
          })
      })
  ],
}
