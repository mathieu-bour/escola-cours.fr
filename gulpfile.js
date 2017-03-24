var gulp = require('gulp-param')(require('gulp'), process.argv),
    watch = require('gulp-watch'),
    header = require('gulp-header'),
    less = require('gulp-less'),
    csso = require('gulp-csso'),
    concat = require('gulp-concat'),
    uglify = require('gulp-uglify'),
    exec = require('gulp-exec');


var banner = [
    '/**',
    ' * Copyright (C) 2017 - Escola.fr ',
    ' * Written with love by Mathieu Bour',
    ' */',
    ''
].join('\n');

/*= Public
 *=====================================================*/
gulp.task('less-public', function () {
    return gulp.src('webroot/less/public.less')
        .pipe(less())
        .pipe(gulp.dest('webroot/css'))
});

gulp.task('js-public', function () {
    return gulp.src([
            'bower_components/js-cookie/src/js.cookie.js',
            'bower_components/jquery/dist/jquery.js',
            'bower_components/bootstrap/js/alert.js',
            'bower_components/bootstrap/js/button.js',
            'bower_components/bootstrap/js/tab.js',
            'bower_components/owl.carousel/dist/owl.carousel.min.js',
            'webroot/js/public/jquery.postJSON.js',
            'webroot/js/public/jquery.coursesForm.js',
            'webroot/js/public/jquery.slotsTable.js',
            'webroot/js/public/main.js'
        ])
        .pipe(concat('public.js'))
        //.pipe(uglify())
        .pipe(header(banner))
        .pipe(gulp.dest('webroot/js/'));
});

/*= Admin
 *=====================================================*/
gulp.task('less-admin', function () {
    return gulp.src('webroot/less/admin.less')
        .pipe(less())
        .pipe(csso({
            comments: false
        }))
        .pipe(header(banner))
        .pipe(gulp.dest('webroot/css'))
});

gulp.task('js-admin', function () {
    return gulp.src([
            'bower_components/js-cookie/src/js.cookie.js',
            'bower_components/jquery/dist/jquery.js',
            'bower_components/owl.carousel/dist/owl.carousel.min.js',
            'webroot/js/admin/main.js'
        ])
        .pipe(concat('admin.js'))
        .pipe(gulp.dest('webroot/js/'));
});

/*= Miscellaneous
 *=====================================================*/
gulp.task('fonts', function () {
    return gulp.src([
            'bower_components/font-awesome/fonts/*',
            'bower_components/bootstrap/fonts/*'
        ])
        .pipe(gulp.dest('webroot/fonts/'));
});

/*= Watch
 *=====================================================*/
gulp.task('watch', function () {
    // Public
    gulp.watch([
        'webroot/less/common/*.less',
        'webroot/less/public/*.less',
        'webroot/less/public.less'
    ], ['less-public']);

    gulp.watch([
        'webroot/js/public/*.js'
    ], ['js-public']);

    // Admin
    gulp.watch([
        'webroot/less/common/*.less',
        'webroot/less/admin/*.less',
        'webroot/less/admin.less'
    ], ['less-admin']);

    gulp.watch([
        'webroot/js/admin/*.js'
    ], ['js-admin']);
});

gulp.task('deploy', ['less-public', 'js-public', 'less-admin', 'js-admin', 'fonts'], function (server) {
    gulp.src([
            'webroot/css/public.css',
            'webroot/css/admin.css'
        ])
        .pipe(csso({comments: false}))
        .pipe(header(banner))
        .pipe(gulp.dest('webroot/css'));
    gulp.src([
            'webroot/js/public.js',
            'webroot/js/admin.js'
        ])
        .pipe(uglify())
        .pipe(header(banner))
        .pipe(gulp.dest('webroot/js'));
    exec('dploy ' + server);
});