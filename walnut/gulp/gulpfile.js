// Определяем переменные
var wt_gulp = require( 'gulp' ),
	wt_sass = require( 'gulp-sass' ),
	wt_prefix = require( 'gulp-autoprefixer' ),
	wt_shorthand = require( 'gulp-shorthand' ),
	wt_combine = require( 'gulp-merge-media-queries' ),
	wt_rename = require( 'gulp-rename' ),
	wt_clean = require( 'gulp-clean-css' ),
	wt_watch = require( 'gulp-watch' );

// Указываем расположение файлов
var path = {
	build : {
		css : '../css'
	},
	source : {
		main : '../sass/main.scss',
		base : '../sass/base.scss'
	},
	watch : {
		main : '../sass/main/**/*.scss',
		base : '../sass/base/**/*.scss'
	}
};

// Создаем таск для генерации чистого файла стилей
wt_gulp.task( 'build:main', function() {
	wt_gulp.src( path.source.main )
		.pipe( wt_sass() )
		.pipe( wt_prefix() )
		.pipe( wt_shorthand() )
		.pipe( wt_combine() )
		.pipe( wt_gulp.dest( path.build.css ) );
} );

wt_gulp.task( 'build:base', function() {
	wt_gulp.src( path.source.base )
		.pipe( wt_sass() )
		.pipe( wt_prefix() )
		.pipe( wt_shorthand() )
		.pipe( wt_combine() )
		.pipe( wt_gulp.dest( path.build.css ) );
} );

// Создаем таск для минимизации нашего файла стилей
wt_gulp.task( 'maker:main', ['build:main'], function() {
	wt_gulp.src( path.build.css + '/main.css' )
		.pipe( wt_clean() )
		.pipe( wt_rename( {
			suffix : '.min'
		} ) )
		.pipe( wt_gulp.dest( path.build.css ) );
} );

wt_gulp.task( 'maker:base', ['build:base'], function() {
	wt_gulp.src( path.build.css + '/base.css' )
		.pipe( wt_clean() )
		.pipe( wt_rename( {
			suffix : '.min'
		} ) )
		.pipe( wt_gulp.dest( path.build.css ) );
} );

// Следим за изменениями в наших sass файлах
wt_gulp.task( 'watch', function() {
	wt_watch( [path.watch.main], function( event, cb ) {
		wt_gulp.start( 'maker:main' );
	} );
	wt_watch( [path.watch.base], function( event, cb ) {
		wt_gulp.start( 'maker:base' );
	} );
} );