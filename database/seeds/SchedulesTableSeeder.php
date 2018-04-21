<?php

use Illuminate\Database\Seeder;
use App\Schedule;

class SchedulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        Schedule::truncate();
        
        for ($i=0; $i < 5; $i++) { 
        	
        	$schedule = new Schedule();
        	$schedule->days = $faker->text($maxNbChars = 20);
        	$schedule->start_time = $faker->time($format = 'H:i:s', $max = 'now');
        	$schedule->end_time = $faker->time($format = 'H:i:s', $max = 'now');
        	$schedule->save();
        }
    }
}
