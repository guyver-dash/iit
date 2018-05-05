<?php

use Illuminate\Database\Seeder;
use App\Model\CivilStatus;

class CivilStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $civilStatuss = [
        	'Married',
        	'Widowed',
        	'Separated',
        	'Divorced',
        	'Single'
        ];

        foreach ($civilStatuss as $key => $value) {
        	
        	CivilStatus::create([

        			'name' => $value

        		]);
        }
    }
}
