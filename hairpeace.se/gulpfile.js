/*!
 * gulp
 * $ npm install gulp-ruby-sass gulp-autoprefixer gulp-minify-css gulp-jshint gulp-concat gulp-uglify gulp-imagemin gulp-notify gulp-rename gulp-livereload gulp-cache del --save-dev
 */
 
// Load plugins
var gulp = require('gulp'),
    sass = require('gulp-ruby-sass'),
    autoprefixer = require('gulp-autoprefixer'),
    minifycss = require('gulp-minify-css'),
    jshint = require('gulp-jshint'),
    uglify = require('gulp-uglify'),
    imagemin = require('gulp-imagemin'),
    rename = require('gulp-rename'),
    concat = require('gulp-concat'),
    notify = require('gulp-notify'),
    cache = require('gulp-cache'),
    livereload = require('gulp-livereload'),
    del = require('del');

var src = {
    sass: 'src/scss/',
    scss: 'src/scss/**/*.scss',
};
 
// Styles
gulp.task('styles', function() {
  return sass(src.sass, { style: 'expanded' })
    .on('error', function (err) {
            console.error('SASS-Error!', err.message);
        })
    .pipe(autoprefixer('last 2 version'))
    .pipe(gulp.dest('css'))
    .pipe(rename({ suffix: '.min' }))
    .pipe(minifycss())
    .pipe(gulp.dest('css'))
    .pipe(notify({ message: 'Styles task complete' }));
});
 
// Scripts
gulp.task('scripts', function() {
  return gulp.src('src/js/*.js')
    .pipe(jshint())
    .pipe(jshint.reporter('default'))
    .pipe(concat('main.js'))
    .pipe(gulp.dest('js'))
    .pipe(rename({ suffix: '.min' }))
    .pipe(uglify())
    .pipe(gulp.dest('js'))
    .pipe(notify({ message: 'Scripts task complete' }));
});
gulp.task('copy-libs', function(cb) {
    return gulp.src('src/js/vendor/*.js')
     .pipe(gulp.dest('js'));
});
 
// Images
gulp.task('images', function() {
  return gulp.src('src/img/**/*')
    .pipe(cache(imagemin({ optimizationLevel: 3, progressive: true, interlaced: true })))
    .pipe(gulp.dest('img'))
    .pipe(notify({ message: 'Images task complete' }));
});
 
// Clean
gulp.task('clean', function(cb) {
    del(['css', 'js', 'img'], cb);
});
 
// Default task
gulp.task('default', ['clean'], function() {
    gulp.start('styles', 'scripts', 'copy-libs', 'images', 'watch');
});
 
// Watch
gulp.task('watch', function() {
 
  // Watch .scss files
  gulp.watch(src.scss, ['styles']);
 
  // Watch .js files
  gulp.watch('src/js/**/*.js', ['scripts']);
 
  // Watch image files
  gulp.watch('src/img/**/*', ['images']);
 
  // Create LiveReload server
  livereload.listen();
 
  // Watch any files, reload on change
  gulp.watch(['js/**', 'css/**', 'img/**']).on('change', livereload.changed);
 
});