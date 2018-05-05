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

        		'name' => '8:00AM - 12:00PM',
        		'start' =>  Carbon::parse('08:00:00.00'),
        		'end' => Carbon::parse('12:00:00.00')
        	]);
         Schedule::create([

                'name' => '12:00NN - 5:00PM',
                'start' =>  Carbon::parse('13:00:00.00'),
                'end' => Carbon::parse('17:00:00.00')
            ]);

         Schedule::create([

                'name' => '5:00PM - 9:00PM',
                'start' =>  Carbon::parse('17:00:00.00'),
                'end' => Carbon::parse('21:00:00.00')
            ]);
    }
}
