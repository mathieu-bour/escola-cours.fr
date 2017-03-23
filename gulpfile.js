var gulp = require('gulp'),
    watch = require('gulp-watch'),
    header = require('gulp-header'),
    less = require('gulp-less'),
    csso = require('gulp-csso'),
    concat = require('gulp-concat'),
    uglify = require('gulp-uglify');


var banner = [
    '/**',
    ' * Copyright (C) 2017 - Ecola.fr ',
    ' * Written with live by Mathieu Bour',
    ' */',
    ''
].join('\n');


gulp.task('less', function () {
    return gulp.src('webroot/less/*.less')
        .pipe(less())
        .pipe(csso({
            comments: false
        }))
        .pipe(header(banner))
        .pipe(gulp.dest('webroot/css'))
});

gulp.task('js-public', function () {
    return gulp.src([
            'webroot/plugins/js-cookie/src/js.cookie.js',
            'webroot/plugins/jquery/dist/jquery.js',
            'webroot/plugins/bootstrap/js/alert.js',
            'webroot/plugins/bootstrap/js/button.js',
            'webroot/plugins/bootstrap/js/tab.js',
            'webroot/plugins/owl.carousel/dist/owl.carousel.min.js',
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

gulp.task('js-admin', function () {
    return gulp.src([
            'webroot/plugins/js-cookie/src/js.cookie.js',
            'webroot/plugins/jquery/dist/jquery.js',
            'webroot/plugins/owl.carousel/dist/owl.carousel.min.js',
            'webroot/js/admin/main.js'
        ])
        .pipe(concat('admin.js'))
        //.pipe(uglify())
        .pipe(header(banner))
        .pipe(gulp.dest('webroot/js/'));
});

gulp.task('fonts', function () {
    return gulp.src([
            'webroot/plugins/font-awesome/fonts/*',
            'webroot/plugins/bootstrap/fonts/*'
        ])
        .pipe(gulp.dest('webroot/fonts/'));
});

gulp.task('watch', function () {
    gulp.watch([
        'webroot/less/common/*.less',
        'webroot/less/public/*.less',
        'webroot/less/admin/*.less',
        'webroot/less/*.less'
    ], ['less']);

    gulp.watch([
        'webroot/js/public/*.js'
    ], ['js-public']);

    gulp.watch([
        'webroot/js/admin/*.js'
    ], ['js-admin']);
});