<?php

use Illuminate\Support\Facades\Route;

//Common
Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('/cities', App\Livewire\Common\CityList::class)->name('cities');
    Route::get('/states', App\Livewire\Common\StateList::class)->name('states');
    Route::get('/pincodes', App\Livewire\Common\PincodeList::class)->name('pincodes');
    Route::get('/countries', App\Livewire\Common\CountryList::class)->name('countries');
    Route::get('/hsncodes', App\Livewire\Common\HsncodeList::class)->name('hsncodes');
    Route::get('/categories', App\Livewire\Common\CategoryList::class)->name('categories');
    Route::get('/transports', App\Livewire\Common\TransportList::class)->name('transports');
    Route::get('/departments', App\Livewire\Common\DepartmentList::class)->name('departments');
    Route::get('/ledgers', App\Livewire\Common\LedgerList::class)->name('ledgers');
    Route::get('/sizes', App\Livewire\Common\SizeList::class)->name('sizes');
    Route::get('/colours', App\Livewire\Common\ColourList::class)->name('colours');
    Route::get('/despatches', App\Livewire\Common\DespatchList::class)->name('despatches');
    Route::get('/banks', App\Livewire\Common\BankList::class)->name('banks');
    Route::get('/receipttypes', App\Livewire\Common\ReceipttypeList::class)->name('receipttypes');

    Route::get('Factory', App\Livewire\Demo\Data\Factory\Index::class)->name('Factory');
//    Route::get('productFactory', App\Livewire\Demo\Data\Product\Index::class)->name('productFactory');




});
