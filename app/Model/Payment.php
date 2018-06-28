<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Payment extends Model
{
    
    protected $table = 'payments';
    protected $fillable = ['confirm_enrollee_id', 'amount_charge', 'amount_given', 'change', 'prefix', 'balance_id', 'receipt_no', 'total_amount_given'];
    
    public function scopePaginationPay($query){
    	return $query->paginate(15);
    }

    public function getAmountGivenAttribute($val){

        return (float) $val;
    }
    
    public function getAmountChargeAttribute($val){

        return (float) $val;
    }
    public function getChangeAttribute($val){

        return (float) $val;
    }

    public function confirmEnrolled(){

    	return $this->hasOne('App\Model\ConfirmEnrolled', 'id', 'confirm_enrollee_id');
    }

    public function getCreatedAtAttribute($value){
        return  Carbon::parse($value)->toDayDateTimeString();
        
    }

    public function balance(){

    	return $this->hasOne('App\Model\Balance', 'id', 'balance_id');
    }

    public function enrollee(){

        return $this->hasManyThrough(
            'App\Model\Enrollee', 
            'App\Model\ConfirmEnrolled',
            'id',
            'id',
            'confirm_enrollee_id',
            'enrollee_id'
            );
    }


}
