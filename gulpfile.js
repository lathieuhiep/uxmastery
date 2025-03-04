const gulp = require('gulp')
const {src, dest, watch} = require('gulp')
const sass = require('gulp-sass')(require('sass'))
const sourcemaps = require('gulp-sourcemaps')
const browserSync = require('browser-sync')
const uglify = require('gulp-uglify')
const cleanCSS  = require('gulp-clean-css')
const rename = require("gulp-rename")
const plumber = require('gulp-plumber');
const path = require('path');

// Biến đại diện cho tên plugin và theme
const pluginNameEFA = 'essential-features-addon';
const themeName = 'uxmastery';

// Đường dẫn file
const paths = {
    node_modules: 'node_modules/',
    theme: {
        scss: 'src/theme/scss/',
        js: 'src/theme/js/'
    },
    plugins: {
        root: 'src/plugins/',
        efa: {
            scss: `src/plugins/${pluginNameEFA}/scss/`,
            js: `src/plugins/${pluginNameEFA}/js/`
        }
    },
    shared: {
        scss: 'src/shared/scss/',
        vendors: 'src/shared/scss/vendors/',
    },
    output: {
        theme: {
            root: `themes/${themeName}/assets/`,
            css: `themes/${themeName}/assets/css/`,
            js: `themes/${themeName}/assets/js/`,
            libs: `themes/${themeName}/assets/libs/`,
            extension: `themes/${themeName}/extension/`
        },
        plugins: {
            root: 'plugins/',
            efa: {
                css: `plugins/${pluginNameEFA}/assets/css/`,
                js: `plugins/${pluginNameEFA}/assets/js/`,
                libs: `plugins/${pluginNameEFA}/assets/libs/`
            }
        }
    }
};

// server
// tạo file .env với biến PROXY="localhost/basicthem". Có thể thay đổi giá trị này.
require('dotenv').config()
const proxy = process.env.PROXY || "localhost/basicthem";
function server() {
    browserSync.init({
        proxy: proxy,
        open: false,
        cors: true,
        ghostMode: false
    })
}

/*
Task build fontawesome
* */
function buildFontawesomeStyle() {
    return src(`${paths.shared.vendors}fontawesome.scss`)
        .pipe(plumber({
            errorHandler: function (err) {
                console.error(err.message);
                this.emit('end');
            }
        }))
        .pipe(sass({
            outputStyle: 'expanded',
            includePaths: [
                path.resolve(__dirname, 'node_modules/')
            ],
            quietDeps: true
        }, '').on('error', sass.logError))
        .pipe(cleanCSS ({
            level: 2
        }))
        .pipe(rename({suffix: '.min'}))
        .pipe(dest(`${paths.output.theme.libs}fontawesome/css`))
        .pipe(browserSync.stream())
}

function CopyWebFonts() {
    return src([
        `${paths.node_modules}@fortawesome/fontawesome-free/webfonts/fa-solid-900.ttf`,
        `${paths.node_modules}@fortawesome/fontawesome-free/webfonts/fa-solid-900.woff2`,
        `${paths.node_modules}@fortawesome/fontawesome-free/webfonts/fa-regular-400.ttf`,
        `${paths.node_modules}@fortawesome/fontawesome-free/webfonts/fa-regular-400.woff2`,
        `${paths.node_modules}@fortawesome/fontawesome-free/webfonts/fa-brands-400.ttf`,
        `${paths.node_modules}@fortawesome/fontawesome-free/webfonts/fa-brands-400.woff2`,
    ], {encoding: false})
        .pipe(dest(`${paths.output.theme.libs}fontawesome/webfonts`))
        .pipe(browserSync.stream())
}

/*
Task build Bootstrap
* */

// Task build style bootstrap
function buildStyleBootstrap() {
    return src(`${paths.shared.scss}vendors/bootstrap.scss`)
        .pipe(plumber({
            errorHandler: function (err) {
                console.error(err.message);
                this.emit('end');
            }
        }))
        .pipe(sass({
            outputStyle: 'expanded',
            includePaths: [
                path.resolve(__dirname, 'node_modules/')
            ],
            quietDeps: true
        }, '').on('error', sass.logError))
        .pipe(cleanCSS ({
            level: 2
        }))
        .pipe(rename({suffix: '.min'}))
        .pipe(dest(`${paths.output.theme.libs}bootstrap/`))
        .pipe(browserSync.stream())
}

