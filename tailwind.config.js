module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        blue: {
          900: '#8ae2fe'
        },
      },

      backgroundColor: {
        page: 'var(--page-background-color)',
        card: 'var(--card-background-color)',
        button: 'var(--button-background-color)',
        header: 'var(--header-background-color)',
      },

      textColor: {

        default: 'var(--text-default-color)'
      }
    },
  },
  plugins: [],
  darkMode: 'class'
}
