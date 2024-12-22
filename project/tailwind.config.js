import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            textStrokeWidth: {
                '1': '1px',
                '2': '2px',
            },
            textStrokeColor: {
                'white': '#FFF',
            },
        },
    },

    plugins: [
        forms,
        function ({ addUtilities }) {
            const newUtilities = {
                '.text-stroke-1': {
                    '-webkit-text-stroke-width': '1px',
                },
                '.text-stroke-2': {
                    '-webkit-text-stroke-width': '2px',
                },
                '.text-stroke-white': {
                    '-webkit-text-stroke-color': '#FFF',
                },
            }
            addUtilities(newUtilities, ['responsive', 'hover'])
        }
    ],
};