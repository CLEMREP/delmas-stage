import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/tailwind.css',
                'resources/css/multiform.css',
                'resources/css/style.css',
                'resources/js/app.js',
                'resources/js/init-alpine.js',
            ],
            refresh: true,
        }),
    ],
});
