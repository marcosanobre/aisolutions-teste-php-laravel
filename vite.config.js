import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/js/app.js','resources/css/app.css','resources/css/datagrid.css'],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            $: 'jquery',
            jQuery: 'jquery',
        },
    },
});
