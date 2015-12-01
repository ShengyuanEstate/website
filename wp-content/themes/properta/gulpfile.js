var gulp = require('./node_modules/gulp');
var sass = require('./node_modules/gulp-sass');

gulp.task('compile', function() {
    gulp.src('./assets/scss/properta.scss')
        .pipe(sass())
        .pipe(gulp.dest('./assets/css/'));
});

gulp.task('watch', function() {
    gulp.watch('./assets/scss/*.scss', ['compile']);
    gulp.watch('./assets/scss/helpers/*.scss', ['compile']);
});