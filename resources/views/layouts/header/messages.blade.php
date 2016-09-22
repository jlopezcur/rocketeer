@if(!empty(session('message')))
    <?php $message = session('message') ?>
    <div class="alert alert-{{ $message['status'] }} alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        @if($message['status'] == 'success')
            <h4><i class="icon fa fa-check"></i> Success!</h4>
        @elseif($message['status'] == 'danger')
            <h4><i class="icon fa fa-times"></i> Error!</h4>
        @elseif($message['status'] == 'warning')
            <h4><i class="icon fa fa-warning"></i> Warning!</h4>
        @endif
        {{ $message['content'] }}
    </div>
@endif
