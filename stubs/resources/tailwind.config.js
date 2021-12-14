module.exports = {
  prefix: 'tw-',
	purge: [
    './public/**/*.html',
    './src/**/*.vue',
    './src/**/*.blade.php'
  ],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {},
  },
  variants: {
    extend: {},
  },
  plugins: [],
}
