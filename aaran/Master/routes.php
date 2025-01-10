<?php

use Illuminate\Support\Facades\Route;

//Master
Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('/companies', Aaran\Master\Livewire\company\Index::class)->name('companies');
//    Route::get('/companies/{id}/upsert', Aaran\Master\Livewire\company\Upsert::class)->name('companies.upsert');

    Route::get('/contacts', Aaran\Master\Livewire\contact\Index::class)->name('contacts');
    Route::get('/contacts/{id}/upsert', Aaran\Master\Livewire\contact\Upsert::class)->name('contacts.upsert');
    Route::get('/contactReport/print/{party}/{start_date?}/{end_date?}', App\Http\Controllers\Report\Contact\PartyReportController::class)->name('contactReport.print');

    Route::get('/products', Aaran\Master\Livewire\Product\Index::class)->name('products');
    Route::get('/orders', Aaran\Master\Livewire\Orders\Index::class)->name('orders');
    Route::get('/styles', Aaran\Master\Livewire\Style\Index::class)->name('styles');
});
