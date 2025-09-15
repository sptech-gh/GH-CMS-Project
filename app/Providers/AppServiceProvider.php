<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Load helpers.php if not already autoloaded via composer.json
        // $helpersPath = app_path('helpers.php');
        // if (file_exists($helpersPath)) {
        //     require_once $helpersPath;
        // }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Share currentChurch with all Blade views
        View::composer('*', function ($view) {
            $currentChurch = app()->bound('currentChurch') ? app('currentChurch') : null;
            $view->with('currentChurch', $currentChurch);
        });
    }
}
