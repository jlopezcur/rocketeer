<?php

Form::macro('select2', function($name = "", $options = [], $default = null)
{
    $out = Form::select($name, $options, $default, ['class' => 'select2', 'style' => 'width: 100%']);
    return $out;
});

Form::macro('select2multiple', function($name = "", $options = [], $default = null)
{
    $out = Form::select($name, $options, $default, ['class' => 'select2', 'style' => 'width: 100%', 'multiple' => 'multiple']);
    return $out;
});

Form::macro('summernote', function($name = "", $default = null, $properties = [])
{
    $out = Form::textarea($name, $default, ['class' => 'summernote']);
    return $out;
});

Form::macro('yesno', function ($name = '', $default = null) {
    $value = Form::getValueAttribute($name, $default);
    $out = '<br>';
    $out .= '<label>'.Form::radio($name, 1, $value).' '.trans('yes').'</label> ';
    $out .= '<label>'.Form::radio($name, 0, !$value).' '.trans('no').'</label>';
    return $out;
});

Form::macro('status', function($name = 'status', $default = null)
{
    $out = Form::select($name, [
        '0' => trans('disabled'),
        '1' => trans('enabled'),
    ], $default, ['class' => 'select2', 'style' => 'width: 100%']);
    return $out;
});

Form::macro('localized_field', function($name = "", $options = [], $type = 'text')
{
    $block_id = str_random(10);
    $locales = App\Locale::get();
    $old_locale = App::getLocale();

    if (empty($options['default'])) $options['default'] = null;
    if (empty($options['class'])) $options['class'] = 'form-control';
    if (empty($options['label'])) $options['label'] = 'Label missing...';

    $out = '<div class="nav-tabs-custom">';
    $out .= '<ul class="nav nav-tabs">';
    foreach ($locales as $i => $locale) {
        $out .= '<li class="' . ($i == 0 ? 'active' : '') . '">';
        $out .= '<a href="#tab_' . $locale->id . '_' . $block_id . '" data-toggle="tab">';
        $out .= '<img src="' . asset('img/flags/' . $locale->id . '.png') . '" alt="' . $locale->name . '" /> ';
        $out .= $locale->name;
        $out .= '</a></li>';
    }
    $out .= '</ul>';
    $out .= '<div class="tab-content">';
    foreach ($locales as $i => $locale) {
        $out .= '<div class="tab-pane ' . ($i == 0 ? 'active' : '') . '" id="tab_' . $locale->id . '_' . $block_id . '">';
        $out .= '<div class="form-group">';

        App::setLocale($locale->id);
        $value = Form::getValueAttribute($name, $options['default']);
        $out .= Form::label($locale->id . '[' . $name . ']', $options['label']);
        $out .= Form::{$type}($locale->id . '[' . $name . ']', $value, $options);
        $out .= '</div></div>';
    }
    $out .= '</div></div>';
    App::setLocale($old_locale);

    return $out;
});
