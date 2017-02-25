var gulp = require('gulp'),
    watch = require('gulp-watch'),
    less = require('gulp-less'),
    csso = require('gulp-csso'),
    header = require('gulp-header');


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

gulp.task('watch', function () {
    gulp.watch([
        'webroot/less/common/*.less',
        'webroot/less/public/*.less',
        'webroot/less/*.less'
    ], ['less']);
});

gulp.task('fonts', function () {
    return gulp.src([
            'webroot/plugins/font-awesome/fonts/*',
            'webroot/plugins/boostrap/fonts/*'
        ])
        .pipe(gulp.dest('webroot/fonts/'));
});