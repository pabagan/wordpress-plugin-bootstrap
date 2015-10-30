/*!
 * Pabagan magic gruntfile :0
 * @author @pabagan
 */

'use strict';
/**
 * Livereload and connect variables
 */
var LIVERELOAD_PORT = 35729;
var lrSnippet = require('connect-livereload')({
  port: LIVERELOAD_PORT
});
var mountFolder = function (connect, dir) {
  return connect.static(require('path').resolve(dir));
};

module.exports = function(grunt) {
    
    // Default task load
    //require('load-grunt-tasks')(grunt);
    /**
     * jit-grunt require
     * https://www.npmjs.com/package/jit-grunt
     */
    require('jit-grunt')(grunt);

    // project configuration.
    grunt.initConfig({
      //Read the package.json (optional)
      pkg: grunt.file.readJSON('package.json'),

      /**
       * Theme Access Metadata
       */
      project: {
        /**
         *    Renombrar slug con la carpeta donde este la app
         */
        // Plugin name
        pluginName: 'Geniux Blank',
        pluginSlug: 'geniux-blank',
        
        // routes 
        //root:       '../<%= project.pluginSlug %>',
        root:       '.', // if grunt file is out of the project will do the trick
        src:        '<%= project.root %>/src',
        assets:     '<%= project.root %>/assets',
        
        // CSS files banner
        css_banner: '/* \n' +
                    ' * Name: <%= project.pluginName %>\n' +
                    ' * Version: 1.0' +
                    ' * Author: <%= pkg.author %>\n' +
                    ' * Author URI: <%= pkg.author_uri %>\n' +
                    ' * License: <%= pkg.copyright %>. <%= pkg.license %> licensed.\n' +
                    ' * License URI: <%= pkg.license_uri %>.\n' +
                    ' * \n' +
                    ' * All files, unless otherwise stated, are released under the GNU General Public\n' +
                    ' * License version 3.0 (http://www.gnu.org/licenses/gpl-3.0.html).\n' +
                    ' * All HTML/CSS/JAVASCRIPT code is also released under Envato\'s Regular/Extended License (http://themeforest.net/licenses).\n' +
                    ' */\n',
        
        // JS files banner
        js_banner:  '/*\n' +
                    ' * <%= pkg.title %> Scripts\n' +
                    ' * Author: <%= pkg.author %>\n' +
                    ' * Author URI: <%= pkg.author_uri %>\n' +
                    ' * License: <%= pkg.copyright %>. <%= pkg.license %> licensed.\n' +
                    ' * License URI: <%= pkg.license_uri %>.\n' +
                    ' * \n' +
                    ' * All files, unless otherwise stated, are released under the GNU General Public\n' +
                    ' * License version 3.0 (http://www.gnu.org/licenses/gpl-3.0.html).\n' +
                    ' * All HTML/CSS/JAVASCRIPT code is also released under Envato\'s Regular/Extended License (http://themeforest.net/licenses).\n' +
                    ' */\n',
    },

    /**
     * Sass: (grunt-sass es basado en C -> + rendimiento / - opciones)
     * https://github.com/sindresorhus/grunt-sass
     * 
     * Mantengo el otro para poner en producción el proyecto. Tiene mas
     * opcitones para generar el css definitivo
     * https://github.com/gruntjs/grunt-contrib-sass
     */
    sass: {
      styles: {
        options: {
          // ** Opcion de: grunt-contib-sass **
          // banner: '<%= project.css_banner %>'
          // style: 'expanded', // nested, compact, compressed, expanded
          // quiet: true,
          // sourcemap: 'none'
          
          precision: 3,

          // ** Opcion de: grunt-sass ** 
          outputStyle: 'nested' // nested, compressed.
        },
        files: {
           '<%= project.assets %>/css/style.css': '<%= project.src %>/css/style.scss',
        },
      },
      css_bootstrap: {
        options: {
          // ** Opcion de: grunt-contib-sass **
          // banner: '<%= project.css_banner %>'
          // style: 'expanded', // nested, compact, compressed, expanded
          // quiet: true,
          // sourcemap: 'none'
          
          precision: 3,
          
          // ** Opcion de: grunt-sass ** 
          outputStyle: 'nested' // nested, compressed.
          // Opcion de: grunt-sass
          outputStyle: 'nested' // nested, compressed.
          // fin de: grunt-sass
        },
        files: {
           '<%= project.assets %>/css/vendor/bootstrap.css': '<%= project.src %>/vendor/bootstrap-sass/assets/stylesheets/bootstrap.scss',
        },
      },
    },

    /**
     * Concat
     * https://github.com/gruntjs/grunt-contrib-concat
     */
    concat: {
      // Styles
      styles: {
        //stripBanners: true,
        nonull: true,
        banner: '<%= project.css_banner %>',
        options: {
          separator: '\n'
        },
        src: [
          // Self
          '<%= project.assets %>/css/style.css',
          // BootStrap
          '<%= project.assets %>/css/vendor/bootstrap.css',
        ],
        dest: '<%= project.assets %>/css/styleAllIn.css',
      },

      // Scripts
      scripts: {
        stripBanners: true,
        nonull: true,
        banner: '<%= project.js_banner %>',
        options: {
          separator: '\n'
        },
        src: [
          '<%= project.src %>/js/*.js' ,
        ],
        dest: '<%= project.assets %>/js/scripts.js'
      },
      
      // Bootstrap Scripts (JS)
      js_bootstrap: {
        stripBanners: false,
        nonull: true,
        options: {
          separator: '\n'
        },
        src: [
          '<%= project.src %>/vendor/bootstrap-sass/assets/javascripts/bootstrap/affix.js',
          '<%= project.src %>/vendor/bootstrap-sass/assets/javascripts/bootstrap/alert.js',
          '<%= project.src %>/vendor/bootstrap-sass/assets/javascripts/bootstrap/button.js',
          '<%= project.src %>/vendor/bootstrap-sass/assets/javascripts/bootstrap/carousel.js',
          '<%= project.src %>/vendor/bootstrap-sass/assets/javascripts/bootstrap/collapse.js',
          '<%= project.src %>/vendor/bootstrap-sass/assets/javascripts/bootstrap/dropdown.js',
          '<%= project.src %>/vendor/bootstrap-sass/assets/javascripts/bootstrap/tab.js',
          '<%= project.src %>/vendor/bootstrap-sass/assets/javascripts/bootstrap/transition.js',
          '<%= project.src %>/vendor/bootstrap-sass/assets/javascripts/bootstrap/scrollspy.js',
          '<%= project.src %>/vendor/bootstrap-sass/assets/javascripts/bootstrap/modal.js',
          '<%= project.src %>/vendor/bootstrap-sass/assets/javascripts/bootstrap/tooltip.js',
          '<%= project.src %>/vendor/bootstrap-sass/assets/javascripts/bootstrap/popover.js',
        ],
        dest: '<%= project.assets %>/js/vendor/bootstrap.js'
      },      
    },    
    
    /**
     * CSSMin: CSS minification
     * https://github.com/gruntjs/grunt-contrib-cssmin
     */
    cssmin: {
      // styles
      styles: {
        options: {
          banner: '<%= project.css_banner %>',
          // report: 'min',
          keepLineBreaks: true,
        },
        files: {
          '<%= project.assets %>/css/style.min.css': [
            '<%= project.assets %>/css/style.css',
          ]
        }
      },
      // bootstrap
      css_bootstrap: {
        options: {
          keepLineBreaks: true,
        },
        files: {
          '<%= project.assets %>/css/vendor/bootstrap.min.css': [
            '<%= project.assets %>/css/vendor/bootstrap.css',
          ]
        }
      }
    },    

    /**
     * Uglify (minify) JavaScript files
     * https://github.com/gruntjs/grunt-contrib-uglify
     * Compresses and minifies all JavaScript files into one
     */
    uglify: {
      scripts: {
        options: {
          banner: '<%= project.js_banner %>'
        },
        files: {
          '<%= project.assets %>/js/scripts.min.js': '<%= project.assets %>/js/scripts.js'
        },
      },
      js_bootstrap: {
        options: {
          preserveComments: "all",
        },
        files: {
          '<%= project.assets %>/js/vendor/bootstrap.min.js': '<%= project.assets %>/js/vendor/bootstrap.js'
        },
      }
    },

    /**
     * jsHint
     */
    jshint: {
      scripts: [
        '<%= project.src %>/js/*.js',
      ],
      options: {
        //jshintrc: '.jshintrc'
      }
    },

    /**
    * Watch
    * https://github.com/gruntjs/grunt-contrib-watch
    */
    watch: {
      styles: {
        files: [
          // Self
          '<%= project.src %>/css/**/*.{scss,sass}',
        ],
        tasks: [
          'sass:styles',
          //'concat:styles',
          //'cssmin:styles',
        ],
      },
      css_bootstrap: {
        files: [
          // BootStrap
          '<%= project.src %>/vendor/bootstrap-sass/assets/stylesheets/**/*.{scss,sass}',
        ],
        tasks: [
          'sass:css_bootstrap',
          // 'cssmin:css_bootstrap', // es muy tardón. Activar cuando se necesite.
        ],
      },
      scripts: {
        files: [
          // Self
          '<%= project.src %>/js/**/*.js',
        ],
        tasks: [
          'concat:scripts',
          //'uglify:scripts', // es muy tardón. Activar cuando se necesite.
          'jshint:scripts',
        ],
      },
      js_bootstrap: {
        files: [
          // BootStrap
          '<%= project.src %>/vendor/bootstrap-sass/assets/javascripts/**/*.js',
        ],
        tasks: [
          'concat:js_bootstrap',
          //'uglify:js_bootstrap', // es muy tardón. Activar cuando se necesite.
        ],
      },

      /**
       * LiveReload Watch
       */
      livereload: {
        options: {
          livereload: LIVERELOAD_PORT,
          spawn: false
        },
        files: [
          //'{,*/}*.{html,php,css}',
          '<%= project.root %>/{,*/}*.{html,php,css}',
          '<%= project.assets %>/js/{,*/}*.js',
          '<%= project.assets %>/css/{,*/}*.css',
          '<%= project.assets %>/{,*/}*.{png,jpg,jpeg,gif,webp,svg}'
        ]
      }      
    },

    /**
     * Opens the web server in the browser
     * https://github.com/jsoverson/grunt-open
     */
    open: {
      server: {
        path: 'http://localhost:<%= connect.options.port %>'
      }
    },
    
    /**
     * Connect port/livereload
     * https://github.com/gruntjs/grunt-contrib-connect
     * Starts a local webserver and injects
     * livereload snippet
     */
    connect: {
      options: {
        port: 9000,
        hostname: '*'
      },
      livereload: {
        options: {
          middleware: function (connect) {
            return [lrSnippet, mountFolder(connect, 'app')];
          }
        }
      }
    },

    /**
     * Añadir tarea curl para descargar archivos. curl
     * https://github.com/twolfson/grunt-curl
     */
    // curl: {
    //     'google-fonts-source': { // json de fuentes google
    //         src: 'https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyD6tbn7PASjewfLDcgTw4dJHhoETEcCCPA',
    //         dest: 'assets/vendor/google-fonts/google-fonts.json'
    //     }
    // }, 
  });    
};