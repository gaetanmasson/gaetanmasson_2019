'use strict';

// require gulp and gulp-sass
const gulp = require('gulp');
const sass = require('gulp-sass');

// compile sass
gulp.task('sass', () => { 
    return gulp.src('sass/style.scss')
      .pipe(sass().on('error', sass.logError))
      .pipe(gulp.dest('.'));
});

//compile and watch 
gulp.task('watch', () => {
    gulp.watch('sass/*/*.scss', (done) => {
      gulp.series('sass')(done);
    });
});
