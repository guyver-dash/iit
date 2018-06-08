<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Payment extends Model
{
    
    protected $table = 'payments';
    protected $fillable = ['confirm_enrollee_id', 'amount_charge', 'amount_given', 'change'];
    public function scopePaginationPay($query){
    	return $query->paginate(2);
    }

    public function confirmEnrolled(){

    	return $this->hasOne('App\Model\ConfirmEnrolled', 'id', 'confirm_enrollee_id');
    }

    public function getCreatedAtAttribute($value){
        return  Carbon::parse($value)->toDayDateTimeString();
        
    }
}
