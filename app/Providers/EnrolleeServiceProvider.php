<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use \App\Http\Controllers\API\Enrollee\EnrolleeController;
use \App\Repo\Enrollee\EnrolleeInterface;
use \App\Repo\Enrollee\EnrolleeRepository;

class EnrolleeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->when(EnrolleeController::class)
          ->needs(EnrolleeInterface::class)
          ->give(EnrolleeRepository::class);
    }
}
