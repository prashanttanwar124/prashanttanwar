const { sourceMaps } = require("laravel-mix");
const mix = require("laravel-mix");

mix.js("resources/js/admin/admin.js", "public/js/admin")
    .js("resources/js/website/website.js", "public/js/website")
    .vue()
    .sass("resources/sass/admin/app.scss", "public/css/admin/app.css")
    .sass("resources/sass/website/app.scss", "public/css/website/app.css");
