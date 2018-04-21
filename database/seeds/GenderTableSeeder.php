<?php

use Illuminate\Database\Seeder;
use App\Gender;

class GenderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        Gender::truncate();
        
        $gender = new Gender();
        $gender->name = "Male";
        $gender->save();

        $gender = new Gender();
        $gender->name = "Female";
        $gender->save();

        $gender = new Gender();
        $gender->name = "Gay";
        $gender->save();

        $gender = new Gender();
        $gender->name = "Lesbian";
        $gender->save();

    }
}
