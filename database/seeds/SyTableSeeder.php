<?php

use Illuminate\Database\Seeder;
use App\Sy;

class SyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Sy::truncate();
        
        for ($i=7; $i < 9 ; $i++) { 
        	$sy = new Sy();
        	$sy->name = '201' . $i . ' - 201' . ($i + 1);
        	$sy->save();
        }
        
       
    }
}
