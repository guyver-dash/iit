<?php

use Illuminate\Database\Seeder;
use App\Model\Semester;

class SemestersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('semesters')->truncate();

        $semesters = ['1st sem', '2nd sem'];

        foreach ($semesters as $key => $value) {
        	
        	Semester::create([
        			'name' => $value
        		]);
        }
    }
}
