<?php

namespace Aaran\Common\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;

use Aaran\Common\Livewire\city; // Example
use Aaran\Common\Livewire\state; // Example
use Aaran\Common\Livewire\pincode; // Example
use Aaran\Common\Livewire\country; // Example
use Aaran\Common\Livewire\hsncode; // Example
use Aaran\Common\Livewire\category; // Example
use Aaran\Common\Livewire\colour; // Example
use Aaran\Common\Livewire\size; // Example
use Aaran\Common\Livewire\department; // Example
use Aaran\Common\Livewire\transport; // Example
use Aaran\Common\Livewire\bank; // Example
use Aaran\Common\Livewire\receipttype; // Example
use Aaran\Common\Livewire\dispatch; // Example




class CommonServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'Common';
    protected string $moduleNameLower = 'common';

    public function register(): void
    {
        $this->app->register(CommonRouteServiceProvider::class);
        $this->loadConfigs();
        $this->loadViews();
    }

    public function boot(): void
    {
        $this->loadMigrations();
//        $this->mapApiRoutes();
//        $this->mapWebRoutes();

        // Register Livewire components
        Livewire::component('common::city-list', city\CityList::class);
        Livewire::component('common::state-list', state\StateList::class);
        Livewire::component('common::pincode-list', pincode\PincodeList::class);
        Livewire::component('common::country-list', country\CountryList::class);
        Livewire::component('common::hsncode-list', hsncode\HsncodeList::class);
        Livewire::component('common::category-list', category\CategoryList::class);
        Livewire::component('common::colour-list', colour\ColourList::class);
        Livewire::component('common::size-list', size\SizeList::class);
        Livewire::component('common::department-list', department\DepartmentList::class);
        Livewire::component('common::transport-list', transport\TransportList::class);
        Livewire::component('common::bank-list', bank\BankList::class);
        Livewire::component('common::receipt-type-list', receipttype\ReceiptTypeList::class);
        Livewire::component('common::dispatch-list', dispatch\DispatchList::class);





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
