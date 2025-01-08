<?php

namespace Aaran\Entries\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Aaran\Entries\Livewire\exportSales;
use Aaran\Entries\Livewire\payment;
use Aaran\Entries\Livewire\purchase;
use Aaran\Entries\Livewire\sales;

class EntriesServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'Entries';
    protected string $moduleNameLower = 'entries';

    public function register(): void
    {
        $this->app->register(EntriesRouteServiceProvider::class);
        $this->loadConfigs();
        $this->loadViews();
    }

    public function boot(): void
    {
        $this->loadMigrations();

        // Register Livewire components
        Livewire::component('entries::export-sales', exportSales\Index::class);
        Livewire::component('entries::export-sales-packing', exportSales\PackingList::class);
        Livewire::component('entries::export-sales-upsert', exportSales\Upsert::class);

        Livewire::component('entries::payment', payment\Index::class);

        Livewire::component('entries::purchase', purchase\Index::class);
        Livewire::component('entries::purchase-upsert', purchase\Upsert::class);

        Livewire::component('entries::sales', sales\Index::class);
        Livewire::component('entries::sales-upsert', sales\Upsert::class);
        Livewire::component('entries::sales-eWay', sales\EwayBill::class);
        Livewire::component('entries::sales-eInvoice', sales\Einvoice::class);
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
