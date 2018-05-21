<?php

namespace App\Http\Controllers\API\ConfirmEnrolled;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\ConfirmEnrolled;

class ConfirmedEnrolledController extends Controller
{
    

    public function index(){

    	return response()->json([
    			'enrollees' => ConfirmEnrolled::with('enrollee')->get()
    		]);
    	
    }

    public function edit($id){
    	return response()->json([
    			'enrollee' => ConfirmEnrolled::find($id)->with(['enrollee.siblings', 'enrollee.answers.question', 'enrollee.requirementsDoc'])->first()
    		]);
    }

    public function update($id){

    	return reponse()->json(['asdf']);
    }
}
