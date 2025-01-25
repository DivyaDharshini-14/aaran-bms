<?php

namespace Aaran\Reports\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Aaran\Reports\Livewire\contact;
use Aaran\Reports\Livewire\sales;
use Aaran\Reports\Livewire\statement;
use Aaran\Reports\Livewire\transaction;

class ReportServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'Master';
    protected string $moduleNameLower = 'master';

    public function register(): void
    {
        $this->app->register(ReportRouteServiceProvider::class);
        $this->loadConfigs();
        $this->loadViews();
    }

    public function boot(): void
    {
        $this->loadMigrations();

        Livewire::component('report::contact-report', contact\ContactReport::class);
        Livewire::component('report::party-report', contact\ContactReport::class);

        Livewire::component('report::gst-report', sales\GstReport::class);
        Livewire::component('report::monthly-report', sales\MonthlyReport::class);

        Livewire::component('report::payable', statement\Payable::class);
        Livewire::component('report::payable-report', statement\PayablesReport::class);
        Livewire::component('report::receivable', statement\Receivable::class);
        Livewire::component('report::receivable-report', statement\ReceivablesReport::class);

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
