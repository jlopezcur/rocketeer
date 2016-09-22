<div class="col-md-3">
    <div class="box box-widget widget-user-2">
        <div class="widget-user-header bg-maroon">
            <div class="widget-user-image">
                @if(!empty($vault->image))
                    <img src="{{ asset('system/App/Vault/web/'.$vault->id.'_'.md5($vault->web).'.jpg') }}" alt="" class="img-responsive" />
                @else
                    <span class="fa-stack fa-2x fa-pull-left">
                        <i class="fa fa-circle fa-stack-2x"></i>
                        <i class="fa fa-key fa-stack-1x text-maroon"></i>
                    </span>
                @endif
            </div>
            <h3 class="widget-user-username"><a href="{{ route('vaults.show', [$vault->id]) }}">{{ $vault->name }}</a></h3>
            <h5 class="widget-user-desc">
                @if($vault->children()->count() > 0)
                    {{ $vault->children()->count() }} children
                @else
                    &nbsp;
                @endif
            </h5>
        </div>

        <div class="box-footer">
            <div class="pull-right">
                <a href="{{ route('vaults.edit', [$vault->id]) }}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a>
                {!! make_remove_dialog([
                    'id' => 'deleteVault'.$vault->id,
                    'link_content' => '<i class="fa fa-trash"></i>',
                    'link_class' => 'btn btn-danger btn-xs',
                    'content' => 'Are you sure to delete vault with name: '.$vault->name.'<br />This process can\'t be undone.',
                    'title' => trans('vaults.delete_vault'),
                    'route' => ['vaults.destroy', $vault->id]
                    ]) !!}
            </div>

            @if(isset($vault->project->id))
                <a href="{{ route('projects.show', [$vault->project->slug]) }}"><i class="fa fa-briefcase"></i> {{ $vault->project->name }}</a>
            @endif
        </div>
    </div>

</div>
