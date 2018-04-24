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
        		'start_date' =>  Carbon::now(),
        		'end_date' => Carbon::now()->addYears(1),
        	]);
    }
}
