<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AdmissionServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        
        $this->app->bind("App\Repo\Admission\AdmissionInterface", "App\Repo\Admission\AdmissionRepository");
    }
}
