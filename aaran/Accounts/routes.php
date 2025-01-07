<?php

use Illuminate\Support\Facades\Route;

//Transaction
Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('accountHeads', App\Livewire\Accounts\AccountHead\Index::class)->name('accountHeads');

    Route::get('ledgerGroups', App\Livewire\Accounts\LedgerGroup\Index::class)->name('ledgerGroups');

    Route::get('c-ledgers', App\Livewire\Accounts\Ledger\Index::class)->name('c-ledgers');

});
