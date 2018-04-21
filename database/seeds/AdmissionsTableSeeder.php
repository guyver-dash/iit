<?php

use Illuminate\Database\Seeder;
use App\Admission;

class AdmissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        Admission::truncate();
        
        for ($i=0; $i < 3; $i++) { 
        	
        	$admission = new Admission();
        	$admission->name = $faker->sentence($nbWords = 4, $variableNbWords = true);
        	$admission->save();
        }
    }
}
