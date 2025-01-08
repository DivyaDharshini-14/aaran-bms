<?php

use Illuminate\Support\Facades\Route;

//Master
Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('/companies', \Aaran\Master\Livewire\company\Index::class)->name('companies');

    Route::get('/products', Aaran\Master\Livewire\company\Product\Index::class)->name('products');

    Route::get('/contacts', Aaran\Master\Livewire\contact\Index::class)->name('contacts');
    Route::get('/contacts/{id}/upsert', Aaran\Master\Livewire\contact\Upsert::class)->name('contacts.upsert');

//    Route::get('/companies', App\Livewire\Master\Index\Index::class)->name('companies');

    Route::get('/orders', Aaran\Master\Livewire\company\Orders\Index::class)->name('orders');

    Route::get('/styles', Aaran\Master\Livewire\company\Style\Index::class)->name('styles');

    Route::get('/contactReport/print/{party}/{start_date?}/{end_date?}', App\Http\Controllers\Report\Contact\PartyReportController::class)->name('contactReport.print');
});
