import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',

                'resources/views/themes/katalogtoko/assets/css/main.css',
                'resources/views/themes/katalogtoko/assets/plugins/jqueryui/jquery-ui.css',

                'resources/views/themes/katalogtoko/assets/js/main.js',
                'resources/views/themes/katalogtoko/assets/plugins/jqueryui/jquery-ui.min.js',


                'resources/views/livewire/admin/assets/css/tabler.min.css',
                'resources/views/livewire/admin/assets/css/tabler-flags.min.css',
                'resources/views/livewire/admin/assets/css/tabler-payments.min.css',
                'resources/views/livewire/admin/assets/css/tabler-vendors.min.css',
                'resources/views/livewire/admin/assets/css/demo.min.css',
     
                'resources/views/livewire/admin/assets/js/demo-theme.min.js',
                'resources/views/livewire/admin/assets/libs/apexcharts/dist/apexcharts.min.js',
                'resources/views/livewire/admin/assets/libs/jsvectormap/dist/js/jsvectormap.min.js',
                'resources/views/livewire/admin/assets/libs/jsvectormap/dist/maps/world.js',
                'resources/views/livewire/admin/assets/libs/jsvectormap/dist/maps/world-merc.js',
                'resources/views/livewire/admin/assets/js/tabler.min.js',
            ],
            refresh: true,
        }),
    ],
});