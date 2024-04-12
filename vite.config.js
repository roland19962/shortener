import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import { quasar, transformAssetUrls } from '@quasar/vite-plugin';

export default defineConfig({
    define: {
        __VUE_PROD_HYDRATION_MISMATCH_DETAILS__: 'true'
    },
    plugins: [
        laravel([
            'resources/sass/app.sass',
            'resources/js/app.js',
        ]),
        vue({
            template: {
                transformAssetUrls,
            },
        }),
        quasar(),
    ],
});
