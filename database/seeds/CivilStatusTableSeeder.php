<?php

use Illuminate\Database\Seeder;
use App\CivilStatus;

class CivilStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	CivilStatus::truncate();
        
        $civilStatus = new CivilStatus();
        $civilStatus->name = "Single";
        $civilStatus->save();

        $civilStatus = new CivilStatus();
        $civilStatus->name = "Married";
        $civilStatus->save();

        $civilStatus = new CivilStatus();
        $civilStatus->name = "Widow";
        $civilStatus->save();

        $civilStatus = new CivilStatus();
        $civilStatus->name = "Separated";
        $civilStatus->save();
        

    }
}
