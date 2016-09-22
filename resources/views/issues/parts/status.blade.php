<?php
if (!isset($size)) $size = 'small'
?>

@if($size == 'small')
    @if($issue->status == 'open')
        <span class="text-danger">
            <i class="fa fa-exclamation-circle"></i>
        </span>
    @else
        <span class="text-success">
            <i class="fa fa-check"></i>
        </span>
    @endif
@elseif ($size == 'big')
    @if($issue->status == 'open')
        <span class="label label-danger">
            <i class="fa fa-exclamation-circle"></i>
            Opened
        </span>
    @else
        <span class="label label-success">
            <i class="fa fa-check"></i>
            Closed
        </span>
    @endif
@endif
