<?php

namespace Aaran\Master\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Aaran\Master\Livewire\company;

class MasterServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'Master';
    protected string $moduleNameLower = 'master';

    public function register(): void
    {
        $this->app->register(MasterRouteServiceProvider::class);
        $this->loadConfigs();
        $this->loadViews();
    }

    public function boot(): void
    {
        $this->loadMigrations();

        Livewire::component('master::company-list', company\CompanyList::class);
    }

    protected function loadConfigs(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config.php', $this->moduleNameLower);
    }

    protected function loadViews(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../Livewire', $this->moduleNameLower);
    }

    protected function loadMigrations(): void
    {

        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

//{
//$this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
//$this->mergeConfigFrom(__DIR__ . '/../config.php', 'company');
//
//$this->app->register(MasterRouteServiceProvider::class);
//}

}
