<?php

// Issues, Labels and Milestones Binds
Route::bind('issues', function ($id) { return App\Issue::find($id); });
Route::bind('labels', function ($id) { return App\Label::find($id); });
Route::bind('milestones', function ($slug) { return App\Milestone::findBySlug($slug); });

// Issues
Route::get('issues', ['uses' => 'IssuesController@index', 'as' => 'issues.index']);
Route::resource('projects.issues', 'IssuesController');
Route::get('projects/{project}/issues/{issues}/quick_update', ['uses' => 'IssuesController@quick_update', 'as' => 'projects.issues.quick_update']);
Route::post('projects/{project}/issues/upload', ['uses' => 'IssuesController@upload', 'as' => 'projects.issues.upload']);
Route::post('projects/{project}/issues/{issues}/comments/store', ['uses' => 'IssueCommentsController@store', 'as' => 'projects.issues.comments.store']);

// Labels
Route::resource('projects.labels', 'LabelsController', ['except' => 'show']);

// Milestones
Route::resource('projects.milestones', 'MilestonesController', ['except' => 'show']);