// Task build js bootstrap
function buildLibsBootstrapJS() {
    return src( `${paths.node_modules}/bootstrap/dist/js/bootstrap.bundle.js`, {allowEmpty: true} )
        .pipe(plumber({
            errorHandler: function (err) {
                console.error('Error in buildLibsBootstrapJS:', err.message);
                this.emit('end');
            }
        }))
        .pipe(uglify())
        .pipe(rename( {suffix: '.min'} ))
        .pipe(dest(`${paths.output.theme.libs}/bootstrap/`))
        .pipe(browserSync.stream())
}

/*
Task build owl carousel
* */
function buildStyleOwlCarousel() {
    return src(`${paths.node_modules}/owl.carousel/dist/assets/owl.carousel.css`)
        .pipe(plumber({
            errorHandler: function (err) {
                console.error(err.message);
                this.emit('end');
            }
        }))
        .pipe(sass({
            outputStyle: 'expanded',
            quietDeps: true
        }, '').on('error', sass.logError))
        .pipe(cleanCSS ({
            level: 2
        }))
        .pipe(rename({suffix: '.min'}))
        .pipe(dest(`${paths.output.theme.libs}owl.carousel/`))
        .pipe(dest(`${paths.output.plugins.efa.libs}owl.carousel/`))
        .pipe(browserSync.stream())
}

function buildJsOwlCarouse() {
    return src(`${paths.node_modules}/owl.carousel/dist/owl.carousel.js`, {allowEmpty: true})
        .pipe(plumber({
            errorHandler: function (err) {
                console.error('Error in buildLibsOwlCarouseJS:', err.message);
                this.emit('end');
            }
        }))
        .pipe(uglify())
        .pipe(rename({suffix: '.min'}))
        .pipe(dest(`${paths.output.theme.libs}owl.carousel/`))
        .pipe(dest(`${paths.output.plugins.efa.libs}owl.carousel/`))
        .pipe(browserSync.stream())
}

// Task build style theme
function buildStyleTheme() {
    return src(`${paths.theme.scss}style-theme.scss`)
        .pipe(plumber({
            errorHandler: function (err) {
                console.error(err.message);
                this.emit('end');
            }
        }))
        .pipe(sourcemaps.init())
        .pipe(sass({
            outputStyle: 'expanded'
        }, '').on('error', sass.logError))
        .pipe(dest(`${paths.output.theme.css}`))
        .pipe(cleanCSS ({
            level: 2
        }))
        .pipe(rename({suffix: '.min'}))
        .pipe(sourcemaps.write())
        .pipe(dest(`${paths.output.theme.css}`))
        .pipe(browserSync.stream())
}
exports.buildStyleTheme = buildStyleTheme

function buildJSTheme() {
    return src(`${paths.theme.js}*.js`, {allowEmpty: true})
        .pipe(plumber({
            errorHandler: function (err) {
                console.error('Error in build js in theme:', err.message);
                this.emit('end');
            }
        }))
        .pipe(uglify())
        .pipe(rename({suffix: '.min'}))
        .pipe(dest(`${paths.output.theme.js}`))
        .pipe(browserSync.stream())
}

// Task build style custom post type
function buildStyleCustomPostType() {
    return src(`${paths.theme.scss}post-type/*/**.scss`)
        .pipe(plumber({
            errorHandler: function (err) {
                console.error(err.message);
                this.emit('end');
            }
        }))
        .pipe(sourcemaps.init())
        .pipe(sass({
            outputStyle: 'expanded'
        }, '').on('error', sass.logError))
        .pipe(cleanCSS ({
            level: 2
        }))
        .pipe(rename({suffix: '.min'}))
        .pipe(sourcemaps.write())
        .pipe(dest(`${paths.output.theme.css}post-type/`))
        .pipe(browserSync.stream())
}

// Task build style page templates
function buildStylePageTemplate() {
    return src(`${paths.theme.scss}page-templates/*.scss`)
        .pipe(plumber({
            errorHandler: function (err) {
                console.error(err.message);
                this.emit('end');
            }
        }))
        .pipe(sourcemaps.init())
        .pipe(sass({
            outputStyle: 'expanded'
        }, '').on('error', sass.logError))
        .pipe(cleanCSS ({
            level: 2
        }))
        .pipe(rename({suffix: '.min'}))
        .pipe(sourcemaps.write())
        .pipe(dest(`${paths.output.theme.css}page-templates/`))
        .pipe(browserSync.stream())
}

