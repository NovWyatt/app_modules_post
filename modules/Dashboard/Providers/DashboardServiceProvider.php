<?php

namespace Modules\Dashboard\Providers;

use Illuminate\Support\ServiceProvider;

class DashboardServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Load routes from the specified path
        $this->loadRoutesFrom(__DIR__ . '/../Routes/web.php');

        // Load views from the specified path and register the namespace as 'Authentication'
        $this->loadViewsFrom(__DIR__ . '/../Views', 'Dashboard');

        // Optionally, load migrations if needed
        // $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

    public function boot()
    {
        // Any additional boot logic can be placed here
    }
}
