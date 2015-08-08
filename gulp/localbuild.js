'use strict';

var gulp = require('gulp');

var $ = require('gulp-load-plugins')({
  pattern: ['gulp-*', 'main-bower-files', 'uglify-save-license', 'del']
});

module.exports = function(options) {
  gulp.task('localpartials', function () {
    return gulp.src([
      options.src + '/app/**/*.html',
      options.tmp + '/serve/app/**/*.html'
    ])
      .pipe($.angularTemplatecache('templateCacheHtml.js', {
        module: 'gretel',
        root: 'app'
      }))
      .pipe(gulp.dest(options.tmp + '/partials/'));
  });

  gulp.task('localhtml', ['inject', 'partials'], function () {
    var partialsInjectFile = gulp.src(options.tmp + '/partials/templateCacheHtml.js', { read: false });
    var partialsInjectOptions = {
      starttag: '<!-- inject:partials -->',
      ignorePath: options.tmp + '/partials',
      addRootSlash: false
    };

    var htmlFilter = $.filter('*.html');
    var jsFilter = $.filter('**/*.js');
    var cssFilter = $.filter('**/*.css');
    var assets;

    return gulp.src(options.tmp + '/serve/*.html')
      .pipe($.inject(partialsInjectFile, partialsInjectOptions))
      .pipe(assets = $.useref.assets())
      .pipe($.rev())
      .pipe(jsFilter)
      .pipe(jsFilter.restore())
      .pipe(cssFilter)
      .pipe($.replace('../../bower_components/bootstrap-sass-official/assets/fonts/bootstrap/', '../fonts/'))
      .pipe($.csso())
      .pipe(cssFilter.restore())
      .pipe(assets.restore())
      .pipe($.useref())
      .pipe($.revReplace())
      .pipe(gulp.dest(options.dist + '/'))
      .pipe($.size({ title: options.dist + '/', showFiles: true }));
  });

  // Only applies for fonts from bower dependencies
  // Custom fonts are handled by the "other" task
  gulp.task('localfonts', function () {
    return gulp.src($.mainBowerFiles())
      .pipe($.filter('**/*.{eot,svg,ttf,woff,woff2}'))
      .pipe($.flatten())
      .pipe(gulp.dest(options.dist + '/fonts/'));
  });

  gulp.task('localother', function () {
    return gulp.src([
      options.src + '/**/*',
      '!' + options.src + '/**/*.{html,css,js,scss}'
    ])
      .pipe(gulp.dest(options.dist + '/'));
  });

  gulp.task('clean', function (done) {
    $.del([options.dist + '/', options.tmp + '/'], done);
  });

  gulp.task('localbuild', ['localhtml', 'localfonts', 'localother']);
};
