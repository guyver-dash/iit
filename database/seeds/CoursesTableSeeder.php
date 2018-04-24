<?php

use Illuminate\Database\Seeder;
use App\Model\Course;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('courses')->truncate();

        $courses = ['Senior HighSchool', 'Junior HighSchool', 'ICT'];

        foreach ($courses as $key => $value) {
        	
        	Course::create([
        			'name' => $value
        		]);
        }
    }
}
