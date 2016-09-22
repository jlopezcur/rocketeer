{{-- Show icon as response for key --}}

@if (in_array($pair->key, ['host', 'hostname', 'web', 'website', 'link']))
    <i class="fa fa-globe"></i>
@elseif (in_array($pair->key, ['user', 'username']))
    <i class="fa fa-user"></i>
@elseif (in_array($pair->key, ['pass', 'password']))
    <i class="fa fa-asterisk"></i>
@elseif (in_array($pair->key, ['db', 'database']))
    <i class="fa fa-database"></i>
@elseif (in_array($pair->key, ['mail', 'mailbox']))
    <i class="fa fa-envelope"></i>
@endif

{{ $pair->key }}
