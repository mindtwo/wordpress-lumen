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
 | Additional Options
 |--------------------------------------------------------------------------
 */
var bower_path = '../bower_components/';
var npm_path = '../../../node_modules/';


/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 */
elixir(function(mix) {
    mix.sass('app.scss').browserify('app.js', elixir.config.assetsPath + '/js/compiled/app.compiled.js').scripts([
            npm_path+'jquery/dist/jquery.min.js',
            npm_path+'bootstrap-sass/assets/javascripts/bootstrap.min.js',
            npm_path+'jquery.scrollTo/jquery.scrollTo.min.js',
            npm_path+'jquery.localScroll/jquery.localScroll.min.js',
            npm_path+'fancybox/source/jquery.fancybox.pack.js',
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