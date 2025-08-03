import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    server: {
        //host: '127.0.0.1',
        host: '0.0.0.0',
        port: 5173,
        hmr: {
            host: 'localhost', //'127.0.0.1',
            protocol: 'ws',
        },
    },
    plugins: [
        laravel({
            input: ['resources/js/app.js'],
            refresh: true,
        }),
    ],
});