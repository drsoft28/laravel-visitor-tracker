# Laravel visitor tracker

this package providers you to able track guest or user on your web application

# installion

`composer require drsoft/visitor-tracker`

Publish the configuration file (this will create a visitor-tracker.php file inside the config/ directory and file migration for table visitor_trackers inside database/migrations):

`php artisan vendor:publish --provider="Drsoft\VisitorTracker\VisitorTrackerServiceProvider"`

then you can migrate  
`php artisan migrate` 


you should visitor tracker middlewire in kernel.php in middleware global or web as you like

`\Drsoft\VisitorTracker\Middleware\VisitorTrackerMiddleware::class`


`
 'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            \Drsoft\VisitorTracker\Middleware\VisitorTrackerMiddleware::class,
        ],
`
# Usage

this packahe fill in table visitor tracker ( see config file to know which model use)
model by default

`\Drsoft\VisitorTracker\Models\VisitorTracker`

## columns
 
 - user_id
 - ip
 - path
 - full_url
 - url
 - country_name
 - country_code
 - region_name
 - region_code
 - city_name
 - zip_code
 - iso_code
 - latitude
 - longitude
 - timezone
 - referer
 - route_name
 - route_params
 - request_info (json columns, it's depond on `config('visitor-tracker.headers')`)