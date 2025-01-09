<?php

namespace Aaran\Web\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Aaran\Web\Livewire\home;
use Aaran\Web\Livewire\dashboard;


class WebServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'Web';
    protected string $moduleNameLower = 'web';

    public function register(): void
    {
        $this->app->register(WebRouteServiceProvider::class);
        $this->loadConfigs();
        $this->loadViews();
    }

    public function boot(): void
    {
        $this->loadMigrations();

        // Register Livewire components
        Livewire::component('web::index', home\Index::class);
        Livewire::component('web::about-group', home\About::class);
        Livewire::component('web::blog', home\Blog::class);
        Livewire::component('web::contact', home\Contact::class);
        Livewire::component('web::info', home\Info::class);
        Livewire::component('web::service', home\Service::class);

        Livewire::component('dashboard::index', dashboard\Index::class);
        Livewire::component('dashboard::sales-chart', dashboard\SalesChart::class);
        Livewire::component('dashboard::show', dashboard\Show::class);

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
}
