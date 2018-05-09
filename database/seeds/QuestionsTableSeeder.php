<?php

use Illuminate\Database\Seeder;
use App\Model\Question;
use App\Model\Answer;
use Carbon\Carbon;

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
         DB::table('answers')->truncate();

         $question = Question::create([
         		'name' => 'My parents are:'
         	]);

         $answers = [

         	'Living Together',
         	'Father/Mother working abroad',
         	'Separated',
         	'Deceased Mother/Father'

         ];


         foreach ($answers as $key => $value) {
         	
         	$answer = new Answer();
            $answer->question_id = $question->id;
         	$answer->name = $value;

         	Question::find($question->id)->answers()->save($answer);

         }
         

          $question = Question::create([
                'name' => 'Who are you living with:'
            ]);

         $answers = [

            'Parents/in law',
            'Stepfather/Stepmother',
            'Guardians/Relatives',
            'Spoused'

         ];

         foreach ($answers as $key => $value) {
            
            $answer = new Answer();
            $answer->question_id = $question->id;
            $answer->name = $value;

            Question::find($question->id)->answers()->save($answer);

         }

          $question = Question::create([
                'name' => 'Where will you live during school days:'
            ]);

         $answers = [

            'Parents/in law',
            'Stepfather/Stepmother',
            'Guardians/Relatives',
            'Spoused'

         ];

         foreach ($answers as $key => $value) {
            
            $answer = new Answer();
            $answer->question_id = $question->id;
            $answer->name = $value;

            Question::find($question->id)->answers()->save($answer);

         }

    }
}
