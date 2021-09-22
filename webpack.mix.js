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

mix.copy('resources/js/profile.js', 'public/js')
    .copy('resources/js/image.js', 'public/js')
    .copy('resources/js/user.js', 'public/js')
    .copy('resources/js/upload.js', 'public/js')
    .copy('resources/js/admin.js', 'public/js')
    .copy('resources/js/header.js', 'public/js')
    .copy('resources/js/search.js', 'public/js')
    .copy('resources/js/edit.js', 'public/js')
    .copy('resources/js/modal.js', 'public/js')
    .copy('resources/js/navbar.js', 'public/js')
    .copy('resources/js/dataChart.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .css('resources/css/style.css', 'public/css')
    .css('resources/css/button.css', 'public/css')
    .css('resources/css/upload.css', 'public/css')
    .css('resources/css/admin.css', 'public/css')
    .css('resources/css/error.css', 'public/css')
    .vue();
