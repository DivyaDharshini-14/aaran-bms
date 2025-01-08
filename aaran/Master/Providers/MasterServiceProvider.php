<?php

namespace Aaran\Master\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Aaran\Master\Livewire\company;
use Aaran\Master\Livewire\contact;
use Aaran\Master\Livewire\product;
use Aaran\Master\Livewire\orders;
use Aaran\Master\Livewire\style;

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

        Livewire::component('master::company-list', company\Index::class);
        Livewire::component('master::company-upsert', company\Upsert::class);

        Livewire::component('master::contact-list', contact\Index::class);
        Livewire::component('master::contact-upsert', contact\Upsert::class);

        Livewire::component('master::product', product\Index::class);
        Livewire::component('master::orders', orders\Index::class);
        Livewire::component('master::style', style\Index::class);
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
