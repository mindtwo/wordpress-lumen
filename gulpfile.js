var gulp = require('gulp'),
    minifycss = require('gulp-minify-css'),
    concat = require('gulp-concat'),
    uglify = require('gulp-uglify'),
    rename = require('gulp-rename'),
    autoprefixe = require('gulp-autoprefixer'),
    sass = require('gulp-ruby-sass'),
    runSequence = require('run-sequence'),
    s3 = require('aws-publisher'),
    chmod = require('gulp-chmod'),
    gzip = require('gulp-gzip');

var source_assets_dir = 'resources/assets/';
var public_assets_dir = 'public/content/themes/default/assets/';

var paths = {
    bower: {
        components: source_assets_dir+'bower_components/'
    },
    scripts: {
        original: source_assets_dir+'js/',
        vendor: source_assets_dir+'js/vendor/',
        output: public_assets_dir + 'js',
        watch: source_assets_dir+'js/**/*.js'
    },
    styles: {
        original: source_assets_dir+'sass/',
        output: public_assets_dir + 'css',
        watch: source_assets_dir+'sass/**/*.scss',
        compiled_bower_components: 'sass/components/libs/'
    },
    images: {
        watch: public_assets_dir + 'images/**/*'
    },
    fonts: {
        watch: public_assets_dir + 'fonts/**/*'
    }
};

// CDN active?
var isCDNisActive = false;

// create a new publisher
if(isCDNisActive) {
    var publisher = new s3({bucket: 'cdn.sample.com',  key: '', secret: '', region: "eu-west-1"});
}

// define filter closure that will only select js, png, and css file
function filter (f, stat) {
    return stat.isDirectory() || /\.(js|png|css|gif|swf|jpg|svg|woff|ttf|otf|eot|gz)$/.test(f);
}


gulp.task('scripts', function() {
    return gulp.src([
        paths.bower.components+'jquery/dist/jquery.min.js',
        paths.bower.components+'jquery-migrate/jquery-migrate.min.js',
        paths.bower.components+'bootstrap-sass/assets/javascripts/bootstrap.min.js',
        paths.bower.components+'jquery.scrollTo/jquery.scrollTo.min.js',
        paths.bower.components+'jquery.localScroll/jquery.localScroll.min.js',
        paths.bower.components+'fancybox/source/jquery.fancybox.pack.js',
        paths.bower.components+'vue/dist/vue.min.js',
        paths.scripts.original+'main.js'
    ])
    .pipe(uglify())
    .pipe(concat('bundle.min.js'))
    .pipe(chmod(776))
    .pipe(gulp.dest(paths.scripts.output))
    .pipe(gzip({ append: true }))
    .pipe(gulp.dest(paths.scripts.output));
});

gulp.task('styles', function() {
    return sass(paths.styles.original, { style: 'expanded', 'sourcemap=none': true })
        .pipe(autoprefixe('last 20 versions'))
        .pipe(minifycss({'keepSpecialComments':0}))
        .pipe(rename({suffix: '.min'}))
        .pipe(chmod(776))
        .pipe(gulp.dest(paths.styles.output));
});

gulp.task('build_css', function(callback) {
    return runSequence('styles','publish_css', callback);
});

gulp.task('build_js', function(callback) {
    return runSequence('scripts','publish_js', callback);
});

gulp.task('publish_all', function() {
    if(!isCDNisActive) {return false;}
    publisher.publishDir({origin: public_assets_dir + 'css', dest: '/website/assets/css', filter: filter});
    publisher.publishDir({origin: public_assets_dir + 'fonts', dest: '/website/assets/fonts', filter: filter});
    publisher.publishDir({origin: public_assets_dir + 'js', dest: '/website/assets/js', filter: filter});
    publisher.publishDir({origin: public_assets_dir + 'images', dest: '/website/assets/images', filter: filter});
});

gulp.task('publish_css', function() {
    if(!isCDNisActive) {return false;}
    publisher.publishDir({origin: public_assets_dir + 'css', dest: '/website/assets/css', filter: filter});
});

gulp.task('publish_js', function() {
    if(!isCDNisActive) {return false;}
    publisher.publishDir({origin: public_assets_dir + 'js', dest: '/website/assets/js', filter: filter});
});

gulp.task('generate_bower_scss_component_files', function() {
    var files = [
        // paths.bower.components + 'example_package/core.css',
    ];

    if(files.length > 0) {
        return gulp.src(files)
            .pipe(rename(function(path){
                path.basename = '_'+path.basename;
                path.extname = ".scss";
            }))
            .pipe(gulp.dest(paths.styles.compiled_bower_components));
    }
});

gulp.task('watch', function () {
    // Return the task when a file changes or added
    gulp.watch(paths.styles.watch, ['build_css']);
    gulp.watch(paths.scripts.watch, ['build_js']);
    gulp.watch(paths.images.watch, ['publish_all']);
    gulp.watch(paths.fonts.watch, ['publish_all']);
});

gulp.task('default', ['generate_bower_scss_component_files','build_css','build_js','publish_all','watch']);