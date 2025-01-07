<?php

use Illuminate\Support\Facades\Route;


Route::middleware(['auth:sanctum', 'verified'])->group(function ()
{
    Route::get('/logbooks', App\Livewire\Logbook\Log\Index::class)->name('logbooks');
    Route::get('logs/{id}', App\Livewire\Logbook\CommonLog::class)->name('logs');
    Route::get('sales-logs/{id}', App\Livewire\Logbook\Log\SalesLog::class)->name('sales.log');
    Route::get('purchase-logs/{id}', App\Livewire\Logbook\Log\PurchaseLog::class)->name('purchase.log');
    Route::get('export-logs/{id}', App\Livewire\Logbook\Log\ExportLog::class)->name('export.log');
});
