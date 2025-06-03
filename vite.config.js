import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';


export default defineConfig({
    plugins: [
        laravel({
            /*  input: ['resources/css/app.css', 'resources/js/app.js', 'resources/css/vendor/filament/theme.css'],  */
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/filament-custom.css',
                'resources/js/fullcalendar.js',
            ],

            refresh: true,
        }),
        tailwindcss(),
    ],
});
