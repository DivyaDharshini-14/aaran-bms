<?php

namespace Aaran\Taskmanager\Providers;

use Illuminate\Support\ServiceProvider;
use Aaran\Taskmanager\Livewire\task;
use Aaran\Taskmanager\Livewire\activity;
use Livewire\Livewire;

class TaskmanagerServiceProvider extends ServiceProvider
{

    protected string $moduleName = 'Taskmanager';
    protected string $moduleNameLower = 'taskmanager';

    public function register(): void
    {
        $this->app->register(TaskmanagerRouteServiceProvider::class);
        $this->loadConfigs();
        $this->loadViews();
    }

    public function boot(): void
    {
        $this->loadMigrations();

        Livewire::component('taskmanager::task-list', task\Index::class);
        Livewire::component('taskmanager::task-upsert', task\Upsert::class);
        Livewire::component('taskmanager::activity-list', activity\Index::class);


    }

    protected function loadConfigs(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config.php', $this->moduleNameLower);
    }

    protected function loadViews(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../Livewire', $this->moduleNameLower);
    }

    protected function loadMigrations(): void
    {

        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

}
