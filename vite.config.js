import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';
import {viteStaticCopy} from "vite-plugin-static-copy";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/assets/css/app.css',
                'resources/assets/js/app.js',
                // 'resources/assets/js/form-validation.js',    s',
                // 'resources/assets/images/logo/favicon.ico',
                // 'resources/assets/images/logo/small-logo.png',
                'resources/assets/mv/plugins.bundle.css',
                'resources/assets/mv/style.bundle.css',
                // 'resources/assets/css/common.css',
                'resources/assets/css/datatables.bundle.css',
                'resources/assets/js/theme-mode.js',
                // 'resources/assets/js/sweetalert.min.js',
            ],
            refresh: true,
        }),
        viteStaticCopy({
            targets: [
                {
                    src: 'resources/assets/mv/datatable/datatables.bundle.js',
                    dest: 'mv/'
                },
                {
src: 'resources/assets/mv/plugins.bundle.js',
                    dest: 'mv/'
                },
                {
                    src:'resources/assets/mv/scripts.bundle.js',
                    dest: 'mv/'
                }
            ]
        })
    ],
});
