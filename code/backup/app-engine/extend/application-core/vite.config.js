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
                refresh: [
                    'resources/js/**',
                    'src/Routes/**',
                    'resources/views/**',
                ],
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
            outDir: '../../public/build',
            assetsDir: './application-core/manage',
            manifest: true,
            emptyOutDir: true,
            rollupOptions: {
                output: {
                    // 在这里修改静态资源路径
                    chunkFileNames: 'static/assets/js/[name]-[hash].js',
                    entryFileNames: 'static/assets/js/[name]-[hash].js',
                    assetFileNames: 'static/assets/[ext]/[name]-[hash].[ext]',
                }
            }
        },
        server: {
            host: '0.0.0.0',
            port: 5173,
            watch: {
                usePolling: true,
            },
        }
    });
};
