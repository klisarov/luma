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
            colors: {
                // Base surfaces
                ink: {
                    950: '#0B0D13', // page background
                    900: '#12141C', // base bg
                    800: '#1B1E2A', // card / surface
                    700: '#262A3A', // raised surface, hover
                    600: '#3A3F55', // borders
                },
                // "Luma" glow — the signature accent
                glow: {
                    DEFAULT: '#F5B942',
                    soft: '#FFD98A',
                    dim: '#8A6A2E',
                },
                // Secondary category accent
                violet: {
                    DEFAULT: '#8B87F5',
                    soft: '#C4C2FA',
                },
                // Completion / success state
                sage: {
                    DEFAULT: '#34D399',
                    dim: '#1F6D53',
                },
                paper: '#EDEBE4', // primary text on dark surfaces (warm off-white, not pure white)
                muted: '#9498AC',
            },
            fontFamily: {
                display: ['"Space Grotesk"', ...defaultTheme.fontFamily.sans],
                sans: ['"Inter"', ...defaultTheme.fontFamily.sans],
                mono: ['"JetBrains Mono"', ...defaultTheme.fontFamily.mono],
            },
            boxShadow: {
                glow: '0 0 40px -8px rgba(245, 185, 66, 0.35)',
                'glow-sm': '0 0 20px -6px rgba(245, 185, 66, 0.3)',
            },
            borderRadius: {
                xl2: '1.25rem',
            },
        },
    },

    plugins: [forms],
};