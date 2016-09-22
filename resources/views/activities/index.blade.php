@foreach ($activities as $activity)

    <?php $entity = explode('_', $activity->name)[1] ?>
    <?php $user = $activity->user ?>
    @include('activities.items.' . $entity)

@endforeach
