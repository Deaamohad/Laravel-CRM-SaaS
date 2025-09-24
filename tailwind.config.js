/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  darkMode: false, // Completely disable dark mode
  theme: {
    extend: {
      backgroundClip: {
        'text': 'text',
      }
    },
  },
  plugins: [],
}
