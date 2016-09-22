<a href="{{ url(Request::path() . '?q=is:open') }}" class="text-danger">
    <i class="fa fa-exclamation-circle"></i>
    {{ App\Issue::filterProject($project)->where('status', 'open')->get()->count() }} {!! trans('issues.open') !!}
</a>
<a href="{{ url(Request::path() . '?q=is:closed') }}" class="text-success">
    <i class="fa fa-check"></i>
    {{ App\Issue::filterProject($project)->where('status', 'closed')->get()->count() }} {!! trans('issues.closed') !!}
</a>
