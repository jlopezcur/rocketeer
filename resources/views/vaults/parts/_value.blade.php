@if (in_array($pair->key, ['pass', 'password']))
    <span id="pass_hide_{{ $pair->id }}">{!! str_repeat("&bullet;", strlen($pair->value)) !!}</span>
    <span id="pass_show_{{ $pair->id }}" style="display:none">{{ $pair->value }}</span>
    <a href="javascript:;" onclick="$('#pass_hide_{{ $pair->id }}').toggle(); $('#pass_show_{{ $pair->id }}').toggle();"><i class="fa fa-eye"></i></a>
@elseif(in_array($pair->key, ['web', 'website', 'link']))
    <a href="{{ $pair->value }}" target="_blank">{{ $pair->value }}</a>
@elseif (in_array($pair->key, ['mail', 'mailbox']))
    <a href="mailto:{{ $pair->value }}">{{ $pair->value }}</a>
@else
    {{ $pair->value }}
@endif
