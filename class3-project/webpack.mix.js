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
   .js('resources/js/chiamataApiCitta.js', 'public/js/chiamataApiCitta.js' )
   .js('resources/js/ricercaInterna.js', 'public/js/ricercaInterna.js' )
   .sass('resources/sass/app.scss', 'public/css')

   .sass('resources/sass/index.scss', 'public/css')
   .styles(['resources/sass/style.css'], 'public/css/style.css');
