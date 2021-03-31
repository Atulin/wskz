'use strict';
const {pipeline} = require('stream');

const gulp = require('gulp');
const postcss = require('gulp-postcss');
const {sass} = require('@mr-hope/gulp-sass');
const rename = require('gulp-rename');
const sourcemaps = require('gulp-sourcemaps');
const cond = require('gulp-if');

// CSS processors
const autoprefixer = require('autoprefixer');
const csso = require('postcss-csso');

// JS processors
const terser = require('gulp-terser');

// Dirs
const root = './assets';
const roots = {
    css: `${root}/css`,
    js: `${root}/js`,
};

// Watch globs
const watchGlobs = {
    sass: [ // Avoid `**` because gulp-sass has issues itself otherwise and compilation takes >5s on any change
        `${roots.css}/*.{sass,scss}`,
        `${roots.css}/src/*.{sass,scss}`,
        `${roots.css}/src/elements/*.{sass,scss}`,
        `${roots.css}/src/pages/*.{sass,scss}`,
        `${roots.css}/src/base/*.{sass,scss}`,
    ],
    js: [
        `${roots.js}/src/**/*.js`
    ],
};

// CSS tasks
const css = () => pipeline(gulp.src(`${roots.css}/*.sass`),
    sourcemaps.init(),                   // Init maps
    sass(),                              // Compile SASS
    gulp.dest(`${roots.css}/dist`),      // Output the raw CSS
    postcss([                     // Postprocess it
        autoprefixer,
        csso({comments: false})
    ]),
    sourcemaps.write('./'),     // Write maps
    cond('**/*.css',            // If it's a css file and not a map file
        rename({suffix: '.min'}),   // Add .min suffix
    ),
    gulp.dest(`${roots.css}/dist`),      // Output minified CSS
    errorHandler);
exports.css = css;

const watchCss = () => gulp.watch(watchGlobs.sass, css);
exports.watchCss = watchCss;

// JS tasks
const js = () => pipeline(gulp.src([`${roots.js}/src/**/*.js`]),
    rename({suffix: '.min'}),
    sourcemaps.init(),
    terser({
        mangle: {
            toplevel: false
        }
    }),
    sourcemaps.write('./'),
    gulp.dest(`${roots.js}/dist`),
    errorHandler);
exports.js = js;

const watchJs = () => gulp.watch(watchGlobs.js, js);
exports.watchJs = watchJs;

// All tasks
const all = gulp.parallel(css, js);
exports.all = all;

const watchAll = gulp.parallel(watchCss, watchJs, all);
exports.watchAll = watchAll;


// Error handler
function errorHandler(err) {
    if (err) {
        console.error(err);
    }
}
