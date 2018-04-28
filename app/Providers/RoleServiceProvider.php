<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use \App\Http\Controllers\Role\API\RoleController;
use \App\Repo\Role\RoleInterface;
use \App\Repo\Role\RoleRepository;

class RoleServiceProvider extends ServiceProvider
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
        //******* API/Course/CourseController ***********/
        $this->app->when(RoleController::class)
          ->needs(RoleInterface::class)
          ->give(RoleRepository::class);
    }
}
