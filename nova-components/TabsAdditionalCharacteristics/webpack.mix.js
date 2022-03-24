let mix = require('laravel-mix')
let tailwindcss = require('tailwindcss');

mix.setPublicPath('dist')
    .js('resources/js/field.js', 'js')
    .js('resources/js/tinymce.js', 'js')
    .sass('resources/sass/field.scss', 'css')
    .options({
        processCssUrls: false,
        postCss: [ tailwindcss('./tailwind.js') ],
    });
mix.copyDirectory('node_modules/tinymce/skins', 'dist/tinymce/skins');
