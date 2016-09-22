<?php $issues = App\Issue::with('project')->where('status', 'open')->orderBy('updated_at', 'desc')->take(20)->get() ?>

<div class="box box-success">
    <div class="box-header">
        <h3 class="box-title">Latest Issues</h3>
        <div class="box-tools">

        </div>
    </div>

    <div class="box-body no-padding">
        <table class="table table-condensed table-striped table-hover">
            <thead>
                <tr>
                    <th>Project</th>
                    <th style="width: 10px">#</th>
                    <th>Title</th>
                </tr>
            </thead>
            <tbody>
                @forelse($issues as $issue)
                    <tr>
                        <td>
                            @if($issue->project != null)
                                <a href="{{ route('projects.show', [$issue->project->slug]) }}">{{ $issue->project->name }}</a>
                            @endif
                        </td>
                        <td>{{ $issue->number }}</td>
                        <td>
                            @if($issue->project != null)
                                <a href="{{ route('projects.issues.show', [$issue->project->slug, $issue->id]) }}">{{ $issue->title }}</a>
                            @else
                                {{ $issue->title }}
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">No Open Issues</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>
</div>
