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
    .js('resources/assets/js/entry/photo/edit.js', 'public/dist/js/photo')
    .js('resources/assets/js/entry/photo/show.js', 'public/dist/js/photo')
    .js('resources/assets/js/entry/top/index.js', 'public/dist/js/top')
    .js('resources/assets/js/entry/top/about.js', 'public/dist/js/top')
    .js('resources/assets/js/entry/top/inquiry.js', 'public/dist/js/top')
    .js('resources/assets/js/entry/top/kiyaku.js', 'public/dist/js/top')
    .js('resources/assets/js/entry/top/privacy.js', 'public/dist/js/top')
    .js('resources/assets/js/entry/anime/show.js', 'public/dist/js/anime')
    .js('resources/assets/js/entry/anime/index.js', 'public/dist/js/anime')
    .js('resources/assets/js/entry/user/show.js', 'public/dist/js/user')
    .sass('resources/assets/sass/entry/anime/index.scss', 'public/dist/css/anime')
    .sass('resources/assets/sass/entry/anime/show.scss', 'public/dist/css/anime')
    .sass('resources/assets/sass/entry/photo/create.scss', 'public/dist/css/photo')
    .sass('resources/assets/sass/entry/photo/edit.scss', 'public/dist/css/photo')
    .sass('resources/assets/sass/entry/photo/show.scss', 'public/dist/css/photo')
    .sass('resources/assets/sass/entry/top/about.scss', 'public/dist/css/top')
    .sass('resources/assets/sass/entry/top/index.scss', 'public/dist/css/top')
    .sass('resources/assets/sass/entry/top/kiyaku.scss', 'public/dist/css/top')
    .sass('resources/assets/sass/entry/top/privacy.scss', 'public/dist/css/top')
    .sass('resources/assets/sass/entry/top/inquiry.scss', 'public/dist/css/top')
    .sass('resources/assets/sass/entry/user/show.scss', 'public/dist/css/user');

if (mix.inProduction()) {
  mix.version();
}
