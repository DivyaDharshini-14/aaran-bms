<?php

use Illuminate\Support\Facades\Route;

//Common
Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('/cities', App\Livewire\Common\CityList::class)->name('cities');



    Route::get('/states', App\Livewire\Common\StateList::class)->name('states');
    Route::get('/pin-codes', App\Livewire\Common\PincodeList::class)->name('pin-codes');
    Route::get('/countries', App\Livewire\Common\CountryList::class)->name('countries');
    Route::get('/hsn-codes', App\Livewire\Common\HsncodeList::class)->name('hsn-codes');
    Route::get('/categories', App\Livewire\Common\CategoryList::class)->name('categories');
    Route::get('/transports', App\Livewire\Common\TransportList::class)->name('transports');
    Route::get('/departments', App\Livewire\Common\DepartmentList::class)->name('departments');
    Route::get('/ledgers', App\Livewire\Common\LedgerList::class)->name('ledgers');
    Route::get('/sizes', App\Livewire\Common\SizeList::class)->name('sizes');
    Route::get('/colours', App\Livewire\Common\ColourList::class)->name('colours');
    Route::get('/dispatches', App\Livewire\Common\DespatchList::class)->name('dispatches');
    Route::get('/banks', App\Livewire\Common\BankList::class)->name('banks');
    Route::get('/receipt-types', App\Livewire\Common\ReceipttypeList::class)->name('receipt-types');

    Route::get('Factory', App\Livewire\Demo\Data\Factory\Index::class)->name('Factory');




});
