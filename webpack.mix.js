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

// mix.js('resources/js/app.js', 'public/js')
//     .sass('resources/sass/app.scss', 'public/css');

mix.copy('node_modules/ionicons/dist/', 'public/icons/ionicons');


mix.copy('node_modules/@fortawesome/fontawesome-free/css/*', 'public/icons/fontawesome/css');
mix.copy('node_modules/@fortawesome/fontawesome-free/webfonts/*', 'public/icons/fontawesome/webfonts');
mix.copy('node_modules/@fortawesome/fontawesome-free/svgs/*', 'public/icons/fontawesome/svgs');
mix.copy('node_modules/@fortawesome/fontawesome-free/sprites/*', 'public/icons/fontawesome/sprites');

mix.copy('node_modules/jquery-confirm/css/*', 'public/backend/lib/jquery-confirm/css');
mix.copy('node_modules/jquery-confirm/dist/*', 'public/backend/lib/jquery-confirm/dist');
mix.copy('node_modules/jquery-confirm/js/*', 'public/backend/lib/jquery-confirm/js');
