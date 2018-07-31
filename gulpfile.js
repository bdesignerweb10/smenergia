var gulp 				= require("gulp");
var sass 				= require("gulp-sass");
var htmlmin 			= require("gulp-htmlmin");
var phpMinify 			= require("gulp-php-minify");
var notify 				= require("gulp-notify");
var concat 				= require("gulp-concat");
var uglify 				= require("gulp-uglify");
var browserSync 		= require("browser-sync").create();
var del 				= require("del");

/* TASKS DO WEBSITE */

/* Tarefas em Cache */
gulp.task("cache:css", function() {
	del("./dist/css/style.css")
});

/* Tarefas em Cache */
gulp.task("cache:js", function() {
	del("./dist/js/app.js")
});

/* Move o arquivo .htaccess para dist/ */
gulp.task("move-htaccess", function() { 
 	return gulp.src('./src/.htaccess') 
 	.pipe(gulp.dest('./dist/'))
 });

/* Compila SCSS para CSS e Minifica e envia para dist/css */
gulp.task("sass", ['cache:css'], function() {
	return gulp.src("./src/scss/style.scss")
				.pipe(sass({outPutStyle: 'compressed'}))
				.on('error', notify.onError({title: "erro scss", message: "<%= error.message %>"}))
				.pipe(gulp.dest("./dist/css"))
				.pipe(browserSync.stream());
});

/* Minifica todo o html e envia para dist/*/
gulp.task("minify-html", function() {
	return gulp.src("./src/*.php")
				.pipe(htmlmin({collapseWhitespace: true}))
				.on('error', notify.onError({title: "erro js", message: "<%= error.message %>"}))
				.pipe(gulp.dest("./dist/"))
				.pipe(browserSync.stream());
});

/* Minifica o PHP e envia para dist/acts*/
gulp.task("minify-php", () => gulp.src('src/acts/*.php', {read: false})
  .pipe(phpMinify())
  .pipe(gulp.dest('dist/acts'))
);

/* Apaga tudo que estiver em js e minifica e envia para dist/js */
gulp.task("js", ['cache:js'], function() {
	return gulp.src("./src/js/app.js")
				.pipe(uglify())
				.pipe(gulp.dest("./dist/js"))
				.pipe(browserSync.stream());
});

 /* Move a pasta css para pasta dist/css */
 gulp.task("css", function() { 
	return gulp.src("./src/css/*.css")
				.pipe(htmlmin({collapseWhitespace: true}))
				.on('error', notify.onError({title: "erro js", message: "<%= error.message %>"}))
				.pipe(gulp.dest("./dist/css/"))
				.pipe(browserSync.stream());
 });

 /* Move todos os arquivos js para pasta dist/js */
 gulp.task("move-js", function() { 
 	return gulp.src('./src/js/*.js') 	 
 	.pipe(gulp.dest('./dist/js'))
 });

 /* move a pasta fonts para pasta dist/fonts */
 gulp.task("move-fonts", function() { 
 	return gulp.src('./src/components/components-font-awesome/fonts/**') 
 	.pipe(gulp.dest('./dist/fonts'))
 });

 /* move a pasta lib para pasta dist/lib */
 gulp.task("move-libs", function() { 
 	return gulp.src('./src/lib/**') 
 	.pipe(gulp.dest('./dist/lib'))
 });

/* Move todos os arquivos .php do acts para dist/acts */
 gulp.task("acts", function() { 
 	return gulp.src('./src/acts/*.php') 
 	.pipe(gulp.dest('./dist/acts'))
 });

 /* move a pasta img para pasta dist/img */
 gulp.task("move-img", function() { 
 	return gulp.src('./src/img/**') 
 	.pipe(gulp.dest('./dist/img'))
 });

 /* Concatena jquery.js, thther.js e bootstrap.js tudo no main.js e envia para dist/js */
gulp.task("concat-js", function() {
	return gulp.src([
					'./src/components/jquery/dist/jquery.js',
					'./src/components/tether/dist/js/tether.js',
					'./src/components/bootstrap/dist/js/bootstrap.js'
				])
				.pipe(concat("main.js"))
				.pipe(gulp.dest("./dist/js"))

});


/* TASKS DO PAINEL ADMIN */

/* Minifica todo o html e envia para dist/admin/*/
gulp.task("minify-html-adm", function() {
	return gulp.src("./src/admin/*.php")
				.pipe(htmlmin({collapseWhitespace: true}))
				.on('error', notify.onError({title: "erro js", message: "<%= error.message %>"}))
				.pipe(gulp.dest("./dist/admin"))
				.pipe(browserSync.stream());
});

/* Minifica o PHP e envia para dist/admin/acts*/
gulp.task("minify-php-adm", () => gulp.src('src/admin/acts/*.php', {read: false})
  .pipe(phpMinify())
  .pipe(gulp.dest('dist/admin/acts'))
);

/* Minifica o arquivo app.js e envia para dist/admin/js */
 gulp.task("admin-js", ['cache:js'], function() {
	return gulp.src("./src/admin/js/app.js")
				.pipe(uglify())
				.on('error', notify.onError({title: "erro js", message: "<%= error.message %>"}))
				.pipe(gulp.dest("./dist/admin/js"))
				.pipe(browserSync.stream());
});

 /* SERVIDOR LOCALHOST */

 /* Servidor local na pasta dist/ */
gulp.task("server", function() {
	browserSync.init({
		server: {
			baseDir: "./dist"
		}
	});

	/* Escutar tudo que for alterado nos arquivos */
	gulp.watch("./src/scss/**/*.scss", ['sass']);
	gulp.watch("./src/components/bootstrap/scss/**/*.scss", ['sass']);
	gulp.watch("./src/js/**/*.js", ['js']);
	gulp.watch("./src/admin/js/*.js", ['admin-js']);
	gulp.watch("./src/acts/*.php", ['minify-php']);
	gulp.watch("./src/**/*.php", ['minify-html']);
	gulp.watch("./src/acts/*.php", ['acts']);
	gulp.watch("./src/css/*.css", ['css']);
	gulp.watch("./src/admin/*.php", ['minify-html-adm']);
	gulp.watch("./src/admin/acts/*.php", ['minify-php-adm']);		
	gulp.watch("./src/js/**/*.js", ['move-js']);
});

/* Inicia todas as tasks do gulp */
gulp.task("default", ["move-htaccess", "sass", "css", "js", "minify-html" ,"minify-php", "move-js", "move-fonts", "move-libs", "acts", "move-img", "concat-js", "minify-html-adm" ,"minify-php-adm" ,"admin-js" ,"server"]);
