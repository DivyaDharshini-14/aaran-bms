<?php

use Illuminate\Support\Facades\Route;

//Conclusion
Route::middleware(['auth:sanctum', 'verified'])->group(function () {

Route::get('/conclusion/task',App\Livewire\Conclusion\Task\Index::class)->name('conclusion.task');
Route::get('/conclusion/task/{id}/upsert',App\Livewire\Conclusion\Task\Upsert::class)->name('conclusion.task.upsert');
});
