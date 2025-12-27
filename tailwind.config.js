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
                // Modern Professional Blue - Primary Brand Color
                primary: {
                    50: '#eff6ff',
                    100: '#dbeafe',
                    200: '#bfdbfe',
                    300: '#93c5fd',
                    400: '#60a5fa',
                    500: '#2563eb',  // Modern vibrant blue
                    600: '#1d4ed8',  // Professional deep blue
                    700: '#1e40af',
                    800: '#1e3a8a',
                    900: '#1a2847',  // Dark navy for headers
                    950: '#0f172a',  // Almost black for text
                },
                // Vibrant Teal/Cyan - Secondary Color
                secondary: {
                    50: '#ecfeff',
                    100: '#cffafe',
                    200: '#a5f3fc',
                    300: '#67e8f9',
                    400: '#22d3ee',
                    500: '#06b6d4',  // Vibrant teal
                    600: '#0891b2',
                    700: '#0e7490',
                    800: '#155e75',
                    900: '#164e63',
                },
                // Vibrant Coral/Orange - Accent/CTA Color
                accent: {
                    50: '#fff7ed',
                    100: '#ffedd5',
                    200: '#fed7aa',
                    300: '#fdba74',
                    400: '#fb923c',
                    500: '#f97316',  // Vibrant orange
                    600: '#ea580c',
                    700: '#c2410c',
                    800: '#9a3412',
                    900: '#7c2d12',
                },
                // Success Green
                success: {
                    50: '#f0fdf4',
                    100: '#dcfce7',
                    200: '#bbf7d0',
                    300: '#86efac',
                    400: '#4ade80',
                    500: '#22c55e',
                    600: '#16a34a',
                    700: '#15803d',
                    800: '#166534',
                    900: '#14532d',
                },
                // Warning Yellow
                warning: {
                    50: '#fffbeb',
                    100: '#fef3c7',
                    200: '#fde68a',
                    300: '#fcd34d',
                    400: '#fbbf24',
                    500: '#f59e0b',
                    600: '#d97706',
                    700: '#b45309',
                    800: '#92400e',
                    900: '#78350f',
                },
                // Danger Red
                danger: {
                    50: '#fef2f2',
                    100: '#fee2e2',
                    200: '#fecaca',
                    300: '#fca5a5',
                    400: '#f87171',
                    500: '#ef4444',
                    600: '#dc2626',
                    700: '#b91c1c',
                    800: '#991b1b',
                    900: '#7f1d1d',
                },
                // Professional Dark Grays
                dark: {
                    50: '#f8fafc',
                    100: '#f1f5f9',
                    200: '#e2e8f0',
                    300: '#cbd5e1',
                    400: '#94a3b8',
                    500: '#64748b',
                    600: '#475569',
                    700: '#334155',
                    800: '#1e293b',
                    900: '#0f172a',
                }
            },
            fontFamily: {
                sans: ['Inter', 'Source Sans Pro', ...defaultTheme.fontFamily.sans],
                display: ['Poppins', 'Inter', ...defaultTheme.fontFamily.sans],
                serif: ['Playfair Display', 'Merriweather', ...defaultTheme.fontFamily.serif],
            },
            backgroundImage: {
                'gradient-primary': 'linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%)',
                'gradient-secondary': 'linear-gradient(135deg, #06b6d4 0%, #0891b2 100%)',
                'gradient-accent': 'linear-gradient(135deg, #f97316 0%, #ea580c 100%)',
                'gradient-dark': 'linear-gradient(135deg, #1e293b 0%, #0f172a 100%)',
                'gradient-hero': 'linear-gradient(135deg, #1e3a8a 0%, #2563eb 50%, #06b6d4 100%)',
            },
            boxShadow: {
                'soft': '0 2px 15px -3px rgba(0, 0, 0, 0.07), 0 10px 20px -2px rgba(0, 0, 0, 0.04)',
                'medium': '0 4px 25px -3px rgba(0, 0, 0, 0.1), 0 15px 30px -5px rgba(0, 0, 0, 0.08)',
                'strong': '0 10px 40px -3px rgba(0, 0, 0, 0.15), 0 20px 50px -8px rgba(0, 0, 0, 0.12)',
                'colored': '0 10px 40px -5px rgba(37, 99, 235, 0.25)',
            }
        },
    },

    plugins: [forms],
};
