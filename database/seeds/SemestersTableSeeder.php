<?php

use Illuminate\Database\Seeder;
use App\Semester;

class SemestersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Semester::truncate();
        
        $semester = new Semester();
        $semester->name = "1st Semester";
        $semester->save();

        $semester = new Semester();
        $semester->name = "2nd Semester";
        $semester->save();

        $semester = new Semester();
        $semester->name = "Not Applicable";
        $semester->save();
        
    }
}
