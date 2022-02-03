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

mix.js('resources/assets/js/bookings.js', 'public/js'); //.sass('resources/assets/sass/app.scss', 'public/css');
mix.js('resources/assets/js/invoice.js', 'public/js'); //.sass('resources/assets/sass/app.scss', 'public/css');
mix.js('resources/assets/js/registerBedroom.js', 'public/js'); //.sass('resources/assets/sass/app.scss', 'public/css');
mix.js('resources/assets/js/preloader.js', 'public/js'); //.sass('resources/assets/sass/app.scss', 'public/css');
mix.js('resources/assets/js/listBedrooms.js', 'public/js'); //.sass('resources/assets/sass/app.scss', 'public/css');
mix.js('resources/assets/js/listBookings.js', 'public/js'); //.sass('resources/assets/sass/app.scss', 'public/css');
mix.js('resources/assets/js/checkin.js', 'public/js'); //.sass('resources/assets/sass/app.scss', 'public/css');
mix.js('resources/assets/js/order.js', 'public/js'); //.sass('resources/assets/sass/app.scss', 'public/css');
mix.js('resources/assets/js/report.js', 'public/js'); //.sass('resources/assets/sass/app.scss', 'public/css');



//tutorial :: https://www.youtube.com/watch?v=UzegdHgNEF4&t=382s
//importante;
