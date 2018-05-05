<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Requirement extends Model
{
    
    protected $table = 'requirements';

    public function requirementsDoc(){

    	return $this->hasMany('App\Model\RequirementDoc', 'requirement_id', 'id');
    }
}
