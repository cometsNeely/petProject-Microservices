import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import path from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js'],
            refresh: true,
        }),
        vue(),
    ],
    server: {
        hmr: {
            clientPort: 5173,
            host: 'localhost' // for dev
        }
    },
    resolve: {
        alias: {
            '@': path.resolve(__dirname, 'resources/js/src')
        },
    }
});