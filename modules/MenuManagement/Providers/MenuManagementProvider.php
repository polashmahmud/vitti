<?php

namespace Modules\MenuManagement\Providers;

use Illuminate\Support\ServiceProvider;

class MenuManagementProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config.php', 'menumanagement');
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
    }
}
