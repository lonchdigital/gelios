import { resolve } from 'path';
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    server: {
        port: 5173,
      },
    plugins: [
        laravel({
            input: [
                'resources/js/app.js',
                'resources/js/main.js'
            ],
            refresh: true,
        })
    ],
    resolve: {
        alias: {
            $fonts: resolve('./resources/fonts'),
        },
    },
});
