<?php

namespace Drsoft28\VisitorTracker;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Artisan;

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
        // Get the current date in the format Y_m_d_His (e.g., 2023_10_05_123456)
        $datePrefix = Date::now()->format('Y_m_d_His');

        // Publish migrations with the current date prefix
        $this->publishesMigrations([
            __DIR__.'/migrations/create_visitor_trackers_table.php' => database_path("migrations/{$datePrefix}_create_visitor_trackers_table.php"),
        ], 'visitor-tracker-migrations');

        // Publish configuration file
        $this->publishes([
            __DIR__.'/config/visitortracker.php' => config_path('visitortracker.php'),
        ], 'visitor-tracker-config');

        // Publish the VisitorTracker model
        $this->publishes([
            __DIR__.'/Subs/VisitorTracker.sub' => app_path('Models/VisitorTracker.php'),
        ], 'visitor-tracker-model');

        // Register a custom Artisan command to publish the model and show a message
        Artisan::command('visitor-tracker:publish-model', function () {
            // Publish the model
            $this->call('vendor:publish', [
                '--tag' => 'visitor-tracker-model',
            ]);

            // Display a message to update the config file
            $this->info('VisitorTracker model published successfully!');
            $this->warn('Please update the `visitortracker` configuration file to use the correct model:');
            $this->line("'model' => \\App\\Models\\VisitorTracker::class,");
        })->describe('Publish the VisitorTracker model and show instructions to update the config.');
    }
}    

}
