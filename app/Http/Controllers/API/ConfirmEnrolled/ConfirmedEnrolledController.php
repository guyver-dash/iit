<?php

namespace App\Http\Controllers\API\ConfirmEnrolled;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\ConfirmEnrolled;
use App\Repo\ConfirmedEnrollee\ConfirmedEnrolleeInterface;

class ConfirmedEnrolledController extends Controller
{
    
    protected $confirmedEnrollee;
    public function __construct(ConfirmedEnrolleeInterface $confirmedEnrollee){
        $this->middleware(['role:admin']);
        $this->confirmedEnrollee = $confirmedEnrollee;
    }

    public function index(){

    	return $this->confirmedEnrollee->index();
    	
    }

    public function edit($id){
    	return response()->json([
    			'enrollee' => ConfirmEnrolled::where('id', $id)->with(['enrollee.siblings', 'enrollee.answers.question', 'enrollee.requirementsDoc'])->first()
    		]);
    }

    public function update($id){
        $request = app()->make('request');
        return $this->confirmedEnrollee->update($request, $id);
    }

    public function search(){

        return $this->confirmedEnrollee->search();
    }

    public function print($id){

       return $this->confirmedEnrollee->print($id);
    }

    public function destroy($id){

        return $this->confirmedEnrollee->destroy($id);
    }

    public function shs(){

        return $this->confirmedEnrollee->shs();
    }

    public function searchShs(){
         return $this->confirmedEnrollee->searchShs();
    }
}
