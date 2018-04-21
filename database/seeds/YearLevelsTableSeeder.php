<?php

use Illuminate\Database\Seeder;
use App\YearLevel;

class YearLevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        YearLevel::truncate();
        
        $yearLevel = new YearLevel();
        $yearLevel->name = "1st Year";
        $yearLevel->save();

        $yearLevel = new YearLevel();
        $yearLevel->name = "2nd Year";
        $yearLevel->save();
    }
}
