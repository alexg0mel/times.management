let mix = require('laravel-mix');

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

mix.setPublicPath('public/build')
    .setResourceRoot('build')
    .js('resources/assets/js/app.js', 'js')
    .js('resources/assets/js/userintask.js', 'js')
    .js('resources/assets/js/taskingroup.js', 'js')
    .js('resources/assets/js/inputtime.js', 'js')
    .js('resources/assets/js/userreport.js', 'js')
    .js('resources/assets/js/step.js', 'js')
    .sass('resources/assets/sass/app.scss', 'css')
    .version();

