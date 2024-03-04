let mix = require('laravel-mix');
mix.js('resources/js/app.js', 'dist/js').setPublicPath('dist').vue();
mix.sass('resources/sass/stylesheet.sass', 'dist/css');