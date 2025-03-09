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
		if (app()->runningInConsole()) {
   
        $this->publishesMigrations([
                __DIR__.'/migrations' => database_path('migrations'),
            ], 'visitor-tracker-migrations');
		 $this->publishes([
			__DIR__.'/config/visitortracker.php' => config_path('visitortracker.php'),
		], 'visitor-tracker-config');      
		}
    }
}
