<?php

return [

    // Projects
    'created_project' => '<a href="' . url('/') . 'users/:user_id">:user_name</a> created project <a href="' . url('/') . '/projects/:project_slug">:project_name</a>',
    'updated_project' => '<a href="' . url('/') . 'users/:user_id">:user_name</a> updated project <a href="' . url('/') . '/projects/:project_slug">:project_name</a>',
    'deleted_project' => '<a href="' . url('/') . 'users/:user_id">:user_name</a> deleted project <a href="' . url('/') . '/projects/:project_slug">:project_name</a>',

    // Issues
    'created_issue' => '<a href="' . url('/') . '/users/:user_id">:user_name</a> created issue <a href="' . url('/') . '/projects/:project_slug/issues/:issue_id">#:issue_id: :issue_name</a> in project <a href="' . url('/') . '/projects/:project_slug">:project_name</a>',
    'updated_issue' => '<a href="' . url('/') . '/users/:user_id">:user_name</a> updated issue <a href="' . url('/') . '/projects/:project_slug/issues/:issue_id">#:issue_id: :issue_name</a> from project <a href="' . url('/') . '/projects/:project_slug">:project_name</a>',
    'deleted_issue' => '<a href="' . url('/') . '/users/:user_id">:user_name</a> deleted issue <a href="' . url('/') . '/projects/:project_slug/issues/:issue_id">#:issue_id: :issue_name</a> from project <a href="' . url('/') . '/projects/:project_slug">:project_name</a>',

    // IssuesComments
    'created_issuecomment' => '<a href="' . url('/') . '/users/:user_id">:user_name</a> created comment at issue <a href="' . url('/') . '/projects/:project_slug/issues/:issue_id">#:issue_id: :issue_name</a> in project <a href="' . url('/') . '/projects/:project_slug">:project_name</a>',
    'updated_issuecomment' => '<a href="' . url('/') . '/users/:user_id">:user_name</a> updated comment at issue <a href="' . url('/') . '/projects/:project_slug/issues/:issue_id">#:issue_id: :issue_name</a> from project <a href="' . url('/') . '/projects/:project_slug">:project_name</a>',
    'deleted_issuecomment' => '<a href="' . url('/') . '/users/:user_id">:user_name</a> deleted comment at issue <a href="' . url('/') . '/projects/:project_slug/issues/:issue_id">#:issue_id: :issue_name</a> from project <a href="' . url('/') . '/projects/:project_slug">:project_name</a>',

    // Labels
    'created_label' => '<a href="' . url('/') . '/users/:user_id">:user_name</a> created label <a href="' . url('/') . '/projects/:project_slug/labels/:label_id">
    <span class="label" style="background: :label_color; padding: 0.1em 0.4em 0.2em; font-size: 65%;">
        <i class="fa fa-tag fa-fw"></i> :label_name
    </span></a> in project <a href="' . url('/') . '/projects/:project_slug">:project_name</a>',
    'updated_label' => '<a href="' . url('/') . '/users/:user_id">:user_name</a> updated label <a href="' . url('/') . '/projects/:project_slug/labels/:label_id">
    <span class="label" style="background: :label_color; padding: 0.1em 0.4em 0.2em; font-size: 65%;">
        <i class="fa fa-tag fa-fw"></i> :label_name
    </span></a> from project <a href="' . url('/') . '/projects/:project_slug">:project_name</a>',
    'deleted_label' => '<a href="' . url('/') . '/users/:user_id">:user_name</a> deleted label <a href="' . url('/') . '/projects/:project_slug/labels/:label_id">
    <span class="label" style="background: :label_color; padding: 0.1em 0.4em 0.2em; font-size: 65%;">
        <i class="fa fa-tag fa-fw"></i> :label_name
    </span></a> from project <a href="' . url('/') . '/projects/:project_slug">:project_name</a>',

    // Milestones
    'created_milestone' => '<a href="' . url('/') . '/users/:user_id">:user_name</a> created milestone <a href="' . url('/') . '/projects/:project_slug/milestones/:milestone_id">#:milestone_id: :milestone_name</a> in project <a href="' . url('/') . '/projects/:project_slug">:project_name</a>',
    'updated_milestone' => '<a href="' . url('/') . '/users/:user_id">:user_name</a> updated milestone <a href="' . url('/') . '/projects/:project_slug/milestones/:milestone_id">#:milestone_id: :milestone_name</a> from project <a href="' . url('/') . '/projects/:project_slug">:project_name</a>',
    'deleted_milestone' => '<a href="' . url('/') . '/users/:user_id">:user_name</a> deleted milestone <a href="' . url('/') . '/projects/:project_slug/milestones/:milestone_id">#:milestone_id: :milestone_name</a> from project <a href="' . url('/') . '/projects/:project_slug">:project_name</a>',

];
