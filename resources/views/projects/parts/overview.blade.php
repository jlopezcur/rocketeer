<h2>{{ $project->name }}</h2>

<p>
    <i class="fa fa-plug"></i> {{ $project->slug }}
</p>

<p>
    <a href="{{ $project->web }}" target="_blank"><i class="fa fa-link"></i> {{ $project->web }}</a>
</p>

<p>
    {{ $project->description }}
</p>
