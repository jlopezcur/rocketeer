<?php

return [

    /**
     * This property has to be the same as Croppa for correct sync
     */
    'src_dir' => storage_path('app/uploads'),

    /**
     * This property has to be the same as Croppa for correct sync
     */
    'crops_dir' => public_path('thumbs'),

    'allowed_extensions' => [
        'png', 'jpg', 'ico', 'jpeg', 'tiff', 'tif', 'gif',
        'mp4', 'avi',
        'mp3',
        'pdf', 'xlsx', 'xls', 'doc', 'docx',
        'zip'
    ],


];
