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
            width: {
                '1/8': '12.5%',
                '1/16': '6.25%',
            },
            colors: {
                customYellow: '#D4E300',
            },
        },
    },

    plugins: [forms],
};
