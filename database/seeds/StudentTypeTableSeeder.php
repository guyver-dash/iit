<?php

use Illuminate\Database\Seeder;
use App\Model\StudentType;

class StudentTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('student_type')->truncate();
       	$studentType = ['FRESHMEN', 'TRANSFEREE', 'COLLEGE HOLDER'];

       	foreach ($studentType as $value) {
       		StudentType::create([
       				'name' => $value
       			]);
       	}
    }
}
