<?php

use Illuminate\Database\Seeder;
use App\Model\Schedule;
use Carbon\Carbon;

class SchedulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('schedules')->truncate();

        Schedule::create([

        		'name' => 'Morning Session',
        		'start' =>  Carbon::now(),
        		'end' => Carbon::now()
        	]);
    }
}
