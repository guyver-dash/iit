<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repo\ConfirmedEnrollee\ConfirmedEnrolleeInterface;
use App\Repo\ConfirmedEnrollee\ConfirmedEnrolleeRepository;
use App\Http\Controllers\API\ConfirmEnrolled\ConfirmedEnrolledController;

class ConfirmedEnrolleeServiceProvider extends ServiceProvider
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
        $this->app->when(ConfirmedEnrolledController::class)
          ->needs(ConfirmedEnrolleeInterface::class)
          ->give(ConfirmedEnrolleeRepository::class);
    }
}
