/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.{html,js}",
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        screens: {
            'sm': '576px',
            'md': '768px',
            'lg': '992px',
            'xl': '1200px',
            '2xl': '1450px',
            '3xl': '1680px',
            'max-3xl': {'max': '1679px'},
            // => @media (max-width: 1679px) { ... }
            'max-2xl': {'max': '1449px'},
            // => @media (max-width: 1439px) { ... }
            'max-xl': {'max': '1199px'},
            // => @media (max-width: 1199px) { ... }
            'max-lg': {'max': '991px'},
            // => @media (max-width: 991px) { ... }
            'max-md': {'max': '767px'},
            // => @media (max-width: 768px) { ... }
            'max-sm': {'max': '575px'},
            // => @media (max-width: 575px) { ... }
        },
        backgroundSize: {
            '1/2': '50%'
        },

        colors: {
            transparent: 'transparent',
            current: 'currentColor',
            black: '#000000',
            white: '#ffffff',

//Custom Color


            'orange': {
                100: '#FF7D00',
                200: '#FA3836',
            },
            'grey': {
                100: '#e5e5e5',
                200: '#d0d0d0',
                400: '#c0c0c0',
                600: '#a8a8a8',

            },
            'red': '#ff0026',

        },
        fontFamily: {
            'base': ['Esteban'],
            'headline': ['Montserrat'],
        },
        fontWeight: {
            light: 200,
            normal: 400,
            semibold: 500,
            bold: 700,
        },

        //EXTEND
        extend: {
            colors: {
                'darkgrey': '#5e5e5e',
                'greymiddle': '#B2B3B5',
                'greylight': '#efefef',


                'pink': '#F91F5F',
                'pink--end': '#C7288B',
                'orange': '#FF7D00',
                'orange--end': '#FF4800',

                'melon': '#FF6E81',
                'melon--end': '#FF4361',
                'aqua': '#88D4E0',
                'aqua--end': '#4BBED0',
                'thiel': '#75CAC4',
                'thiel--end': '#54B0B6',

                //for status icons
                'red-status': {
                    100: '#FF0026',
                    200: 'rgba(255,0,38,0.25)',
                },

                'green-status': {
                    100: '#26b94a',
                    200: 'rgba(38,185,74,0.25)',
                },

                'yellow-status': {
                    100: '#ffae00',
                    200: 'rgba(255,174,0,0.25)',
                }

            },
            fontSize: {
                'h1': ['3.5rem', {
                    lineHeight: '66px',
                }],
                'h1-xs': ['2.5rem', {
                    lineHeight: '40px',
                }],
                'h2': ['2.5rem', {
                    lineHeight: '65px',
                }],
                'h2-xs': ['2rem', {
                    lineHeight: '35px',
                }],
                'h3': ['1.5rem', {
                    lineHeight: '38px',
                }],
                'h3-xs': ['1.5rem', {
                    lineHeight: '30px',
                }],
                'h4': ['1.5rem', {
                    lineHeight: '32px',
                }],
                'h4-xs': ['1.25rem', {
                    lineHeight: '24px',
                }],
            },
            gap: {
                '1': '10px',
                '2': '20px',
            },
            spacing: {
                '1': '10px',
                '2': '20px',
                '3': '30px',
                '4': '40px',
                '5': '50px',
                '6': '60px',
                '7': '70px',
                '8': '80px',
                '9': '90px',
                '10': '100px',
                '11': '110px',
                '12': '120px',
            },
            inset: {
                '1/10': '10%',
                '-1/10': '-10%',
                '1/5': '20%',
                '2/5': '40%',
                '3/5': '60%',
                '4/5': '80%',
                '1/12': '8.333333%',
                '2/12': '16.666667%',
                '3/12': '25%;',
                '4/12': '33.333333%',
                '5/12': '41.666667%',
                '6/12': '50%;',
                '7/12': '58.333333%',
                '8/12': '66.666667%;',
            },
            margin: {
                '1/12': '8.333333%',
                '2/12': '16.666667%',
                '3/12': '25%;',
                '4/12': '33.333333%',
                '5/12': '41.666667%',
                '6/12': '50%;',
                '7/12': '58.333333%',
                '8/12': '66.666667%;',
                '9/12': '75%;',
                '10/12': '83.333334%;',
                '11/12': '91.666667%;',
            },
            borderRadius: {
                'xs': '3px',
                'DEFAULT': '6px',
            },
            borderWidth: {
                '3': '3px',
            },
            zIndex: {
                '-1': -1,
                '100': 100,
                '1000': 1000,
                '1001': 10001
            },
        },
    },

    variants: {
        opacity: ['active'],
        transform: ['active'],
        translate: ['active'],
        rotate: ['active'],
    },


    plugins: [],
};

