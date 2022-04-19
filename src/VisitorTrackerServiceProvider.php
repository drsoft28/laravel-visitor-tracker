<?php

namespace Drsoft\VisitorTracker;

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
            __DIR__.'/config/visitor-tracker.php', 'visitor-tracker'
        );
        $this->loadMigrationsFrom(__DIR__.'/migrations');
        $this->publishes([
            __DIR__.'/config/visitor-tracker.php' => config_path('visitor-tracker.php'),
            __DIR__.'/migrations' => base_path('database/migrations'),
        ]);
    }
}
