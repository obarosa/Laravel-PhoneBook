const mix = require('laravel-mix');
// const bootstrap = require('bootstrap');
// import bootstrap from 'bootstrap'

mix.disableSuccessNotifications();

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/contact.js', 'public/js')
    .js('resources/js/user_contact.js', 'public/js')
    .js('resources/js/conflicts.js', 'public/js')
    .js('resources/js/csv_contact.js', 'public/js')
    .copy('resources/img', 'public/assets/images')
    .postCss('resources/css/style.css', 'public/css')
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
        require('autoprefixer'),
    ]);
