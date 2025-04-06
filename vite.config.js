
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel([
            'resources/css/app.css',
            'resources/js/app.js',
        ]),
    ],


  server: {
    hmr: {
        overlay: false,  // This will disable the overlay for HMR errors
    },
},

});



