<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title">First Steps</h3>
    </div>

    <!-- /.box-header -->
    <div class="box-body">

        <?php
        $user = Auth::user();
        $fields = [$user->email, $user->first_name, $user->last_name];
        $points = 0; foreach ($fields as $field) if (!empty($field)) $points++;
        $percentage = round($points / count($fields) * 100);
        ?>

        @if ($percentage < 100)

            <h4><i class="fa fa-arrow-right"></i> Complete your user data</h4>
            {{ $percentage }}% Completed. <a href="{{ route('users.edit', [$user->id]) }}">Fill all your data.</a>
            <hr />

        @endif

    </div>
</div>
