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
            colors: {
                brand: {
                    50:  '#fff7ed',
                    100: '#ffedd5',
                    200: '#fed7aa',
                    300: '#fdba74',
                    400: '#fb923c',
                    500: '#f97316',
                    600: '#ea580c',
                    700: '#c2410c',
                    800: '#9a3412',
                    900: '#7c2d12',
                    950: '#431407',
                },
            },
            animation: {
                'fade-in-up':    'fadeInUp 0.7s ease-out both',
                'fade-in':       'fadeIn 0.5s ease-out both',
                'slide-in-left': 'slideInLeft 0.7s ease-out both',
                'slide-in-right':'slideInRight 0.7s ease-out both',
                'scale-in':      'scaleIn 0.5s ease-out both',
                'float':         'float 4s ease-in-out infinite',
                'pulse-ring':    'pulseRing 2s cubic-bezier(0.215,0.61,0.355,1) infinite',
                'shimmer':       'shimmer 1.5s linear infinite',
            },
            keyframes: {
                fadeInUp: {
                    '0%':   { opacity: '0', transform: 'translateY(32px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                },
                fadeIn: {
                    '0%':   { opacity: '0' },
                    '100%': { opacity: '1' },
                },
                slideInLeft: {
                    '0%':   { opacity: '0', transform: 'translateX(-32px)' },
                    '100%': { opacity: '1', transform: 'translateX(0)' },
                },
                slideInRight: {
                    '0%':   { opacity: '0', transform: 'translateX(32px)' },
                    '100%': { opacity: '1', transform: 'translateX(0)' },
                },
                scaleIn: {
                    '0%':   { opacity: '0', transform: 'scale(0.88)' },
                    '100%': { opacity: '1', transform: 'scale(1)' },
                },
                float: {
                    '0%, 100%': { transform: 'translateY(0px)' },
                    '50%':      { transform: 'translateY(-12px)' },
                },
                pulseRing: {
                    '0%':   { transform: 'scale(0.95)', boxShadow: '0 0 0 0 rgba(249,115,22,0.5)' },
                    '70%':  { transform: 'scale(1)',    boxShadow: '0 0 0 12px rgba(249,115,22,0)' },
                    '100%': { transform: 'scale(0.95)', boxShadow: '0 0 0 0 rgba(249,115,22,0)' },
                },
                shimmer: {
                    '0%':   { backgroundPosition: '-200% 0' },
                    '100%': { backgroundPosition: '200% 0' },
                },
            },
        },
    },

    plugins: [forms],
};
