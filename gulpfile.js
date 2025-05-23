const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const autoprefixer = require('gulp-autoprefixer');
const cleanCSS = require('gulp-clean-css');
const uglify = require('gulp-uglify');
const rename = require('gulp-rename');
const imagemin = require('gulp-imagemin')
const webp = require('gulp-webp');
const notify = require('gulp-notify');
const plumber = require('gulp-plumber');
const browserSync = require('browser-sync').create();
const sourcemaps = require('gulp-sourcemaps');
const header = require('gulp-header');

// Encabezado para WordPress
const themeHeader = `/*
Theme Name: Grupecsad
Theme URI: https://tusitio.com/
Author: Argenis Gutiérrez
Author URI: https://tusitio.com/
Description: Tema personalizado para Grupecsad.
Version: 1.0
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Text Domain: grupecsad
*/
\n`;

// Rutas
const paths = {
  scss: {
    src: 'src/scss/style.scss',
    dest: './' // style.css debe ir en raíz del tema
  },
  js: {
    src: 'src/js/**/*.js',
    dest: 'dist/js'
  },
  img: {
    src: 'src/img/**/*.{jpg,jpeg,png,svg}',
    dest: 'dist/img'
  }
};

// Tarea SCSS
function styles() {
  return gulp.src(paths.scss.src)
    .pipe(plumber({ errorHandler: notify.onError("SCSS Error: <%= error.message %>") }))
    .pipe(sourcemaps.init())
    .pipe(sass())
    .pipe(autoprefixer({ overrideBrowserslist: ['last 4 versions'], cascade: false }))
    .pipe(cleanCSS())
    .pipe(header(themeHeader))
    .pipe(rename('style.css'))
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest(paths.scss.dest))
    .pipe(browserSync.stream());
}

// Tarea JS
function scripts() {
  return gulp.src(paths.js.src)
    .pipe(plumber({ errorHandler: notify.onError("JS Error: <%= error.message %>") }))
    .pipe(sourcemaps.init())
    .pipe(uglify())
    .pipe(rename({ suffix: '.min' }))
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest(paths.js.dest))
    .pipe(browserSync.stream());
}

// Tarea imágenes
function images() {
  return gulp.src(paths.img.src)
    .pipe(imagemin([
      imagemin.mozjpeg({ quality: 80, progressive: true }),
      imagemin.optipng({ optimizationLevel: 5 }),
      imagemin.svgo()
    ]))
    .pipe(gulp.dest(paths.img.dest));
}

// Tarea WebP
function webpImages() {
  return gulp.src(paths.img.src)
    .pipe(webp())
    .pipe(gulp.dest(paths.img.dest));
}

// Tarea Watch
function watchFiles() {
  browserSync.init({
     proxy: "http://grupedsac.local", // ✅ usa tu URL real
  notify: true
  });

  gulp.watch('src/scss/**/*.scss', styles);
  gulp.watch(paths.js.src, scripts);
  gulp.watch(paths.img.src, gulp.series(images, webpImages)).on('change', browserSync.reload);
  gulp.watch("**/*.php").on('change', browserSync.reload);
}

// Exports
exports.styles = styles;
exports.scripts = scripts;
exports.images = images;
exports.webpImages = webpImages;
exports.watch = gulp.series(gulp.parallel(styles, scripts, images, webpImages), watchFiles);
exports.default = exports.watch;
