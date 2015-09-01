// Include Our Plugins
var gulp = require('gulp');  
var    notify = require("gulp-notify");
var  bower = require('gulp-bower');   
var jshint = require('gulp-jshint');
var sass = require('gulp-sass');
var concat = require('gulp-concat');
var concatCss = require('gulp-concat-css');
var uglify = require('gulp-uglify');
var rename = require('gulp-rename');
var browserify = require('gulp-browserify');
//var clean = require('gulp-clean');
var minifyCSS = require('gulp-minify-css');
var cssImport = require("gulp-cssimport");
var sourcemaps = require('gulp-sourcemaps'); 
var plumber= require("gulp-plumber");
var gutil = require('gulp-util');
merge = require('merge-stream');
var config = {
    sassPath: './resources/sass',
    bowerDir: './assets' 
}

var minifyCssOptions = {
        inliner: {
            request: {
                  hostname: "localhost",   // I'm running a cntlm proxy which relays to the corp proxy
                  port: 3128,
                  path: "http://fonts.googleapis.com/css?family=Raleway:400,700,300",
                  headers: {
                    Host: "fonts.googleapis.com"
                  }
            }
        }
};


	gulp.task('bower', function() { 
		return bower()
			 .pipe(gulp.dest(config.bowerDir)) ;
	});

	gulp.task('complile_font_awesome', function() { 
		return gulp.src(config.bowerDir + '/font-awesome/fonts/**.*') 
			.pipe(gulp.dest('./public/fonts'))  
	});
  

//define default task
gulp.task('complile_css', function () {
    var sassStream,
        cssStream;

    //compile sass
    sassStream =   gulp.src(config.sassPath + '/style.scss')
				  .pipe(sourcemaps.init())
				  .pipe(sass({
						outputStyle: 'compressed',
						includePaths: [config.bowerDir + '/bootstrap-sass/assets/stylesheets'],
						includePaths: [config.bowerDir + '/bootstrap-sass/assets/stylesheets/bootstrap'],
						includePaths: [config.bowerDir + '/font-awesome/scss'],
						//includePaths: [config.bowerDir + '/bootstrap-sass/assets/stylesheets'],
					}))
				  .pipe(sourcemaps.write());

    //select additional css files
      cssStream = gulp.src('./assets/main/main.css');

    //merge the two streams and concatenate their contents into a single file
    return merge(sassStream, cssStream)
				.pipe(concat('style.min.css'))
				.pipe(gulp.dest('./public/css')) 
				.pipe(cssImport())
				.pipe(minifyCSS({skip_import: true}))
				.pipe(rename('style.min.css'))
				.pipe(gulp.dest('./public/css'));
}); 
  


	gulp.task('bootstrapAngularjs', function() {
	  return gulp.src([
	  	
		config.bowerDir + '/jquery/dist/jquery.min.js',
	    config.bowerDir + '/bootstrap-sass/assets/javascripts/bootstrap.js',
		config.bowerDir + '/angular/angular.js',
		config.bowerDir + '/angular-route/angular-route.js', config.bowerDir + '/main/*.js',
	
		
	  ]).pipe(plumber())
	   	.pipe(jshint()) // run their contents through jshint
		 
	    .pipe(concat('app.js')) // concatenate all of the file contents into a file titled 'all.js'
		.pipe(gulp.dest('./public/js')) // write that file to the dist/js directory
		.pipe(rename('app.min.js')) // now rename the file in memory to 'all.min.js'
		.pipe(uglify()) // run uglify (for minification) on 'all.min.js'
		.pipe(gulp.dest('./public/js')); // write all.min.js to the dist/js file
	});
	 
	gulp.task('compileAngularjs', function() {
	  return gulp.src([
	  	
	       config.bowerDir + '/main/*.js' 
	
		
	  ]).pipe(plumber())
	   	.pipe(jshint()) // run their contents through jshint 
		.pipe(rename('main.min.js')) // now rename the file in memory to 'all.min.js'
		.pipe(uglify ({mangle: false}))  // run uglify (for minification) on 'all.min.js'
		.pipe(gulp.dest('./public/js')); // write all.min.js to the dist/js file
	}); 
	
	//for future, streamque is used for making sequence of steam
	
    // Rerun the task when a file changes
	gulp.task('watch', function() {
		 gulp.watch(config.bowerDir + '/font-awesome/fonts/**.*', ['complile_font_awesome']); 
		 gulp.watch(config.bowerDir + '/bootstrap-sass/assets/stylesheets/**/*.scss', ['complile_css']);
		 // gulp.watch(config.bowerDir + '/bootstrap-sass/assets/stylesheets/**/*.scss', ['bootstrapAngularjs']); 
		 
		 
	});




 gulp.task('default', ['bower', 'complile_font_awesome', 'complile_css',  'bootstrapAngularjs','compileAngularjs','watch']);
