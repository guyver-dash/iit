<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    
    protected $table = 'questions';

    public function answers(){

    	return $this->belongsToMany('App\Model\Answer', 'answer_question', 'question_id', 'answer_id');
    }
}
