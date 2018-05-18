<?php

namespace App\Http\Controllers\API\Enrollee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repo\Enrollee\EnrolleeInterface;

class EnrolleeController extends Controller
{
	
	protected $enrollee;

    public function __construct(EnrolleeInterface $enrollee){

    	$this->enrollee = $enrollee;
    }
    
    public function getEnrollees(){

    	return $this->enrollee->getEnrollees();
    }
}
