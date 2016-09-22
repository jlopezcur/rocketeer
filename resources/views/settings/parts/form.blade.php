<div class="form-group">
    {!! Form::label('title', trans('fields.name')) !!}
    {!! Form::text('title', (isset($settings->title) ? $settings->title : null), ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('analytics', trans('settings.google_analytics')) !!}
    {!! Form::textarea('analytics', (isset($settings->analytics) ? $settings->analytics : null), ['class' => 'form-control']) !!}
</div>
