<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => ['web']], function () {

    Route::auth();

    // Tools
    Route::get('locales/change', ['uses' => 'LocalesController@change', 'as' => 'locale.change']);

    Route::group(['middleware' => 'auth'], function () {

        Route::get('/', ['uses' => 'DashboardController@index', 'as' => 'dashboard.index']);

        // User administration

        Route::get('users/{user}/transform_into', ['uses' => 'UsersController@transform_into', 'as' => 'users.transform_into']);
        Route::resource('users', 'UsersController', ['exclude' => ['show']]);

        // Projects
        Route::resource('projects', 'ProjectsController');

        require_once(base_path('routes/Routes/issues.php'));
        require_once(base_path('routes/Routes/wikis.php'));

        // Vaults

        Route::resource('vaults', 'VaultsController');

        // Servers

        Route::get('servers/{server}/ping', ['uses' => 'ServersController@ping', 'as' => 'servers.ping']);
        Route::resource('servers', 'ServersController');

        Route::resource('scripts', 'ScriptsController');

        Route::get('runtimes/{runtime}/run', ['uses' => 'RuntimesController@run', 'as' => 'runtimes.run']);
        Route::resource('runtimes', 'RuntimesController', ['only' => ['store']]);

        // Deployments

        Route::resource('deployments', 'DeploymentsController', ['exclude' => ['show']]);

        // Locales

        Route::resource('locales', 'LocalesController', ['exclude' => ['show']]);

        Route::get('settings/edit', ['uses' => 'SettingsController@edit', 'as' => 'settings.edit']);
        Route::post('settings/update', ['uses' => 'SettingsController@update', 'as' => 'settings.update']);

        // Activities
        Route::get('activities', ['uses' => 'ActivitiesController@index', 'as' => 'activities.index']);

    });

});
