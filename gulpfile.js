var elixir = require('laravel-elixir');

var bowerDir = './resources/assets/bower/';

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix
        .styles([
            'bootstrap/dist/css/bootstrap.min.css',
            'select2/dist/css/select2.min.css',
            'bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css',
            'font-awesome/css/font-awesome.min.css',
            'summernote/dist/summernote.css',
            'swipebox/src/css/swipebox.min.css',

            'seiyria-bootstrap-slider/dist/css/bootstrap-slider.min.css',
            'bootstrap-markdown-editor/dist/css/bootstrap-markdown-editor.css',
            'admin-lte/dist/css/AdminLTE.min.css',
            'admin-lte/dist/css/skins/skin-blue.min.css',
            'admin-lte/dist/css/AdminLTE.min.css',

        ], 'public/css/vendor.css', bowerDir)

        .styles([
            'master.css'
        ], 'public/css/master.css')

        .scripts([
            'jquery/dist/jquery.min.js',
            'underscore/underscore-min.js',
            'bootstrap/dist/js/bootstrap.min.js',
            'select2/dist/js/select2.min.js',
            'bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js',
            'bower-jquery-sparkline/dist/jquery.sparkline.retina.js',
            'fastclick/lib/fastclick.js',
            'seiyria-bootstrap-slider/dist/bootstrap-slider.min.js',
            'summernote/dist/summernote.min.js',
            'swipebox/src/js/jquery.swipebox.min.js',

            // Flot
            'flot/jquery.flot.js',
            'flot/jquery.flot.resize.js',
            'flot/jquery.flot.categories.js',

            // Markdown editor
            'ace-builds/src-min/ace.js',
            'ace-builds/src-min/mode-markdown.js',
            'ace-builds/src-min/theme-tomorrow.js',
            'ace-builds/src-min/ext-language_tools.js',
            'bootstrap-markdown-editor/dist/js/bootstrap-markdown-editor.js',

            'showdown/dist/showdown.min.js',

            'admin-lte/dist/js/app.min.js'
        ], 'public/js/vendor.js', bowerDir)

        .scripts([
            'master.js'
        ], 'public/js/master.js');

    mix.copy(bowerDir + 'swipebox/src/img', 'public/img');

    mix.copy(bowerDir + 'font-awesome/fonts', 'public/fonts');
    mix.copy(bowerDir + 'summernote/dist/font', 'public/css/font');
    mix.copy(bowerDir + 'bootstrap/fonts', 'public/fonts');
});
