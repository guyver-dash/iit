<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    
    protected $table = 'answers';

    public function question(){

    	return $this->belongsTo('App\Model\Question', 'question_id', 'id');
    }
}
