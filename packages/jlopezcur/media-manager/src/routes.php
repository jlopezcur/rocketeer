<?php

Route::group(['namespace' => 'Jlopezcur\MediaManager', 'prefix' => 'admin', 'middleware' => 'auth'], function () {

    Route::post('mediamanager/upload/{path?}', ['uses' => 'MediaManagerController@upload', 'as' => 'mediamanager.upload'])->where('path', '(.*)');
    Route::get('mediamanager/get/{path?}', ['uses' => 'MediaManagerController@get', 'as' => 'mediamanager.get'])->where('path', '(.*)');
    Route::get('mediamanager/newfolder/{path?}', ['uses' => 'MediaManagerController@newfolder', 'as' => 'mediamanager.newfolder'])->where('path', '(.*)');
    Route::post('mediamanager/delete', ['uses' => 'MediaManagerController@delete', 'as' => 'mediamanager.delete']);

});
