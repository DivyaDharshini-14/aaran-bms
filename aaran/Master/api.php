<?php

use Illuminate\Support\Facades\Route;

//Common
Route::middleware(['auth:sanctum', 'verified'])->group(function () {

//    Route::get('/cities', App\Livewire\Common\aCityList::class)->name('cities');

    Route::get('/companies', \Aaran\Master\Livewire\company\Index::class)->name('companies');



//    Route::get('/states', App\Livewire\Common\StateList::class)->name('states');
//    Route::get('/pin-codes', App\Livewire\Common\PincodeList::class)->name('pin-codes');
//    Route::get('/countries', App\Livewire\Common\CountryList::class)->name('countries');
//    Route::get('/hsn-codes', App\Livewire\Common\HsncodeList::class)->name('hsn-codes');
//    Route::get('/categories', App\Livewire\Common\CategoryList::class)->name('categories');
//    Route::get('/transports', App\Livewire\Common\TransportList::class)->name('transports');
//
//    Route::get('Factory', App\Livewire\Demo\Data\Factory\Index::class)->name('Factory');




});
