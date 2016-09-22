<?php

if(!function_exists('make_remove_dialog')) {
    function make_remove_dialog($options = []) {
        $options = array_merge([
            'link_class' => 'btn btn-primary',
            'link_content' => 'Modal Launcher',
            'title' => 'Remove Modal Title',
            'cotent' => 'Remove Modal Content',
            'id' => 0,
            'route' => []
        ], $options);

        return make_dialog($options);
    }
}

if(!function_exists('make_dialog')) {
    function make_dialog($options = []) {
        $options = array_merge([
            'effect' => 'fade',
            'link_class' => 'btn btn-primary',
            'link_content' => 'Modal Launcher',
            'title' => 'Modal Title',
            'cotent' => 'Modal Content',
            'id' => 0,
            'route' => '#',
            'url' => '#'
        ], $options);

        $out = '<a href="javascript:;" class="' . $options['link_class'] . '" data-toggle="modal" data-target="#' . $options['id'] . '">' . $options['link_content'] . '</a>';
        $out .= '<div class="modal ' . $options['effect'] . '" id="' . $options['id'] . '" tabindex="-1" role="dialog" aria-labelledby="' . $options['id'] .'" aria-hidden="true" style="color: #515151;">
            <div class="modal-dialog text-left">
                <div class="modal-content">
                    <div class="modal-header">
                        <button class="close" data-dismiss="modal" type="button"><span>×</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title">' . $options['title'] . '</h4>
                    </div>
                    <div class="modal-body">' . $options['content'] . '</div>
                    <div class="modal-footer">';
        if ($options['route'] != '#') $out .= Form::open(['method' => 'DELETE', 'route' => $options['route']]);

        $out .= '<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>';

        if ($options['route'] != '#') {
            $out .= Form::submit('Delete', ['class' => 'btn btn-danger']);
            $out .= Form::close();
        }
        $out .= '</div></div></div></div>';

        return $out;
    }
}
