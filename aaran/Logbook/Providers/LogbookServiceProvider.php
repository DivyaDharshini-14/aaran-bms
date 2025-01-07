<?php

namespace Aaran\Logbook\Providers;

use Illuminate\Support\ServiceProvider;

class LogbookServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->mergeConfigFrom(__DIR__ . '/../config.php','Logbook');

        $this->app->register(LogbookRouteServiceProvider::class);
    }

}
