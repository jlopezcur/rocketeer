<?php

if (class_exists('Form')) {    
    Form::macro('mediamanager', function ($name = null, $default = null, $options = []) {
        $out = Form::hidden($name, $default, ['class' => 'mediamanager']);
        return $out;
    });
}
