<?php

namespace Jlopezcur\MediaManager;

use Illuminate\Support\ServiceProvider;

class MediaManagerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/mediamanager.php' => config_path('mediamanager.php'),
        ], 'config');

        $this->publishes([
            __DIR__.'/../public/assets/plugins/mediamanager/mediamanager.js' => public_path('assets/plugins/mediamanager/mediamanager.js'),
            __DIR__.'/../public/assets/plugins/mediamanager/mediamanager.css' => public_path('assets/plugins/mediamanager/mediamanager.css'),
            __DIR__.'/../public/assets/plugins/dropzone/dropzone.js' => public_path('assets/plugins/dropzone/dropzone.js'),
            __DIR__.'/../public/assets/plugins/dropzone/dropzone.css' => public_path('assets/plugins/dropzone/dropzone.css'),
        ], 'assets');

        $this->loadTranslationsFrom(__DIR__.'/resources/lang', 'mediamanager');

        include __DIR__.'/resources/macros/mediamanager.php';
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        include __DIR__.'/routes.php';

        $this->app->make('Jlopezcur\MediaManager\MediaManagerController');
    }
}
