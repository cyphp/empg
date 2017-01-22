var gulp    = require('gulp');
var phpunit = require('gulp-phpunit');
 
gulp.task('phpunit', function() {
  gulp.src('phpunit.xml.dist')
    .pipe(phpunit('./vendor/bin/phpunit', {
    	debug: false
    }));
});

gulp.task('watch', function(){
	gulp.watch('src/**/*.php', ['phpunit']);
});