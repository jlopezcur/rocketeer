$.widget("kld.mediamanager", {

    options: {
        path: '',

        // Preview
        previewResizer: '/thumbs/[PATH]-[WIDTH]x[HEIGHT]-resize.[EXT]',
        previewAllowedExtensions: ['jpg', 'jpeg', 'gif', 'png'],

        // Icons & Mime Types
        iconFolder: '<i class="fa fa-folder fa-5x" style="margin-top: 22px;"></i>',
        iconImage: '<i class="fa fa-file-image-o fa-5x" style="margin-top: 22px;"></i>',
        iconVideo: '<i class="fa fa-file-video-o fa-5x" style="margin-top: 22px;"></i>',
        iconSound: '<i class="fa fa-file-sound-o fa-5x" style="margin-top: 22px;"></i>',
        iconFile: '<i class="fa fa-file-o fa-5x" style="margin-top: 22px;"></i>',
        mimeTypesImage: ['jpg', 'jpeg', 'gif', 'png', 'tiff', 'tif', 'bmp', 'ico'],
        mimeTypesVideo: ['mp4', 'avi', 'flv', 'ogv'],
        mimeTypesAudio: ['mp3', 'wav', 'ogg'],

        serviceGet: '', // Uri for get the files and dirs
        serviceUpload: '', // Uri for get the files and dirs
        serviceNewFolder: '', // Uri for create new folder
        serviceDelete: '', // Uri for delete files and folders

        _items: 0,
        _parent_path: '',
        _current_path: '',
        _dropzone_instance: null,

        _item_width: 100,
        _item_height: 100,

        noImage: 'http://seniorcapital.eu/wp-content/themes/patus/images/no-image-half-landscape.png',

        // Translations
        translationTitle: 'Media Manager',
        translationSearch: 'Search...',
        translationClose: 'Close',
        translationUseUri: 'Use URI',
        translationClearUri: 'Clear_URI',
        translationDropHere: 'Drop files here to upload',
        translationNewFolder: 'New Folder',
        translationCreate: 'Create',
        translationDefaultNewFolderName: 'new_folder',
        translationAreYouSureDeleteFiles: 'Are you sure to delete this files?',
        translationDelete: 'Delete',
        translationError: 'Error',

        // Options for uploads
        maxFilesize: 2 // MB
    },

    _create: function() {
        var inst = this;
        this.element.attr('type', 'hidden');
        this.element.wrap('<div class="image_manager_div"></div>');
        this.element.after(this._build_component());

        if ($('#demo-default-modal').length === 0) {

            html = this._build_modal();
            html += this._build_new_folder_modal();
            html += this._build_delete_modal();
            $('body').append(html);

            _dropzone_instance = new Dropzone(".file-manager-container", {
                url: this.options.serviceUpload,
                paramName: "file", // The name that will be used to transfer the file
                maxFilesize: this.options.maxFilesize, // MB
                dictDefaultMessage: this.options.translationDropHere,
                sending: function(file, xhr, formData) {
                    formData.append("_token", $('[name=_token').val());
                },
                init: function() {
                    this.on("processing", function(file) {
                        this.options.url = inst.options.serviceUpload + inst.options._current_path;
                    });
                }
            });

            _dropzone_instance.on("complete", function(file) {
                _dropzone_instance.removeFile(file);
                inst._load();
            });

            $('.file-manager-container').css({
                'overflow': 'auto',
                'overflow-x': 'hidden',
                'height': $(window).height() - 300
            });

            this.options._current_path = this.options._parent_path = this.options.path;
            this._behaviours();
            this._load();
        }

        this.element.parent().find('.btnMediaManagerTrigger').on('click', function () {
            $('#demo-default-modal').modal('show');
            $('#demo-default-modal').data('current_element', inst.element);
        });
    },

    /**
     * Refresh the current path of the manager
     */
    refresh: function( value ) {
        this._load();
    },

    /**
     * Get/Set current path of the manager
     */
    path: function (value) {
        if (value === undefined) {
            return this.options._current_path;
        } else {
            this._change_path(value);
            this._load();
        }
    },



    /**
     * Load current path of the manager
     */
    _load: function() {
        $('.file-manager-content').html('');
        $('#button-refresh i').addClass('fa-spin');
        this.options.items = 0;
        var inst = this;
        var uri = this.options.serviceGet + this.options._current_path;
        $.get(uri, function (data) {
            if (data) {
                var html = '';
                if (inst.options._current_path !== '') html += inst._generate_backdir();
                $.each(data.dirs, function (index, value) {
                    if (inst.options.items % 4 === 0) html += '<div class="row">';
                    html += inst._generate_dir(value);
                    if (inst.options.items % 4 === 0) html += '</div>';
                });
                $.each(data.files, function (index, value) {
                    if (inst.options.items % 4 === 0) html += '<div class="row">';
                    html += inst._generate_file(value);
                    if (inst.options.items % 4 === 0) html += '</div>';
                });
                $('.file-manager-content').append(html);
                $('#button-refresh i').removeClass('fa-spin');
            }
        });
    },

    _process_filename_for_resize: function (path, width, height) {
        var newim = this.options.previewResizer;
        var parts = path.split('.');
        var ext = parts.pop();
        var path_without_ext = parts.join('.');
        newim = newim.replace('[PATH]', path_without_ext);
        newim = newim.replace('[EXT]', ext);
        newim = newim.replace('[WIDTH]', width);
        newim = newim.replace('[HEIGHT]', height);
        newim = newim.replace('//', '/');
        console.log(newim);
        return newim;
    },

    _save_selection: function () {
        var value = $('.input-uri').val();
        var el = $('#demo-default-modal').data('current_element');
        el.val(value);

        var image = value;
        if (image === '') image = this.options.noImage;
        else {
            if (!this._is_resource_external(image)) {
                if (this._is_resize_allowed(image)) {
                    image = this._process_filename_for_resize(image, this.options._item_width, this.options._item_height);
                }
            }
        }

        image = image.replace('&amp;', '&');
        $('.img-preview', el.parent()).attr('src', image);
        $('#demo-default-modal').modal('hide');
    },

    /**
     * Add behaviours for the manager
     */
    _behaviours: function () {
        var inst = this;

        // Select one image
        $('.file-manager-content').on('click', '.file a', function () {
            $('.input-uri').val($(this).parent().attr('data-val'));
            inst._save_selection();
        });

        $('.file-manager-content').on('click', '.dir a, .back a', function () {
            inst._change_path($(this).parent().attr('data-val'));
            inst._load();
        });

        $('.file-manager-content').on('mouseenter', '.dir a, .back a', function () {
            $(this).find('i').removeClass('fa-folder').addClass('fa-folder-open');
        });

        $('.file-manager-content').on('mouseleave', '.dir a, .back a', function () {
            $(this).find('i').removeClass('fa-folder-open').addClass('fa-folder');
        });

        $('.btn-parent').on('click', function () {
            inst._change_path(inst._get_parent_path());
            inst._load();
        });

        $('.btn-refresh').on('click', function () {
            inst.refresh();
        });

        $('#demo-default-modal').on('show.bs.modal', function (e) {
            $('.input-uri').val(inst.element.val());
            $('.file-manager-container').css({
                'overflow': 'auto',
                'overflow-x': 'hidden',
                'height': $(window).height() - 300
            });
        });

        $('#btnNewFolder').on('click', function () {
            $('#new_folder_modal').modal('show');
            $('#inputNewFolder').val(inst.options._current_path + '/' + inst.options.translationDefaultNewFolderName);
            $('#inputNewFolder').focus();
        });

        $('#btnCreateNewFolder').on('click', function () {
            var uri = inst.options.serviceNewFolder + $('#inputNewFolder').val();
            $.get(uri, function (data) {
                inst._load();
            });
            $('#new_folder_modal').modal('hide');
        });

        $('#btnDelete').on('click', function () {
            var selected_files = inst._get_selected_files();
            if (selected_files.length > 0) {
                var html = '';
                $.each(selected_files, function (index, value) {
                    html += '<li>' + value + '</li>';
                });
                $('#listSelectedFiles').html(html);
                $('#delete_modal').modal('show');
            }
        });

        $('#btnDeleteNow').on('click', function () {
            var selected_files = inst._get_selected_files();
            var uri = inst.options.serviceDelete;
            $.post(uri, { files: selected_files, "_token": $('[name=_token').val() },  function (data) {
                if (data == 'ok') inst._load();
                else {
                    $('#error_modal').find('.modal-body').html('<p>' + data + '</p>')
                    $('#error_modal').modal('show');
                }
            });
            $('#delete_modal').modal('hide');
        });

        // Save the content on uri
        $('#btnUseURI').on('click', function () {
            inst._save_selection();
        });

        // Clear URI and save
        $('#btnClearURI').on('click', function () {
            $('.input-uri').val('');
            inst._save_selection();
        });

        // Search
        $('#search').on('keyup', function (e) {
            var val = $('#search').val();
            //console.log(val);
            if (val === '') {
                $('.file, .dir').fadeIn('fast');
            } else {
                $('.file, .dir').each(function () {
                    var label = $(this).find('label').find('div').text();
                    if (label.indexOf(val) == -1) $(this).fadeOut('fast');
                    else $(this).fadeIn('fast');
                });
            }
        });
    },

    _get_extension: function (file) {
        return file.split('.').pop();
    },

    _is_resize_allowed: function (file) {
        return ($.inArray(this._get_extension(file), this.options.previewAllowedExtensions) !== -1);
    },

    _is_resource_external: function (uri) {
        return (uri.indexOf('http://') === 0 || uri.indexOf('https://') === 0);
    },

    _get_mime_type: function (file) {
        var extension = this._get_extension(file);
        if ($.inArray(extension, this.options.mimeTypesImage) !== -1) return 'image';
        if ($.inArray(extension, this.options.mimeTypesVideo) !== -1) return 'video';
        if ($.inArray(extension, this.options.mimeTypesSound) !== -1) return 'sound';
        return 'file';
    },

    _change_path: function (new_path) {
        this.options._parent_path = this.options._current_path;
        this.options._current_path = new_path;
        $('.file-manager-container').attr('action', this.options.upload + '/');
    },

    _get_parent_path: function () {
        var tmp = this.options._current_path;
        tmp = tmp.split('/');
        tmp.pop();
        tmp = tmp.join('/');
        return tmp;
    },

    _get_selected_files: function () {
        var selected_files = [];
        $('.file-manager-container input[type=checkbox]:checked').each(function (index) {
            selected_files.push($(this).val());
        });
        return selected_files;
    },

    /**
     * Generators
     */

    _generate_backdir: function () {
        return this._generate_item(this._get_parent_path(), this.options.iconFolder, '..', 'back');
    },

    _generate_dir: function (dir) {
        return this._generate_item(this.options._current_path + '/' + dir, this.options.iconFolder, dir, 'dir');
    },

    _generate_file: function (file) {
        var image = this.options.iconImage;
        var mime_type = this._get_mime_type(file);
        if (mime_type == 'image') {
            if (this._is_resize_allowed(file)) {
                var path = file; if (this.options._current_path !== '') path = this.options._current_path + '/' + path;
                var newim = this._process_filename_for_resize(path, this.options._item_width, this.options._item_height);
                //image = '<img src="' + newim + '" alt="' + file + '" title="' + file + '">';
                image = '<div style="background: url('+newim+') no-repeat center center; background-size: contain;"></div>';
            }
        } else {
            if (mime_type == 'video') image = this.options.iconVideo;
            else if (mime_type == 'sound') image = this.options.iconSound;
            else image = this.options.iconFile;
        }

        //console.log(image);

        return this._generate_item(this.options._current_path + '/' + file, image, file, 'file');
    },

    _generate_item: function (val, image, title, type) {
        var html = '<div class="col-sm-3 text-center '+type+'" data-val="'+val+'" style="margin-bottom:16px;">';
        html += '<a href="#" class="thumbnail" style="height:110px; margin-bottom:8px;">'+image+'</a>';
        html += '<label>';
        if (type != 'back') html += '<input type="checkbox" value="'+val+'"> ';
        html += '<div style="overflow:hidden;">'+title+'</div></label>';
        html += '</div>';
        this.options.items++;
        return html;
    },

    /**
     * Building the interface
     */

    _build_component: function () {
        var image = this.element.val();
        if (image === '') image = this.options.noImage;
        else {
            if (!this._is_resource_external(image)) {
                if (this._is_resize_allowed(image)) {
                    var path = image; if (this.options._current_path !== '') path = this.options._current_path + '/' + path;
                    image = this._process_filename_for_resize(path, this.options._item_width, this.options._item_height);
                }
            }
        }

        /*jshint multistr: true */
        var html = '<a href="#" class="btnMediaManagerTrigger">\
                <img alt="" class="img-preview thumbnail" src="'+image+'" style="display:inline-block;margin-bottom:0;max-width: 100px;max-height: 100px;">\
            </a>';

        return html;
    },

    _build_modal: function () {
        /*jshint multistr: true */
        var html = '<div class="modal fade" id="demo-default-modal" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">\
            <div class="modal-dialog modal-lg">\
     		    <div class="modal-content">';
        html += this._build_modal_header();
        html += this._build_modal_body();
        html += this._build_modal_footer();
        html += this._build_error_modal();
        html += '</div>\
            </div>\
        </div>';
        return html;
    },

    _build_modal_header: function () {
        /*jshint multistr: true */
        var html = '<div class="modal-header">\
            <button data-dismiss="modal" class="close" type="button">\
            <span aria-hidden="true">&times;</span>\
            </button>\
            <h4 class="modal-title">'+this.options.translationTitle+'</h4>\
        </div>';
        return html;
    },

    _build_modal_body: function () {
        /*jshint multistr: true */
        var html = '<div class="modal-body">';
        html += this._build_modal_toolbar();
        html += '<hr>\
            <form action="'+this.options.upload+'" class="file-manager-container">\
                <div class="file-manager-content" style="padding: 0 8px 0 8px;"></div>\
            </form>\
            <div style="clear:both;"></div>\
        </div>';
        return html;
    },

    _build_modal_toolbar: function () {
        /*jshint multistr: true */
        var html = '<div class="row">\
            <div class="col-sm-5">\
                <a href="#" data-toggle="tooltip" title="" id="button-parent" class="btn btn-default btn-parent" data-original-title="Parent"><i class="fa fa-level-up"></i></a>\
                <a href="#" data-toggle="tooltip" title="" id="button-refresh" class="btn btn-default btn-refresh" data-original-title="Refresh"><i class="fa fa-refresh"></i></a>\
                <button type="button" data-toggle="tooltip" title="" id="button-upload" onclick="$(\'.file-manager-container\').click()" class="btn btn-primary" data-original-title="Upload"><i class="fa fa-upload"></i></button>\
                <input type="file" id="file-select" name="files[]" style="display:none;" multiple/>\
                <button type="button" data-toggle="tooltip" title="'+this.options.translationNewFolder+'" id="btnNewFolder" class="btn btn-default" data-original-title="'+this.options.translationNewFolder+'"><i class="fa fa-folder"></i></button>\
                <button type="button" data-toggle="tooltip" title="'+this.options.translationDelete+'" id="btnDelete" class="btn btn-danger" data-original-title="'+this.options.translationDelete+'"><i class="fa fa-trash-o"></i></button>\
            </div>\
            <div class="col-sm-7">\
                <div class="input-group">\
                    <input type="text" name="search" id="search" value="" placeholder="'+this.options.translationSearch+'.." class="form-control">\
                    <span class="input-group-btn">\
                        <button type="button" data-toggle="tooltip" title="" id="button-search" class="btn btn-primary" data-original-title="Search"><i class="fa fa-search"></i></button>\
                    </span>\
                </div>\
            </div>\
        </div>';
        return html;
    },

    _build_modal_footer: function () {
        /*jshint multistr: true */
        var html = '<div class="modal-footer">\
            <div class="row">\
                <div class="col-md-8">\
                    <div class="form-group">\
                        <input type="text" value="'+this.element.val()+'" class="form-control input-uri">\
                    </div>\
                </div>\
                <div class="col-md-4">\
                    <div class="form-group">\
                        <button type="button" class="btn btn-default" data-dismiss="modal">'+this.options.translationClose+'</button>\
                        <button type="button" class="btn btn-primary" id="btnUseURI">'+this.options.translationUseUri+'</button>\
                        <button type="button" class="btn btn-danger" id="btnClearURI">'+this.options.translationClearUri+'</button>\
                    </div>\
                </div>\
            </div>\
        </div>';
        return html;
    },

    _build_new_folder_modal: function () {
        /*jshint multistr: true */
        var html = '<div class="modal fade" id="new_folder_modal">\
            <div class="modal-dialog">\
                <div class="modal-content">\
                    <div class="modal-header">\
                        <button type="button" class="close" data-dismiss="modal" aria-label="'+this.options.translationClose+'"><span aria-hidden="true">&times;</span></button>\
                        <h4 class="modal-title">'+this.options.translationNewFolder+'</h4>\
                    </div>\
                    <div class="modal-body">\
                        <p><input type="text" class="form-control" id="inputNewFolder" placeholder="'+this.options.translationNewFolder+'" /></p>\
                    </div>\
                    <div class="modal-footer">\
                        <button type="button" class="btn btn-default" data-dismiss="modal">'+this.options.translationClose+'</button>\
                        <button type="button" class="btn btn-primary" id="btnCreateNewFolder">'+this.options.translationCreate+'</button>\
                    </div>\
                </div>\
            </div>\
        </div>';
        return html;
    },

    _build_delete_modal: function () {
        /*jshint multistr: true */
        var html = '<div class="modal fade" id="delete_modal">\
            <div class="modal-dialog">\
                <div class="modal-content">\
                    <div class="modal-header">\
                        <button type="button" class="close" data-dismiss="modal" aria-label="'+this.options.translationClose+'"><span aria-hidden="true">&times;</span></button>\
                        <h4 class="modal-title">'+this.options.translationDelete+'</h4>\
                    </div>\
                    <div class="modal-body">\
                        <p>'+this.options.translationAreYouSureDeleteFiles+'<br/><ul id="listSelectedFiles"></ul></p>\
                    </div>\
                    <div class="modal-footer">\
                        <button type="button" class="btn btn-default" data-dismiss="modal">'+this.options.translationClose+'</button>\
                        <button type="button" class="btn btn-danger" id="btnDeleteNow">'+this.options.translationDelete+'</button>\
                    </div>\
                </div>\
            </div>\
        </div>';
        return html;
    },

    _build_error_modal: function () {
        /*jshint multistr: true */
        var html = '<div class="modal fade" id="error_modal">\
            <div class="modal-dialog">\
                <div class="modal-content">\
                    <div class="modal-header">\
                        <button type="button" class="close" data-dismiss="modal" aria-label="'+this.options.translationClose+'"><span aria-hidden="true">&times;</span></button>\
                        <h4 class="modal-title">'+this.options.translationError+'</h4>\
                    </div>\
                    <div class="modal-body"></div>\
                    <div class="modal-footer">\
                        <button type="button" class="btn btn-default" data-dismiss="modal">'+this.options.translationClose+'</button>\
                    </div>\
                </div>\
            </div>\
        </div>';
        return html;
    }

});
