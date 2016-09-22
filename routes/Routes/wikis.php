<?php

// Binds
Route::bind('wikis', function ($path) { return App\Wiki::findBySlug($path); });

// Wikis
Route::get('wikis', ['uses' => 'WikisController@index', 'as' => 'wikis.index']);
Route::post('projects/{projects}/wikis/upload', ['uses' => 'WikisController@upload', 'as' => 'projects.wikis.upload']);
Route::get('projects/{projects}/wikis/create', ['uses' => 'WikisController@create', 'as' => 'projects.wikis.create']);
Route::get('projects/{projects}/wikis/{path}', ['uses' => 'WikisController@show', 'as' => 'projects.wikis.show']);
Route::resource('projects.wikis', 'WikisController', ['except' => ['show']]);
