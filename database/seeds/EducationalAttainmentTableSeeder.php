<?php

use Illuminate\Database\Seeder;
use App\Model\EducAtt;

class EducationalAttainmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('educational_attainments')->truncate();

        $educationalAttainments = ['HighSchool', 'College Level', 'College Degree', 'Masteral PHD'];

        foreach ($educationalAttainments as $key => $value) {
        	EducAtt::create([
        			'name' => $value
        		]);
        }
    }
}
