/** @type {import('tailwindcss').Config} */
module.exports = {
  // Enable class-based dark mode
  darkMode: 'class',

  // Specify the paths to all of the template files in your project
  content: [
    './*.php',
    './**/*.php',
    './assets/js/**/*.js',
    './layout/**/*.php',
    './pages/**/*.php'
  ],

  theme: {
    extend: {
      // Custom Colors extracted from Luxe Landscape theme
      colors: {
        primary: '#11d462',
        'background-light': '#f6f8f7',
        'background-dark': '#062a1e',
        'neutral-charcoal': '#1a1c1b',
        alabaster: '#f2f2f2'
      },
      // Custom Fonts
      fontFamily: {
        display: ['"Space Grotesk"', '"Cairo"', 'sans-serif']
      },
      // Custom Border Radii
      borderRadius: {
        DEFAULT: '0.5rem',
        lg: '1rem',
        xl: '1.5rem',
        full: '9999px'
      }
    }
  },

  // Include popular plugins used in the theme
  plugins: [
    require('@tailwindcss/forms'),
    require('@tailwindcss/container-queries')
  ]
};
