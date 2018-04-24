<?php

use Illuminate\Database\Seeder;
use App\Model\Question;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('questions')->truncate();

        $questions = ['My Parents Are', 'Who are you living with', 'Where will you live during school days'];

        foreach ($questions as $key => $value) {
        	
        	Question::create([
        			'name' => $value
        		]);
        }
    }
}
