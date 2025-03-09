<?php

namespace Drsoft28\VisitorTracker;

use Illuminate\Support\ServiceProvider;

class VisitorTrackerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->mergeConfigFrom(
            __DIR__.'/config/visitortracker.php', 'visitortracker'
        );
        $this->loadMigrationsFrom(__DIR__.'/migrations');
        $this->publishes([
            __DIR__.'/config/visitortracker.php' => config_path('visitortracker.php'),
            __DIR__.'/migrations' => base_path('database/migrations'),
        ]);
    }
}
