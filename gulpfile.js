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
  'src/js/*.js'
];

gulp.task('sass', function(){
  return gulp
    .src('src/sass/main.scss')
    .pipe(sourcemaps.init())
    .pipe(sass(sassOptions).on('error', sass.logError))
    .pipe(sourcemaps.write())
    .pipe(autoprefixer(autoprefixerOptions))
    .pipe(pxtorem())
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

gulp.task('iconfont', function(){
  gulp.src(['src/icons/*.svg'])
    .pipe(iconfontCss({
      fontName: 'petel_glyphs',
      targetPath: '../src/sass/_icons.scss',
      fontPath: '../fonts/'
    }))
    .pipe(iconfont({
      fontName: 'rethink_glyphs',
      normalize:true,
      fontHeight: 1001
     }))
    .pipe(gulp.dest('fonts/'));
});


gulp.task('watch', function(){
  gulp.watch('src/sass/**/*.scss', ['sass']);
  gulp.watch('src/js/**/*.js', ['compress']);
});

gulp.task('default', ['sass', 'compress', 'watch']);
