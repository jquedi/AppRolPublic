module.exports = {
  purge: ['./index.html', './src/**/*.{vue,js,ts,jsx,tsx}'],
  darkMode: false, // or 'media' or 'class'
  theme: {
      zIndex: {
        '0': 0,
       '10': 10,
       '20': 20,
       '30': 30,
       '40': 40,
       '50': 50,
       '60': 60,
       '70': 70,
       '75': 75,
       '80': 80,
       '90': 90,
       '100': 100,
        'auto': 'auto',
      },
    extend: {
      gridTemplateRows: {
        '10': 'repeat(10, minmax(0, 1fr))',
        '12': 'repeat(12, minmax(0, 1fr))',
        '20': 'repeat(20, minmax(0, 1fr))'
      },
      gridRow: {
        'span-9': 'span 9 / span 9',
        'span-10': 'span 10 / span 10',
        'span-18': 'span 18 / span 18'
      },        
      gridRowStart: {
        '18': '18',
        '19': '19',
        '10': '10',
        '11': '11',
        '12': '12',
        '13': '13',
       },        
       gridRowEnd: {
         '18': '18',
         '19': '19',
         '20': '20',
         '11': '11',
         '12': '12',
         '13': '13',
        },
      gridTemplateColumns: {
        '20': 'repeat(20, minmax(0, 1fr))',
        '25': 'repeat(25, minmax(0, 1fr))'
      },
      gridColumn: {
        'span-18': 'span 18 / span 18',
      },
      gridColumnStart: {
       '13': '13',
       '14': '14',
       '15': '15',
       '16': '16',
       '17': '17',
      },
      minHeight: {
        '8': '2rem',
        '20': '5rem',
        '32': '8rem',
        '16': '4rem',
        '80%': '80%',
        '20%': '20%',
        '56': '12rem'
      },
      maxHeight: {
        '20': '5rem',
        '16': '4rem',
        '78px': '78px',
        '80%': '80%',
        '20%': '20%',
      },
      height: {
        '9vw': '9vw',
        '5vw': '5vw',
        '3vw': '3vw',
        '2px': '2px',
        '7px': '7px',
        '78px': '78px',
        '10%': '10%',
        '20%': '20%',
        '30%': '30%',
        '40%': '40%',
        '50%': '50%',
        '60%': '60%',
        '80%': '80%',
        '5%': '5%',
        'content': 'fit-content',
        'calc1': 'calc(100% - 1.5rem)',
        'calc2': 'calc(100% - 7rem)',
      },
      minWidth: {
        'content': 'fit-content',
        '1': '1rem',
        '8': '2rem',
        '10': '2.5rem',
        '20': '5rem',
        '16': '4rem',
        '56': '12rem',
        '2/5': '40%',
        '1/4': '25%',
        '1/5': '20%',
        '1/2': '50%',
        '100px': '100px',
        '120px': '120px',
        '200px': '200px',
        '250px': '250px',
        '470px': '470px',
        '640px': '640px'
      },
      maxWidth: {
        'content': 'fit-content',
        '10': '2.5rem',
        '80': '20rem',
        '20': '5rem',
        '16': '4rem',
        '1/4': '25%',
        '1/2': '50%',
        '2/5': '40%',
        '120px': '120px',
        '500px': '500px',
        '800px': '800px'
      },
      width: {
        '10%': '10%',
        '5%': '5%',
        '47.5%': '47.5%',
        '10%': '10%',
        '20%': '20%',
        '30%': '30%',
        '40%': '40%',
        '50%': '50%',
        '60%': '60%',
        '80%': '80%',
        '5vw': '5vw',
        '3vw': '3vw',
        '60px': '60px',
        'content': 'fit-content'
      },
      inset: {
        'calc1': 'calc(100% + 7px)',
        '-7px': '-7px',
        '7px': '7px',
        '6px': '6px',
        '5px': '5px',
        '10%': '10%',
        '90%': '90%',
        '8%': '8%',
        '5%': '5%',
      },
      rotate: {
        '135': '135deg',
        '-135': '-135deg'
      },
      transitionProperty: {
        'slide': 'left, right, top, bottom',
        'resize': 'width, height',
      },
      transitionDelay: {
       '0': '0ms',
      },
      spacing: {
        '1/8': '12.5%',
        '4/5': '80%',
        '5%': '5%',
        'min(20px,5%)': 'min(20px, 5%)'
      },
      zIndex: {
        '-1': -1,
      }
    },
  },
  variants: {
    extend: {
      opacity: ['hover'],
    },
  },
  plugins: [
    require('tailwind-scrollbar'),
  ],
}
