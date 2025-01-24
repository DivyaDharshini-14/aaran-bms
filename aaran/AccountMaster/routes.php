<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('accountHeads', Aaran\AccountMaster\Livewire\accountHead\Index::class)->name('accountHeads');

    Route::get('ledgerGroups', Aaran\AccountMaster\Livewire\ledgerGroup\Index::class)->name('ledgerGroups');

    Route::get('ledgers', Aaran\AccountMaster\Livewire\ledger\Index::class)->name('ledgers');

});
