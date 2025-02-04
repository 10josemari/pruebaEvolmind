const gulp = require('gulp');
const sass = require('gulp-sass');
const minifycss = require('gulp-minify-css');
const del = require('del');

gulp.task('styles', () => {
  return gulp.src('scss/**/*.scss')
    .pipe(sass().on('error', sass.logError))
    .pipe(gulp.dest('./css/'));
});

gulp.task('clean', () => {
  return del([
    'css/style.css',
  ]);
});

gulp.task('minify-css', () => {
  return gulp.src('./css/*.css')
    .pipe(minifycss())
    .pipe(gulp.dest('./css/'));
});

gulp.task('default', gulp.series(['clean', 'styles', 'minify-css']));