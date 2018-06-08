<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    
    protected $table = "balances";
    protected $fillable = ['amount', 'name'];

    public function confirmEnrolled(){

    	 return $this->belongsToMany('App\Model\ConfirmEnrolled', 'balance_confirm_enrolled', 'balance_id', 'confirm_enrolled_id');
    }

    public function scopePaginateBal($query){

    	return $query->paginate(2);
    }

    public function getAmountAttribute($val){

    	return (float) $val;
    }
}
