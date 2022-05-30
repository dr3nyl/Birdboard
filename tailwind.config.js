module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
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
}