import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
 
export default defineConfig({
    plugins: [
        laravel({refresh:true,input:[
            'resources/css/app.css','resources/sass/app.scss',
            'resources/js/app.js',
           
        ]},),
    ],
});
/* [
    'resources/css/app.css',
    'resources/js/app.js',
   
] */