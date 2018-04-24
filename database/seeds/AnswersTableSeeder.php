<?php

use Illuminate\Database\Seeder;
use App\Model\Answer;

class AnswersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('answers')->truncate();
    }
}