/*
** Plugin
* */

// Task build style elementor addons
function buildStyleElementor() {
    return src(`${paths.plugins.efa.scss}efa-elementor.scss`)
        .pipe(plumber({
            errorHandler: function (err) {
                console.error(err.message);
                this.emit('end');
            }
        }))
        .pipe(sourcemaps.init())
        .pipe(sass({
            outputStyle: 'expanded'
        }, '').on('error', sass.logError))
        .pipe(cleanCSS ({
            level: 2
        }))
        .pipe(rename({suffix: '.min'}))
        .pipe(sourcemaps.write())
        .pipe(dest(`${paths.output.plugins.efa.css}`))
        .pipe(browserSync.stream())
}
exports.buildStyleElementor = buildStyleElementor

// Task build style custom login
function buildStyleCustomLogin() {
    return src(`${paths.plugins.efa.scss}efa-custom-login.scss`)
        .pipe(plumber({
            errorHandler: function (err) {
                console.error(err.message);
                this.emit('end');
            }
        }))
        .pipe(sourcemaps.init())
        .pipe(sass({
            outputStyle: 'expanded'
        }, '').on('error', sass.logError))
        .pipe(cleanCSS ({
            level: 2
        }))
        .pipe(rename({suffix: '.min'}))
        .pipe(sourcemaps.write())
        .pipe(dest(`${paths.output.plugins.efa.css}`))
        .pipe(browserSync.stream())
}

function buildJPluginEFA() {
    return src(`${paths.plugins.efa.js}*.js`, {allowEmpty: true})
        .pipe(plumber({
            errorHandler: function (err) {
                console.error('Error in build js in plugin EFA:', err.message);
                this.emit('end');
            }
        }))
        .pipe(uglify())
        .pipe(rename({suffix: '.min'}))
        .pipe(dest(`${paths.output.plugins.efa.js}`))
        .pipe(browserSync.stream())
}

/*
Task build project
* */
async function buildProject() {
    await buildStyleBootstrap()
    await buildLibsBootstrapJS()

    await buildFontawesomeStyle()
    await CopyWebFonts()

    await buildStyleOwlCarousel()
    await buildJsOwlCarouse()

    await buildStyleTheme()
    await buildJSTheme()

    await buildStyleElementor()
    await buildStyleCustomLogin()
    await buildJPluginEFA()

    await buildStyleCustomPostType()

    await buildStylePageTemplate()
}
exports.buildProject = buildProject

// Task watch
function watchTask() {
    server()

    // watch abstracts
    watch([
        `${paths.shared.scss}abstracts/*.scss`
    ], gulp.series(
        buildStyleBootstrap,
        buildStyleTheme,
        buildStyleElementor,
        buildStyleCustomLogin,
        buildStyleCustomPostType,
        buildStylePageTemplate
    ))

    // watch lib bootstrap
    watch([
        `${paths.shared.vendors}bootstrap.scss`
    ], buildStyleBootstrap)

    // theme watch
    watch([
        `${paths.theme.scss}base/*.scss`,
        `${paths.theme.scss}utilities/*.scss`,
        `${paths.theme.scss}components/*.scss`,
        `${paths.theme.scss}layout/*.scss`,
        `${paths.theme.scss}style-theme.scss`,
    ], buildStyleTheme)

    watch([`${paths.theme.js}custom.js`], buildJSTheme)

    watch([
        `${paths.theme.scss}post-type/*/**.scss`
    ], buildStyleCustomPostType)

    watch([
        `${paths.theme.scss}page-templates/*.scss`
    ], buildStylePageTemplate)

    // plugin essentials watch
    watch([
        `${paths.plugins.efa.scss}abstracts/*.scss`,
        `${paths.plugins.efa.scss}addons/*.scss`,
        `${paths.plugins.efa.scss}base/*.scss`,
        `${paths.plugins.efa.scss}components/*.scss`,
        `${paths.plugins.efa.scss}efa-elementor.scss`
    ], buildStyleElementor)

    watch([
        `${paths.plugins.efa.scss}efa-custom-login.scss`
    ], buildStyleCustomLogin)

    watch([`${paths.plugins.efa.js}*.js`], buildJPluginEFA)
}

exports.watchTask = watchTask