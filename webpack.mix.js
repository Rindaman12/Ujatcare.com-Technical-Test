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

 mix
 // 
 // Vue instances
     .js('resources/js/welcome.js', 'public/js')
     .js('resources/js/app.js', 'public/js')

 
 // Styles
     .sass('resources/sass/app.scss', 'public/css')
     .sass('resources/sass/welcome.scss', 'public/css')
 
 // Compilation Options
     .options({
         processCssUrls: false
     })
     .vue();