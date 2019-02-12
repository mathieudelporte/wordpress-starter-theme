var gulp = require('gulp'),
sass = require('gulp-sass'),
concat = require( 'gulp-concat' );

gulp.task( 'sass', function() {
  return gulp.src('src/scss/main.scss')
    .pipe(sass( {outputStyle: 'compressed'} ))
    .pipe(concat('style.css'))
    .pipe(gulp.dest(''))
} );

gulp.task( 'watch', function() {
	gulp.watch( 'src/scss/**/*.scss', ['sass'] );
} );

gulp.task( 'default', [ 'sass' ], function() {
	console.log( 'default gulp task...' )
} );