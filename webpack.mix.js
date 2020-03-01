const mix = require('laravel-mix');

// Extend Mix with the "i18n" method, that loads the vue-i18n-loader
mix.extend('i18n', new class {
    webpackRules() {
        return [{
            resourceQuery: /blockType=i18n/,
            type: 'javascript/auto',
            loader: '@kazupon/vue-i18n-loader',
        }, ];
    }
}(), );

mix.options({
    hmrOptions: {
        host: 'caddy.dev',
        port: '8080'
    }
});

// Call the .i18n() (to load the loader) before .js(..., ...)
mix.i18n()
    .js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');
