import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import vueJsx from '@vitejs/plugin-vue-jsx';

const path = require('path');

function resolve(dir) {
    return path.join(__dirname + '/resources/js', dir);
}

module.exports = ({mode}) => {
    return defineConfig({
        plugins: [
            vue(),
            vueJsx(),
            laravel({
                input: ['resources/css/app.css', 'resources/js/app.js'],
                refresh: true,
            }),
        ],
        resolve: {
            dedupe: ['vue'],
            alias: {
                '@': resolve('src'),
                '@components': resolve('src/components'),
            }
        },
        build: {
            outDir: '../../public/static/build',
            assetsDir: '/application-core/manage',
            manifest: true,
            emptyOutDir: true,
        },
        server: {
            host: '0.0.0.0',
            port: 3000
        }
    });
};
