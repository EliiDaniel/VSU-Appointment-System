import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',        
        "./vendor/wireui/wireui/src/*.php",
        "./vendor/wireui/wireui/ts/**/*.ts",
        "./vendor/wireui/wireui/src/View/**/*.php",
        "./vendor/wireui/wireui/src/WireUi/**/*.php",
        "./vendor/wireui/wireui/src/resources/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            keyframes: {
                updown: {
                    'to': {
                      transform: 'translateY(-10px)',
                    },
                },
                downup: {
                    'to': {
                        transform: 'translateY(10px)',
                    },
                },
            },
            animation: {
                'updown': 'updown 2s ease-in infinite alternate-reverse',
                'downup': 'downup 2s ease-in infinite alternate-reverse',
            },
        },
    },

    plugins: [
        forms,
        require('tailwindcss-animated')
    ],
};
