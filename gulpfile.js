/**
 * gulpfile.js
 * Gulp tasks to manage code building and deployment
 */
/**
 * Gulp and NPM modules
 * @type {gulp}
 */
var gulp = require('gulp-param')(require('gulp'), process.argv),
    watch = require('gulp-watch'),
    header = require('gulp-header'),
    less = require('gulp-less'),
    csso = require('gulp-csso'),
    concat = require('gulp-concat'),
    uglify = require('gulp-uglify');

var exec = require('child_process').exec,
    fs = require('fs'),
    merge = require('merge-stream');

/**
 * Assets to build
 * @type {Object}
 */
var assets = JSON.parse(fs.readFileSync('./assets.json'));
var buildTask = ['css-public', 'js-public', 'css-admin', 'js-admin'];

/**
 * Banner to prepend to css and js files on build
 * @type {string}
 */
var banner = [
    '/**',
    ' * Copyright (C) 2017 - Escola.fr ',
    ' * Written with love by Mathieu Bour',
    ' */',
    ''
].join('\n');

/**
 * Build css based on assets.json directives
 * @param {string} section
 */
function buildCss(section) {
    var lessStream = gulp.src(assets['less'][section])
        .pipe(less())
        .pipe(concat(section + '-less.less'));

    var cssStream = gulp.src(assets['css'][section])
        .pipe(concat(section + '-css.css'));

    return merge(lessStream, cssStream)
        .pipe(concat(section + '.css'))
        .pipe(gulp.dest('webroot/css'));
}

/**
 * Build js based on assets.json directives
 * @param {string} section
 */
function buildJs(section) {
    return gulp.src(assets['js'][section])
        .pipe(concat(section + '.js'))
        .pipe(gulp.dest('webroot/js/'));
}

/*= CSS
 *=====================================================*/
gulp.task('css-public', function () {
    return buildCss('public');
});
gulp.task('css-admin', function () {
    return buildCss('admin');
});

/*= JS
 *=====================================================*/
gulp.task('js-public', function () {
    return buildJs('public');
});
gulp.task('js-admin', function () {
    return buildJs('admin');
});

/*= Misc
 *=====================================================*/
gulp.task('fonts', function () {
    gulp.src(['bower_components/font-awesome/fonts/*'])
        .pipe(gulp.dest('webroot/fonts/font-awesome/'));
    gulp.src(['bower_components/bootstrap/fonts/*'])
        .pipe(gulp.dest('webroot/fonts/glyphicons/'));
    return gulp.src(['bower_components/open-sans-fontface/fonts/**'])
        .pipe(gulp.dest('webroot/fonts/open-sans/'));
});

/*= Minify assets
 *=====================================================*/
gulp.task('minify', buildTask, function () {
    // Minify CSS
    gulp.src([
            'webroot/css/public.css',
            'webroot/css/admin.css'
        ])
        .pipe(csso({comments: false}))
        .pipe(header(banner))
        .pipe(gulp.dest('webroot/css'));

    // Minify JS
    return gulp.src([
            'webroot/js/public.js',
            'webroot/js/admin.js'
        ])
        .pipe(uglify())
        .pipe(header(banner))
        .pipe(gulp.dest('webroot/js'));
});

/*= Watch assets
 *=====================================================*/
gulp.task('watch', buildTask, function () {
    // Public
    gulp.watch([
        'webroot/less/common/*.less',
        'webroot/less/public/*.less',
        'webroot/less/public.less'
    ], ['css-public']);

    gulp.watch([
        'webroot/js/common/*.js',
        'webroot/js/public/*.js'
    ], ['js-public']);

    // Admin
    gulp.watch([
        'webroot/less/common/*.less',
        'webroot/less/admin/*.less',
        'webroot/less/admin.less'
    ], ['css-admin']);

    gulp.watch([
        'webroot/js/common/*.js',
        'webroot/js/admin/*.js'
    ], ['js-admin']);
});

/*= Deploy project
 *=====================================================*/
gulp.task('deploy', ['minify', 'fonts'], function (server) {
    exec('dploy ' + server, function (err, stdout, stderr) {
        console.log(stdout);
        console.log(stderr);
    });
});