'use strict';

// require gulp and gulp-sass
var gulp = require('gulp');
var sass = require('gulp-sass');

// compile sass
gulp.task('sass', function () { 
    gulp.src('sass/style.scss')
    .pipe(sass().on('error', sass.logError))
    .pipe(gulp.dest(''));
});

//compile and watch 
gulp.task('watch', function() {
    gulp.watch('sass/*/*.scss', gulp.series('sass'));
});
