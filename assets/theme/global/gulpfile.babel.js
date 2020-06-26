import config from './config';
import gulp from 'gulp';
import gutil from 'gulp-util';
import requiredir from 'require-dir';

gutil.log(gutil.colors.bold(`ℹ  ${config.name} v${config.version}`));

if (config.production) {
  gutil.log(gutil.colors.bold.green('🚚  Production Mode'));
} else {
  gutil.log(gutil.colors.bold.green('🔧  Development Mode'));
}
requiredir('./tasks');

gulp.task(
  'dist',
  gulp.series(/*'vendor',*/ 'make:styles', 'make:scripts', 'fonts', 'images')
);

gulp.task(
  'clean',
  gulp.series('clean:styles', 'clean:scripts', /*'clean:vendor',*/ 'clean:fonts', 'clean:images')
);
gulp.task('build', gulp.series('clean', 'dist'));
gulp.task('dev', gulp.series('build', gulp.parallel('watch')));
gulp.task('default', gulp.series('dev'));



// for test
gulp.task('css-test', gulp.series('clean:styles', 'make:styles', 'vendor:styles'));
gulp.task('vcss-test', gulp.series('vendor:styles'));
gulp.task('js-test', gulp.series('clean:scripts', 'make:scripts'));
