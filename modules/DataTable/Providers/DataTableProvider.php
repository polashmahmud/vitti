<?php

namespace Modules\DataTable\Providers;

use Illuminate\Support\ServiceProvider;

class DataTableProvider extends ServiceProvider
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
        $this->mergeConfigFrom(__DIR__ . '/../config.php', 'datatable');
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
    }
}
