const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/chiamataApiCitta.js', 'public/js/chiamataApiCitta.js')
    .js('resources/js/ricercaInterna.js', 'public/js/ricercaInterna.js')
    .js('resources/js/common.js', 'public/js/common.js')
    .js('resources/js/dashboard.js', 'public/js')
    .js('resources/js/new_service.js', 'public/js')
    .js('resources/js/payment.js', 'public/js')
    .js('resources/js/search_address.js', 'public/js')
    .js('resources/js/stats.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    // .styles(['resources/sass/style.css'], 'public/css/style.css')
    .copyDirectory('resources/img', 'public/img');
