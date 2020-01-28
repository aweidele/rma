var gulp = require('gulp');
var sass = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');
var sourcemaps = require('gulp-sourcemaps');
var pxtorem = require('gulp-pxtorem');
var concat = require('gulp-concat');
var rename = require('gulp-rename');
var uglify = require('gulp-uglify');
var pump = require('pump');
var iconfont = require('gulp-iconfont');
var iconfontCss = require('gulp-iconfont-css');
var gcmq = require('gulp-group-css-media-queries');

var sassOptions = {
  errLogToConsole: true,
  outputStyle: 'expanded'
};

var autoprefixerOptions = {
  browsers: ['last 2 versions']
};

// var jsQueue = [
//   'node_modules/owl.carousel/dist/owl.carousel.js',
//   'src/js/*.js'
// ];

var jsQueue = [
  'node_modules/tablesort/dist/tablesort.min.js',
  'node_modules/tablesort/dist/tablesort.number.min.js',
  'src/js/*.js'
];

var pxtoremOptions = {
  propList: [
    'font',
    'font-size',
    'line-height',
    'padding',
    'padding-top',
    'padding-left',
    'padding-right',
    'padding-bottom',
    'width',
    'height',
    'border',
    'border-radius',
    'border-top-left-radius',
    'border-top-right-radius',
    'border-bottom-left-radius',
    'border-bottom-right-radius',
    'top',
    'left',
    'bottom',
    'right',
    'margin',
    'margin-left',
    'margin-right',
    'margin-top',
    'margin-bottom'
  ]
};

gulp.task('sass', function(){
  return gulp
    .src('src/sass/main.scss')
    .pipe(sourcemaps.init())
    .pipe(sass(sassOptions).on('error', sass.logError))
    //.pipe(sourcemaps.write())
    .pipe(gcmq())
    .pipe(autoprefixer(autoprefixerOptions))
    //.pipe(pxtorem(pxtoremOptions))
    .pipe(gulp.dest('assets/css/'))
});

gulp.task('compress', function() {
  return gulp.src(jsQueue)
    .pipe(concat('scripts.js'))
    .pipe(gulp.dest('assets/js'))
    .pipe(rename('site.js'))
    .pipe(uglify())
    .pipe(gulp.dest('assets/js'));
});

gulp.task('ico', function(){
  console.log(process.cwd());
  gulp.src(['src/icons/*.svg'], {base: './'})
    .pipe(iconfontCss({
      fontName: 'rma-icons',
      targetPath: '../../src/sass/base/_icons.scss',
      fontPath: '../fonts/',
      cssClass: 'ic'
    }))
    .pipe(iconfont({
      fontName: 'rma-icons',
      formats: ['ttf', 'eot', 'woff', 'woff2', 'svg'],
      normalize:true,
      fontHeight: 1001
     }))
    .pipe(gulp.dest('assets/fonts/'));
});

gulp.task('iconfont', ['ico', 'sass']);


gulp.task('watch', function(){
  gulp.watch('src/sass/**/*.scss', ['sass']);
  gulp.watch('src/js/**/*.js', ['compress']);
});

gulp.task('default', ['sass', 'compress', 'watch']);
