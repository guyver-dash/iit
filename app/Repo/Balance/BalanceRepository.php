<?php 

namespace App\Repo\Balance;

use App\Repo\BaseRepository;
use App\Repo\BaseInterface;
use App\Model\Balance;
use App\Model\ConfirmEnrolled;

class BalanceRepository extends BaseRepository implements BalanceInterface{

	public function __construct(){

		$this->modelName = new Balance();
	}

	
	public function index(){

		return $this->modelName->orderBy('created_at', 'DESC')->paginateBal();
	}

	public function store($request){
		$balance = $this->modelName->create($request->all());
		if (count($request->course_ids) > 0) {
			
			foreach ($request->course_ids as $course_id) {
				
				$confirmEnrolled = ConfirmEnrolled::where('course_id', $course_id)->get();
				foreach ($confirmEnrolled  as $value) {
					$newBalance = $this->modelName->find($balance->id);
					$newBalance->confirmEnrolled()->attach($balance->id,[
						'balance_id' => $balance->id,
						'confirm_enrolled_id' => $value->id
					]);
				}
				
			}
		}
		else{

			$newBalance = $this->modelName->find($balance->id);
			$newBalance->confirmEnrolled()->attach($balance->id,[
					'balance_id' => $balance->id,
					'confirm_enrolled_id' => $request->confirmEnrolledId
				]);
		}

		
	}

	public function destroy($id){

		$balance = $this->modelName->find($id);
		$balance->confirmEnrolled()->detach();
		$balance->delete();

	}

	public function search(){
		
		$request = app()->make('request');

		return $this->modelName->where('name', 'LIKE', '%'. $request->search . '%')->paginateBal();
	}


	
}