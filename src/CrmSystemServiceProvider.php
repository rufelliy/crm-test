<?php

namespace CrmPackage;

use Illuminate\Support\ServiceProvider;
use CrmPackage\Models\Call;
use CrmPackage\Observers\CallObserver;

class CrmSystemServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->loadRoutesFrom(__DIR__.'/../routes/api.php');

        Call::observe(CallObserver::class);
    }
}
