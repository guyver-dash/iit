<?php

use Illuminate\Database\Seeder;
use App\Course;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $faker = Faker\Factory::create();

        Course::truncate();
        
        for ($i=0; $i < 10; $i++) { 
        	
        	$course = new Course();
        	$course->name = $faker->sentence($nbWords = 4, $variableNbWords = true);
        	$course->save();
        }
    }
}
