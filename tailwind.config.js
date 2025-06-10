/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./**/*.{html,js,php}"],
  theme: {
    container: {
      center: true,
      padding: {
        DEFAULT: '1rem',
        sm: '2rem',
        lg: '4rem',
        xl: '5rem',
        '2xl': '6rem',
      },
    },
    extend: {
      transitionProperty: {
        'height': 'height',
        'spacing': 'margin, padding',
      },
      animation: {
        'spin-slow': 'spin 3s linear infinite',
      },
      colors: {
        'app-primary': '#C1B79A',
        'app-secondary': '#2E343A'
      },
      fontFamily: {
        'playfair': ['"Playfair Display"', "serif"]
      }
    },
  },
  plugins: [
    require('tailwindcss-animated')
  ],
}

