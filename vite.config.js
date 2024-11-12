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
                'resources/js/main.js',

                // filters
                'resources/js/filters/prices/pricesFilter.js',
                'resources/js/filters/contacts/contactsFilter.js',

                // forms
                'resources/js/forms/reviewForm.js'
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
