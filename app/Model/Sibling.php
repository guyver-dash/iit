<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Sibling extends Model
{
    
    protected $table = 'siblings';
    protected $fillable = [
    	'age', 'name', 'occupation', 'school_name'

    ];

    public function enrollee(){
    	return $this->belongsToMany('App\Model\Enrollee', 'enrollee_sibling', 'enrollee_id', 'sibling_id');
    }
}
