import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',

    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*. blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                'primary': '#135bec',
                'primary-hover': '#0f4bc4',
                'background-light': '#f6f6f8',
                'background-dark': '#101622',
            },
            fontFamily: {
                sans: ['Lexend', ...defaultTheme.fontFamily.sans],
            },
            borderRadius: {
                'DEFAULT': '0.25rem',
                'lg': '0.5rem',
                'xl': '0.75rem',
                '2xl': '1rem',
                'full': '9999px',
            },
        },
    },

    plugins: [forms],
};