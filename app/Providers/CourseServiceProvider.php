<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Http\Controllers\API\Course\CourseController;
use App\Repo\Course\CourseInterface;
use App\Repo\Course\CourseRepository;


class CourseServiceProvider extends ServiceProvider
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

        /******* API/Course/CourseController ***********/
        $this->app->when(CourseController::class)
          ->needs(CourseInterface::class)
          ->give(CourseRepository::class);

    }
}
