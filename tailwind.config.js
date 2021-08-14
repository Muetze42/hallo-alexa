const plugin = require('tailwindcss/plugin')

module.exports = {
  purge: [
      './resources/**/*.blade.php',
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
      plugin(function({ addBase, theme }) {
          addBase({
              'h1': { fontSize: theme('fontSize.2xl') },
              'h2': { fontSize: theme('fontSize.xl') },
              'h3': { fontSize: theme('fontSize.lg') },
              'main': { padding: theme('spacing.4') },
          })
      })
  ],
}
