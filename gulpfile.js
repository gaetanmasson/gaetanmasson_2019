'use strict';

// require gulp and gulp-sass
const gulp = require('gulp');
const sass = require('gulp-sass');

// compile sass
gulp.task('sass', () => { 
    return gulp.src('assets/sass/style.scss')
      .pipe(sass().on('error', sass.logError))
      .pipe(gulp.dest('assets/css'));
});

//compile and watch 
gulp.task('watch', () => {
    gulp.watch('assets/sass/*/*/*.scss', (done) => {
      gulp.series('sass')(done);
    });
});
