var gulp         = require('gulp'),
    concat       = require('gulp-concat'),
    sass         = require('gulp-sass'),
    autoprefix   = require('gulp-autoprefixer'),
    uglify       = require('gulp-uglify'),
    imagemin     = require('gulp-imagemin'),
    plumber      = require('gulp-plumber'),
    rename       = require('gulp-rename'),
    notify       = require('gulp-notify'),
    watch        = require('gulp-watch'),
    livereload   = require('gulp-livereload'),
    del          = require('del'),
    newer        = require('gulp-newer');

var scripts_src = [
    'node_modules/foundation-sites/dist/js/foundation.js',
    'assets/src/scripts/app.js'
];
var scripts_dist = 'assets/dist/scripts';
var images_src = 'assets/src/images/**/*.{png,jpg,gif,svg}';
var images_dist = 'assets/dist/images';
var styles_src = [
    'assets/src/scss/**/*.scss'
];
var styles_paths = [
    'node_modules/font-awesome/scss',
    'node_modules/foundation-sites/scss',
    'assets/src/scss'
];
var styles_dist = 'assets/dist/stylesheets';

var plumberErrorHandler = { errorHandler: notify.onError({
    title: 'Gulp',
    message: 'Error: <%= error.message %>'
})};

gulp.task('default', [
    'images',
    'scripts',
    'styles',
    'watch'
]);

gulp.task('cache:clear', function() {
    del(['./var/**/*']);
});

gulp.task('images', function(){
    gulp.src(images_src).pipe(plumber(plumberErrorHandler))
        .pipe(rename({ suffix: '.min' }))
        .pipe(newer(images_dist))
        .pipe(imagemin({
            optimizationLevel:  7,
            progressive:        true,
            interlaced:         true,
            multipass:          true
        }))
        .pipe(gulp.dest(images_dist))
        .pipe(livereload());
});

gulp.task('scripts', function(){
    // app
    gulp.src(scripts_src)
        .pipe(concat('app.js'))
        .pipe(plumber(plumberErrorHandler))
        .pipe(rename({ suffix: '.min' }))
        .pipe(uglify())
        .pipe(gulp.dest(scripts_dist));

    // app debug
    gulp.src(scripts_src)
        .pipe(concat('app.js'))
        .pipe(plumber(plumberErrorHandler))
        .pipe(rename({ suffix: '-debug' }))
        .pipe(gulp.dest(scripts_dist));
});

gulp.task('styles', function(){
    // minified
    gulp.src(styles_src).pipe(plumber(plumberErrorHandler))
        .pipe(sass({
            style:          "compressed",
            includePaths:   styles_paths,
            comments:       true,
            sourceComments: false
        }))
        .pipe(autoprefix('last 4 version'))
        .pipe(gulp.dest(styles_dist));

    // debug
    gulp.src(styles_src).pipe(plumber(plumberErrorHandler))
        .pipe(sass({
            style:          "expanded",
            includePaths:   styles_paths,
            comments:       true,
            sourceComments: true
        }))
        .pipe(rename({ suffix: '-debug' }))
        .pipe(autoprefix('last 4 version'))
        .pipe(gulp.dest(styles_dist))
        .pipe(livereload());
});

gulp.task('watch', function(){
    livereload.listen();
    gulp.watch(images_src, ['images']);
    gulp.watch(scripts_src, ['scripts']);
    gulp.watch(styles_src, ['styles']);
});
