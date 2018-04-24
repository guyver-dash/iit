<?php

use Illuminate\Database\Seeder;
use App\Model\Yearlevel;

class YearLevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('year_levels')->truncate();

        $yearLevels = ['1st Year', '2nd Year'];

        foreach ($yearLevels as $key => $value) {
        	YearLevel::create([

        		'name' => $value
        	]);
        }
        
    }
}
