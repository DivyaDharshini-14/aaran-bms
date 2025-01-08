<?php

namespace Aaran\AccountMaster\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Aaran\AccountMaster\Livewire\accountHead;
use Aaran\AccountMaster\Livewire\ledgerGroup;
use Aaran\AccountMaster\Livewire\ledger;

class AccountMasterServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'AccountMaster';
    protected string $moduleNameLower = 'accountMaster';

    public function register(): void
    {
        $this->app->register(AccountMasterRouteServiceProvider::class);
        $this->loadConfigs();
        $this->loadViews();
    }

    public function boot(): void
    {
        $this->loadMigrations();
//        $this->mapApiRoutes();
//        $this->mapWebRoutes();

        // Register Livewire components
        Livewire::component('accountMaster::accountHead', accountHead\Index::class);
        Livewire::component('accountMaster::ledger-group', ledgerGroup\Index::class);
        Livewire::component('accountMaster::ledger', ledger\Index::class);


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
//
//    protected function mapWebRoutes()
//    {
//        Route::middleware('web')
//            ->prefix($this->moduleNameLower)
//            ->namespace("Modules\\{$this->moduleName}\\Http\\Controllers")
//            ->group(__DIR__ . '/../Routes/web.php');
//    }
//
//    protected function mapApiRoutes()
//    {
//        Route::prefix('api')
//            ->middleware('api')
//            ->namespace("Modules\\{$this->moduleName}\\Http\\Controllers")
//            ->group(__DIR__ . '/../Routes/api.php'); // Optional API routes
//    }

}
