/*jslint node: true */
"use strict";

const $           = require('gulp-load-plugins')();
const argv        = require('yargs').argv;
const gulp        = require('gulp');
const { 
  series, 
  parallel, 
  watch
}                 = require('gulp');
const browserSync = require('browser-sync').create();
const merge       = require('merge-stream');
const colors      = require('colors');
const dateFormat  = require('dateformat');
const del         = require('del');
const cleanCSS    = require('gulp-clean-css');

// Enter URL of your local server here
// Example: 'http://localwebsite.dev'
const URL = 'http://gaetanmasson.local/';

// Check for --production flag
const isProduction = !!(argv.production);

// File paths to various assets are defined here.
const PATHS = {
  sass: [
  ],
  javascript: [
    'assets/js/*.js',
  ],
  phpcs: [
    '**/*.php',
    '!wpcs',
    '!wpcs/**',
  ],
  pkg: [
    '**/*',
    '!**/node_modules/**',
    '!**/components/**',
    '!**/scss/**',
    '!**/bower.json',
    '!**/gulpfile.js',
    '!**/package.json',
    '!**/composer.json',
    '!**/composer.lock',
    '!**/codesniffer.ruleset.xml',
    '!**/packaged/*',
  ]
};

// Browsersync task
function browserSyncInit(done) {
  const files = [
    '**/*.php',
    'assets/images/**/*.{png,jpg,gif}',
  ];
  browserSync.init(files, {
    // Proxy address
    proxy: URL,

    // server: {
    //   baseDir: "./_site/"
    // },
    // port: 3000
  });
  done();
}

// Build css stylesheet
const sass = function() {
  return gulp.src('assets/scss/styles.scss')
    .pipe($.sourcemaps.init())
    .pipe($.sass({
      includePaths: PATHS.sass
    }))
    .on('error', $.notify.onError({
        message: "<%= error.message %>",
        title: "Sass Error"
    }))
    .pipe($.autoprefixer())
    // Minify CSS if run with --production flag
    .pipe($.if(isProduction, cleanCSS()))
    .pipe($.if(!isProduction, $.sourcemaps.write('.')))
    .pipe(gulp.dest('assets/css'))
    .pipe(browserSync.stream({match: '**/*.css'}));
}

// Lint all javascript files
const lint = function() {
  return gulp.src('assets/js/*.js')
    .pipe($.jshint())
    .pipe($.notify(function (file) {
      if (file.jshint.success) {
        return false;
      }

      const errors = file.jshint.results.map(function (data) {
        if (data.error) {
          return "(" + data.error.line + ':' + data.error.character + ') ' + data.error.reason;
        }
      }).join("\n");
      return file.relative + " (" + file.jshint.results.length + " errors)\n" + errors;
    }));
}

// Compile all javascript files in one file
const javascript = function() {
  const uglify = $.uglify()
    .on('error', $.notify.onError({
      message: "<%= error.message %>",
      title: "Uglify JS Error"
    }));

  return gulp.src(PATHS.javascript)
    .pipe($.sourcemaps.init())
    .pipe($.babel())
    .pipe($.concat('scripts.js', {
      newLine:'\n;'
    }))
    .pipe($.if(isProduction, uglify))
    .pipe($.if(!isProduction, $.sourcemaps.write()))
    .pipe(gulp.dest('assets/js'))
    .pipe(browserSync.stream());
}

// Pack all files in compressed folder
const pack = function() {
  const fs = require('fs');
  const time = dateFormat(new Date(), "yyyy-mm-dd_HH-MM");
  const pkg = JSON.parse(fs.readFileSync('./package.json'));
  const title = pkg.name + '_' + time + '.zip';

  return gulp.src(PATHS.pkg)
    .pipe($.zip(title))
    .pipe(gulp.dest('packaged'));
}

// PHP Code Sniffer task
const phpcs = function() {
  return gulp.src(PATHS.phpcs)
    .pipe($.phpcs({
      bin: 'wpcs/vendor/bin/phpcs',
      standard: './codesniffer.ruleset.xml',
      showSniffCode: true,
    }))
    .pipe($.phpcs.reporter('log'));
};

const phpcbf = function () {
  return gulp.src(PATHS.phpcs)
    .pipe($.phpcbf({
      bin: 'wpcs/vendor/bin/phpcbf',
      standard: './codesniffer.ruleset.xml',
      warningSeverity: 0
    }))
    .on('error', $.util.log)
    .pipe(gulp.dest('.'));
};

// Clean JS
const cleanJavascript = function() {
  return del([
    'assets/js/scripts.js'
  ]);
};

// Clean CSS
const cleanCss = function() {
  return del([
    'assets/css/styles.css',
    'assets/css/styles.css.map'
  ]);
};

// Clean task
const clean = parallel(cleanJavascript, cleanCss);

// Build task
const build = series(clean, parallel(sass, javascript, lint));

exports.pack = pack;
exports.phpcs = phpcs;
exports.phpcbf = phpcbf;
exports.build = build;
exports.default = series(build, browserSyncInit, function(){

  function logFileChange(event) {
    const fileName = require('path').relative(__dirname, event);
    console.log('[' + 'WATCH'.green + '] ' + fileName.magenta + ' was changed, running tasks...');
  }
  
  watch(['assets/scss/**/*.scss'], series(cleanCss, sass))
    .on('change', function(event, stats) {
      logFileChange(event);
  });
  watch(['assets/js/**/*.js'], series(cleanJavascript, javascript, lint))
    .on('change', function(event) {
      logFileChange(event);
  });
});