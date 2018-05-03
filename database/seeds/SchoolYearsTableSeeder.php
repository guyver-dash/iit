<?php

use Illuminate\Database\Seeder;
use App\Model\SchoolYear;
use Carbon\Carbon;
class SchoolYearsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('school_years')->truncate();

        SchoolYear::create([
        		'sy' => 2018 . '-' . 2019
        		
        	]);
        SchoolYear::create([
                'sy' => 2019 . '-' . 2020
                
            ]);
    }
}
