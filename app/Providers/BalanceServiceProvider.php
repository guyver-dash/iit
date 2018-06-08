<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;


use App\Http\Controllers\API\Balance\BalanceController;
use App\Repo\Balance\BalanceInterface;
use App\Repo\Balance\BalanceRepository;

class BalanceServiceProvider extends ServiceProvider
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
        $this->app->when(BalanceController::class)
          ->needs(BalanceInterface::class)
          ->give(BalanceRepository::class);
    }
}
