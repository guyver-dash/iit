<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    
    protected $table = 'answers';

    public function questions(){

    	return $this->belongsToMany('App\Model\Question', 'answer_question', 'answer_id', 'question_id');
    }
}
