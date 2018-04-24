<?php

use Illuminate\Database\Seeder;
use App\Model\Requirement;

class RequirementsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('requirements')->truncate();
        $requirements = [
        	'For Highschool Graduate',
        	'For ALS',
        	'For College (Level/Degree)',
        	'Additional Requirements'
        ];

        foreach ($requirements as $key => $value) {
        	
        	$requirement = Requirement::create([
        			'name' => $value
        		]);
        	
        }
    }
}
