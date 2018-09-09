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

mix.js('resources/assets/js/common/base.js', 'public/dist/js/common')
    .js('resources/assets/js/photo/show.js', 'public/dist/js/photo')
    .sass('resources/assets/sass/app.scss', 'public/dist/css');
