{!! Form::model($server->runtimes(), ['route' => ['runtimes.store']]) !!}
{!! Form::hidden('server_id', $server->id) !!}

    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <?php $options = App\Vault::lists('name', 'id')->prepend(trans('fields.none'), 0) ?>
                {!! Form::label('vault_id', trans('vaults.vault')) !!}
                {!! Form::select2('vault_id', $options) !!}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <?php $options = App\Script::lists('name', 'id')->prepend(trans('fields.none'), 0) ?>
                {!! Form::label('script_id', trans('scripts.script')) !!}
                {!! Form::select2('script_id', $options) !!}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('start_id', trans('scripts.start')) !!}
                {!! Form::date('start_id', null, ['class' => 'form-control']) !!}
                {!! Form::time('start_id', null, ['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="col-md-3">
            {!! Form::submit(trans('runtimes.launch'), ['class' => 'btn btn-primary']) !!}
        </div>

    </div>




{!! Form::close() !!}
