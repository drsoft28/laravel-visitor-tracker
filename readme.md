# Laravel Visitor Tracker - Full User Guide

The **Laravel Visitor Tracker** package allows you to track guest and user activity on your web application. It provides detailed information about visitors, including their IP address, location, visited URLs, and more. This guide will walk you through the installation, configuration, and usage of the package.

---

## Table of Contents
1. [Installation](#installation)
2. [Configuration](#configuration)
3. [Middleware Setup](#middleware-setup)
4. [Usage](#usage)
5. [Database Structure](#database-structure)
6. [Model Methods](#model-methods)
7. [Customization](#customization)
8. [Troubleshooting](#troubleshooting)

---

## Installation

1. Install the package via Composer:
   ```bash
   composer require drsoft28/visitortracker
   ```

2. Publish the configuration file and migrations:
   ```bash
   php artisan vendor:publish --provider="Drsoft28\VisitorTracker\VisitorTrackerServiceProvider"
   ```
   
   Or
   
	```bash
	php artisan vendor:publish --tag=visitor-tracker-migrations --tag=visitor-tracker-config --tag=visitor-tracker-model
	```

   This will create:
   - A `visitortracker.php` file in the `config/` directory.
   - A migration file for the `visitor_trackers` table in the `database/migrations/` directory.

3. Run the migration to create the `visitor_trackers` table:
   ```bash
   php artisan migrate
   ```

---

## Configuration

After publishing the configuration file, you can customize the package behavior by editing the `config/visitortracker.php` file. Here are the default options:

```php
return [
    /*
    |--------------------------------------------------------------------------
    | Model
    |--------------------------------------------------------------------------
    |
    | This value is the model used for tracking visitors.
    | By default, it uses the package's built-in model.
    | You can replace it with your own model if needed.
    */
    'model' => \Drsoft28\VisitorTracker\Models\VisitorTracker::class,

    /*
    |--------------------------------------------------------------------------
    | Headers to Track
    |--------------------------------------------------------------------------
    |
    | Specify the headers to store in the `request_info` JSON column.
    | Add or remove headers as needed.
    */
    'headers' => [
        'HTTP_USER_AGENT',
        'HTTP_HOST',
        'SERVER_NAME',
        'SERVER_SOFTWARE',
        'REMOTE_ADDR',
        'HTTPS',
    ],
];
```

---

## Middleware Setup

To start tracking visitors, you need to add the `VisitorTrackerMiddleware` to your application's middleware stack.

### For Laravel 10 and Below:
Add the middleware to the `web` group in `app/Http/Kernel.php`:

```php
'web' => [
    \App\Http\Middleware\EncryptCookies::class,
    \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
    \Illuminate\Session\Middleware\StartSession::class,
    \Illuminate\View\Middleware\ShareErrorsFromSession::class,
    \App\Http\Middleware\VerifyCsrfToken::class,
    \Illuminate\Routing\Middleware\SubstituteBindings::class,
    \Drsoft28\VisitorTracker\Middleware\VisitorTrackerMiddleware::class,
],
```

### For Laravel 11 and Above:
Add the middleware in `bootstrap/app.php`:

```php
->withMiddleware(function (Middleware $middleware) {
    $middleware->web(append: [
        \Drsoft28\VisitorTracker\Middleware\VisitorTrackerMiddleware::class,
    ]);
})
```

---

## Usage

Once the middleware is enabled, the package will automatically track visitors and store their information in the `visitor_trackers` table.

### Default Model
By default, the package uses the `\Drsoft28\VisitorTracker\Models\VisitorTracker` model. You can change this in the `visitortracker.php` configuration file.

### Database Columns
The `visitor_trackers` table contains the following columns:

- `user_id`: The ID of the authenticated user (if applicable).
- `host_schema`: The protocol (e.g., `http` or `https`).
- `host`: The hostname (e.g., `example.com`).
- `ip`: The visitor's IP address.
- `path`: The visited path (e.g., `/about`).
- `full_url`: The full URL visited.
- `url`: The relative URL.
- `country_name`: The visitor's country name.
- `country_code`: The visitor's country code.
- `region_name`: The visitor's region name.
- `region_code`: The visitor's region code.
- `city_name`: The visitor's city name.
- `zip_code`: The visitor's ZIP code.
- `iso_code`: The ISO code of the visitor's location.
- `latitude`: The visitor's latitude.
- `longitude`: The visitor's longitude.
- `timezone`: The visitor's timezone.
- `referer`: The referer URL.
- `route_name`: The name of the route visited.
- `route_params`: The parameters of the route.
- `request_info`: A JSON column containing additional request information (e.g., headers).

---

## Model Methods

The `VisitorTracker` model provides the following methods for querying visitor data:

1. **`visitorsWithinSeconds($seconds)`**:
   - Retrieve visitors who visited within the last `$seconds` seconds.

2. **`visitorsWithinMinutes($minutes)`**:
   - Retrieve visitors who visited within the last `$minutes` minutes.

3. **`visitorsWithinHours($hours)`**:
   - Retrieve visitors who visited within the last `$hours` hours.

Example Usage:
```php
use Drsoft28\VisitorTracker\Models\VisitorTracker;

// Get visitors from the last 5 minutes
$recentVisitors = VisitorTracker::visitorsWithinMinutes(5)->get();
```

---

## Customization

### Custom Model
If you want to use a custom model for tracking visitors, follow these steps:

1. Create a new model in your `app/Models` directory:
   ```php
   namespace App\Models;

   use Illuminate\Database\Eloquent\Model;

   class CustomVisitorTracker extends Model
   {
       protected $table = 'visitor_trackers';
       protected $fillable = [
           'user_id', 'host_schema', 'host', 'ip', 'path', 'full_url', 'url',
           'country_name', 'country_code', 'region_name', 'region_code', 'city_name',
           'zip_code', 'iso_code', 'latitude', 'longitude', 'timezone', 'referer',
           'route_name', 'route_params', 'request_info',
       ];
   }
   ```

2. Update the `visitortracker.php` configuration file to use your custom model:
   ```php
   'model' => \App\Models\CustomVisitorTracker::class,
   ```

### Custom Headers
You can customize the headers tracked in the `request_info` column by updating the `headers` array in the `visitortracker.php` configuration file.

---

## Troubleshooting

1. **Middleware Not Tracking Visitors**:
   - Ensure the middleware is added to the correct group (`web` or `global`).
   - Verify that the middleware is not being skipped by other middleware.

2. **Migration Errors**:
   - Ensure the `visitor_trackers` table does not already exist before running the migration.
   - Check for any typos in the migration file.

3. **Configuration Not Applied**:
   - Clear the configuration cache after updating the `visitortracker.php` file:
     ```bash
     php artisan config:clear
     ```

---

## Support

If you encounter any issues or have questions, please open an issue on the [GitHub repository](https://github.com/drsoft28/laravel-visitor-tracker).

---

Thank you for using **Laravel Visitor Tracker**! 🚀