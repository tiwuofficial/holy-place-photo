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

mix.js('resources/assets/js/entry/photo/create.js', 'public/dist/js/photo')
    .js('resources/assets/js/entry/photo/show.js', 'public/dist/js/photo')
    .sass('resources/assets/sass/entry/anime/index.scss', 'public/dist/css/anime')
    .sass('resources/assets/sass/entry/anime/show.scss', 'public/dist/css/anime')
    .sass('resources/assets/sass/entry/photo/create.scss', 'public/dist/css/photo')
    .sass('resources/assets/sass/entry/photo/edit.scss', 'public/dist/css/photo')
    .sass('resources/assets/sass/entry/photo/show.scss', 'public/dist/css/photo')
    .sass('resources/assets/sass/entry/top/about.scss', 'public/dist/css/top')
    .sass('resources/assets/sass/entry/top/guide.scss', 'public/dist/css/top')
    .sass('resources/assets/sass/entry/top/index.scss', 'public/dist/css/top')
    .sass('resources/assets/sass/entry/top/inquiry.scss', 'public/dist/css/top')
    .sass('resources/assets/sass/entry/user/show.scss', 'public/dist/css/user');
