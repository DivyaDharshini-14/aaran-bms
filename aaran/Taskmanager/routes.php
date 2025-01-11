<?php

use Illuminate\Support\Facades\Route;

//company
Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('/task', Aaran\Taskmanager\Livewire\task\Index::class)->name('task');
    Route::get('/task/{id}/upsert', Aaran\Taskmanager\Livewire\task\Upsert::class)->name('task.upsert');
    Route::get('/activity', Aaran\Taskmanager\Livewire\activity\Index::class)->name('activity');

});
