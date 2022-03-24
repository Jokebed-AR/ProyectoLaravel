
module.exports = {
  purge: false,
  
  theme: {
    
    maxWidth: {
      '7xl': '85rem',
      '8xl': '90rem',
    },
    screens: {
      xs: '340px',
      sm: '640px',
      md: '768px',
      lg: '1024px',
      xl: '1280px',
      'lap': '1366px',
      'mac': '1440px',
      '2xl': '1600px',
      '3xl': '1920px',
    },
    fontFamily: {
      display: ['Oswald', 'sans-serif'],
      body: ['Oswald', 'sans-serif'],
    },
    borderWidth: {
      default: '1px',
      '0': '0',
      '2': '2px',
      '4': '4px',
      '5': '5px',
      '10': '10px',
    },
    
    extend: {
      colors: {
        // colors
        primary: '#FF7006',
        secondary: {
          100: '#00A0DF',
          900: '#0055B8',
        },
        gray: {
          100: '#555555',
          600: '#f2f5f8',
          700: '#969191',
          900: '#ebebeb',
        },
        red: 'rgba(255, 0, 0, 1)',
        green: '#00d236',
        whiteSmoke: {
          100: '#FFFFFF'
        },
        transparent: 'transparent',
        blackT: 'rgba(0, 0, 0, .8)',
        black: '#000',
        white: '#fff',
      },
      spacing: {
        '96': '24rem',
        '128': '32rem',
      },
      fontSize: {
        '6xl': '4.8rem',
        '7xl': '4.9rem',
        '8xl': '5rem',
        '16xl': '6rem',
        '32xl': '7rem',
      }
    },
    pagination: theme => ({
      color: theme('colors.primary'),
      linkFirst: 'mr-3 border rounded',
      linkSecond: 'rounded-l border-l',
      linkBeforeLast: 'rounded-r border-r',
      linkLast: 'ml-3 border rounded',
    }),
  },
  plugins: [
    require('tailwindcss-plugins/pagination'),
  ],
}