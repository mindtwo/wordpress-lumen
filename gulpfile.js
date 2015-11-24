var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Path Configuration
 |--------------------------------------------------------------------------
 */

elixir.config.assetsPath = 'resources/assets';
elixir.config.css.sass.folder = 'sass';
elixir.config.css.outputFolder = 'content/themes/default/assets/css';
elixir.config.js.outputFolder = 'content/themes/default/assets/js';
elixir.config.versioning.buildFolder = '';


/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 */

elixir(function(mix) {
    mix.sass('app.scss').browserify('app.js', elixir.config.assetsPath + '/js/compiled/app.compiled.js').scripts([
            '../bower_components/jquery/dist/jquery.min.js',
            '../bower_components/jquery-migrate/jquery-migrate.min.js',
            '../bower_components/bootstrap-sass/assets/javascripts/bootstrap.min.js',
            '../bower_components/jquery.scrollTo/jquery.scrollTo.min.js',
            '../bower_components/jquery.localScroll/jquery.localScroll.min.js',
            '../bower_components/fancybox/source/jquery.fancybox.pack.js',
            'compiled/app.compiled.js'
        ])
        // .browserSync({
        //     proxy: "domain.de.local"
        // })
        .version([
            '/' + elixir.config.css.outputFolder + '/app.css',
            '/' + elixir.config.js.outputFolder + '/all.js'
        ]);
});