<?php

use Illuminate\Support\Facades\Route;

Route::get('/', Aaran\Web\Livewire\home\Index::class)->name('home');
Route::get('/about', Aaran\Web\Livewire\home\About::class)->name('about');
Route::get('/contact', Aaran\Web\Livewire\home\Contact::class)->name('contact');
Route::get('/blog', Aaran\Web\Livewire\home\Blog::class)->name('blog');
Route::get('/service', Aaran\Web\Livewire\home\Service::class)->name('service');
Route::get('/info', Aaran\Web\Livewire\home\Info::class)->name('info');


Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {

    Route::get('/dashboard', Aaran\Web\Livewire\dashboard\Index::class)->name('dashboard');
    Route::get('/showArticles/{id}', Aaran\Web\Livewire\dashboard\Show::class)->name('showArticles');
    Route::get('/elements', App\Livewire\Utilities\UiElements\Index::class)->name('elements');
    Route::get('/icons', App\Livewire\Utilities\Icon\Index::class)->name('icons');
    Route::get('/test', App\Livewire\Test\Index::class)->name('test');

    Route::get('sys', App\Livewire\Sys\Artisan\Migration::class)->name('sys');
    Route::get('dataTransfers', App\Livewire\DataTransfer\Index::class)->name('dataTransfers');
});
