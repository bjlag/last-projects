'use strict';

const gulp = require( 'gulp' ),
    sass = require( 'gulp-sass' ), // подключаем SASS
    gulpif = require( 'gulp-if' ), // задаем правила при каких условиях выполнять плагины
    uglify = require( 'gulp-uglify' ), // минификация JS
    minifyCss = require( 'gulp-csso' ), // минификация CSS
    concat = require( 'gulp-concat' ),
    rename = require("gulp-rename"),
    clean = require( 'gulp-clean' ), // удаление данных из каталога
    autoprefixer = require( 'gulp-autoprefixer' ), // автоматическое добавления css префиксов
    imagemin = require( 'gulp-imagemin' ), // работа с изображениями
    imageminJpegRecompress = require( 'imagemin-jpeg-recompress' ), // работа с JPG
    cache = require( 'gulp-cache' ), // работа с кешем
    browserSync = require( 'browser-sync' ).create(); // live reload

const config = {
    dist: './dist',
    src: './src',
    template: './dist/templates/donniva',
    sass: './src/templates/donniva/sass'
};

// чистим кеш
gulp.task( 'clean:cache', function ( done ) {
    return cache.clearAll( done );
} );

// очистка
gulp.task( 'clean:all', function () {
    return gulp.src( config.dist, { read: false } )
        .pipe( clean() );
} );

gulp.task( 'clean:template', function () {
    return gulp.src( config.template, { read: false } )
        .pipe( clean() );
} );

// sass
gulp.task( 'sass', function () {
    return gulp.src( config.sass + '/*.sass' )
        .pipe( sass( {
            outputStyle: 'expanded'
        } ).on( 'error', sass.logError ) )
        .pipe( autoprefixer( {
            browsers: [ 'last 15 versions', '> 0.1%' ],
            // cascade: false
        } ) )
        .pipe( gulp.dest( config.template + '/css' ) );
} );

gulp.task( 'sass:font-awesome', function () {
    return gulp.src( config.sass + '/font-awesome/*.scss' )
        .pipe( sass( { outputStyle: 'compressed' } ).on( 'error', sass.logError ) )
        .pipe( gulp.dest( config.template + '/css' ) );
} );

gulp.task( 'sass:hamburger', function () {
    return gulp.src( config.sass + '/hamburgers/*.scss' )
        .pipe( sass( { outputStyle: 'compressed' } ).on( 'error', sass.logError ) )
        .pipe( gulp.dest( config.template + '/css' ) );
} );

// оптимизация изображений
gulp.task( 'image', [ 'clean' ], function () {
    return gulp.src( [ config.src + '/img/*.jpg' ] )
        .pipe( cache( imagemin( [
            imagemin.jpegtran( { progressive: true } ),
            imageminJpegRecompress( {
                loops: 5,
                min: 65,
                max: 70,
                quality: 'medium'
            } )
        ], {
            verbose: true
        } ) ) )
        .pipe( gulp.dest( config.dist + '/img' ) );
} );

// css префиксы
gulp.task( 'cssprefix', function () {
    return gulp.src( config.src + '/css/**/*.css' )
        .pipe( autoprefixer( {
            browsers: [ 'last 4 versions' ],
            cascade: false
        } ) )
        .pipe( gulp.dest( config.src + '/css' ) )
} );

// сборка
gulp.task( 'build', [ 'clean', 'image', 'cssprefix' ], function () {
    return gulp.src( config.src + '/*.html' )
        .pipe( gulpif( '*.js', uglify() ) )
        .pipe( gulpif( '*.css', minifyCss( { comments: false } ) ) )
        .pipe( gulp.dest( config.dist ) );
} );

gulp.task( 'css-main:min', function () {
    return gulp.src( './dist/templates/donniva/css/template.css' )
        .pipe( minifyCss( { comments: false } ) )
        .pipe( rename( { suffix: '.min' } ) )
        .pipe( gulp.dest( './dist/templates/donniva/css/' ) );
} );

gulp.task( 'css-vendor:min', function () {
    var src = [
       './dist/templates/donniva/css/bootstrap.min.css',
        './dist/templates/donniva/css/font-awesome.css',
        './dist/templates/donniva/css/slick.css',
        './dist/templates/donniva/css/slick-theme.css',
        './dist/templates/donniva/css/hamburgers.css'
    ];

    return gulp.src( src )
        .pipe( concat( 'vendor.min.css' ) )
        .pipe( minifyCss( { comments: false } ) )
        .pipe( gulp.dest( './dist/templates/donniva/css/' ) );
} );

gulp.task( 'js-main:min', function () {
    return gulp.src( './dist/templates/donniva/js/main.js' )
        .pipe( uglify() )
        .pipe( rename( { suffix: '.min' } ) )
        .pipe( gulp.dest( './dist/templates/donniva/js/' ) );
} );

gulp.task( 'js-vendor:min', function () {
    var src = [
        './dist/templates/donniva/js/jquery.min.js',
        './dist/templates/donniva/js/bootstrap.min.js',
        './dist/templates/donniva/js/jquery.matchHeight.js',
        './dist/templates/donniva/js/slick.min.js',
        './dist/templates/donniva/js/jquery.maskedinput.min.js'
    ];

    return gulp.src( src )
        .pipe( concat( 'vendor.min.js' ) )
        .pipe( uglify() )
        .pipe( gulp.dest( './dist/templates/donniva/js/' ) );
} );

// отслеживание
gulp.task( 'watch', [ 'sass' ], function () {
    gulp.watch( config.sass + '/**/*.sass', [ 'sass' ] );
} );

// live reload
gulp.task( 'bs', function () {
    browserSync.init( {
        server: {
            baseDir: config.dist
        },
        notify: true,
        port: 8888
    } );
    browserSync.watch( config.template + '/**/*' ).on( 'change', browserSync.reload );
} );

gulp.task( 'default', [ 'watch' ] );