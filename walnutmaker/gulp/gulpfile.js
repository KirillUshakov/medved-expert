var wt_gulp = require('gulp');
var wt_util = require('gulp-util');
var wt_sass = require('gulp-sass');
var wt_prefix = require('gulp-autoprefixer');
var wt_clean = require('gulp-clean-css');
//var wt_media = require( 'gulp-merge-media-queries' );
var wt_rename = require('gulp-rename');
var wt_file = require('gulp-using');

// Определяем пути файлов
var path = {
    css: {
        main: '../',
        min: '../style.css'
    },
    sass: {main: '../sass/style.scss'},
    watch: {main: '../sass/**/*.scss'}
};

// Создаем задачу build
wt_gulp.task('style:build', function () {
    return wt_gulp.src(path.sass.main)

        .pipe(wt_sass().on('error', wt_sass.logError))
        .on('end', function () {
            wt_util.log('SASS был успешно скомпилирован');
        })

        .pipe(wt_prefix({
            browsers: ["> 0.5%"]
        }))
        .on('end', function () {
            wt_util.log('Вендорные префиксы добавлены');
        })

        .pipe(wt_gulp.dest(path.css.main))

        .pipe(wt_file({
            prefix: 'Скомпилированный файл:',
            path: 'relative',
            color: 'green',
            filesize: true
        }))

});

// Создаем задачу min
wt_gulp.task('css:min', function () {
    return wt_gulp.src(path.css.min)

    // Отобразим исходный файл CSS
        .pipe(wt_file({
            prefix: 'Исходный файл:',
            path: 'relative',
            color: 'blue',
            filesize: true
        }))

        // Минифицируем стили
        .pipe(wt_clean())

        // Добавим постфикс к файлу стилей
        .pipe(wt_rename({suffix: '.min'}))
        .on('end', function () {
            wt_util.log('Стили успешно минимизировались');
        })

        // Создадим или перезапишем минифицированный файл
        .pipe(wt_gulp.dest('../'))

        // Отобразим сжатый файл CSS
        .pipe(wt_file({
            prefix: 'Сжатый файл:',
            path: 'relative',
            color: 'blue',
            filesize: true
        }))

});
wt_gulp.task('watch', function () {
    wt_gulp.watch(path.watch.main, wt_gulp.series('style:build'));
});