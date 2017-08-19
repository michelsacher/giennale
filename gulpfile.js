// configuration

const cfg = {
  port: process.env.BS_PORT || 30000,
  sync: false
};

const dir = {
  base: 'fileadmin/razor/',
  dist: 'fileadmin/razor/Dist/',
  fonts: 'fileadmin/razor/Fonts/',
  src: './',
  scripts: 'fileadmin/razor/Scripts/',
  styles: 'fileadmin/razor/Styles/'
};

// plugins

const gulp = require('gulp');
const gulpLoadPlugins = require('gulp-load-plugins');

const browserSync = require('browser-sync');
const browserify = require('browserify');
const del = require('del');
const runSequence = require('run-sequence');
const source = require('vinyl-source-stream');
const wiredep = require('wiredep').stream;

const $ = gulpLoadPlugins();

const reload = browserSync.reload;

// tasks

gulp.task('styles', () => {
  return gulp.src(dir.styles + 'Import.scss')
    .pipe($.plumber())
    .pipe($.sourcemaps.init())
    .pipe($.sass.sync({
      outputStyle: 'expanded',
      precision: 10,
      includePaths: ['.']
    }).on('error', $.sass.logError))
    .pipe($.autoprefixer({
      browsers: [
        'ie >= 9',
        'chrome >= 26',
        'firefox >= 29',
        'firefox esr',
        'opera >= 15',
        'safari >= 6',
        'ios_saf >= 6',
        'last 2 versions'
      ]}))
    .pipe($.sourcemaps.write())
    .pipe($.rename('Main.css'))
    .pipe(gulp.dest(dir.dist))
    .pipe(browserSync.stream({
      match: '**/*.css'
    }));
});

gulp.task('scripts', () => {
  const b = browserify();
  b.transform('babelify', { presets: ['es2015'] });
  b.add('./' + dir.scripts + 'Main.js');

  return b.bundle()
    .on('error', function (error) {
      console.log(error.message);
      browserSync.notify('javascript: ' + error.toString().replace('\n', '<br>'), 6000);
      this.emit('end');
    })
    .pipe(source('Main.js'))
    .pipe(gulp.dest(dir.dist))
    .pipe(browserSync.stream());
});

gulp.task('lint', () => {
  return gulp.src(dir.scripts + '**/*.js')
    .pipe($.eslint({
      fix: true
    }))
    .pipe($.eslint.format())
    .pipe($.if(!browserSync.active, $.eslint.failAfterError()));
});

gulp.task('wiredepHtml', () => {
  return gulp.src(dir.src + 'deps.html')
    .pipe(wiredep({directory: 'bower_components'}))
    .pipe(gulp.dest(dir.src));
});

gulp.task('wiredepSass', () => {
  return gulp.src(dir.styles + 'Import.scss')
    .pipe(wiredep({directory: 'bower_components'}))
    .pipe(gulp.dest(dir.styles));
});

gulp.task('useref', () => {
  return gulp.src(dir.src + 'deps.html')
    .pipe($.useref())
    .pipe($.if([ '*.css', '*.js' ], gulp.dest(dir.dist)));
});

gulp.task('fonts', () => {
  const bowerFiles = require('main-bower-files')('**/*.{eot,otf,svg,ttf,woff,woff2}');

  return gulp.src(bowerFiles)
    .pipe(gulp.dest(dir.fonts));
});

gulp.task('minifyCss', () => {
  return gulp.src(dir.dist + '*.css')
    .pipe($.cleanCss())
    .pipe(gulp.dest(dir.dist));
});

gulp.task('minifyJs', () => {
  return gulp.src(dir.dist + '*.js')
    .pipe($.uglify())
    .pipe(gulp.dest(dir.dist));
});

gulp.task('clean', () => {
  return del([ dir.dist + '*.map' ]);
});

gulp.task('typo3', () => {
  return gulp.src(dir.src + 'fileadmin/razor/TypoScript/constants/Gulp.ts')
    .pipe($.replace(/port = [0-9]*/g, 'port = ' + cfg.port))
    .pipe(gulp.dest('fileadmin/razor/TypoScript/constants/'));
});

// taskchains

gulp.task('default', [ 'serve' ]);
gulp.task('watch', [ 'serve' ]);

gulp.task('build', (callback) => {
  runSequence([ 'wiredepHtml', 'wiredepSass' ], 'useref', 'lint', [ 'fonts', 'styles', 'scripts'], callback);
});

gulp.task('dist', (callback) => {
  runSequence([ 'wiredepHtml', 'wiredepSass' ], 'useref', 'lint', [ 'fonts', 'styles', 'scripts'], ['minifyCss', 'minifyJs'], 'clean', callback);
});

// watcher

gulp.task('serve', [ 'build', 'typo3' ], () => {
  browserSync.init({
    port: parseInt(cfg.port),
    open: false,
    ghostMode: cfg.sync,
    injectChanges: false,
    notify: {
      styles: [
        'position: fixed;',
        'bottom: 0;',
        'left: 0;',
        'z-index: 9999;',
        'padding: 15px;',
        'margin: 0;',
        'color: #fff;',
        'font-family: Arial;',
        'font-size: 0.9em;',
        'text-align: center;',
        'background-color: #000;',
        'opacity: 0.75'
      ]
    }
  });

  // templates
  gulp.watch([
    dir.base + 'Templates/**/*.html',
    dir.base + 'TypoScript/**/*.ts',
  ]).on('change', reload);

  // styles
  gulp.watch([
    dir.styles + '**/*'
  ], [ 'styles' ]);

  // scripts
  gulp.watch([
    dir.scripts + '**/*.js'
  ], [ 'lint', 'scripts' ]);

  // bower
  gulp.watch('bower.json').on('change', () => {
    runSequence([ 'wiredepHtml', 'wiredepSass' ], 'useref', 'fonts');
    reload();
  });
});
