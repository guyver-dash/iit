<?php 

namespace App\Repo\Balance;

use Illuminate\Pagination\LengthAwarePaginator;
use App\Repo\BaseRepository;
use App\Repo\BaseInterface;
use App\Model\Balance;
use App\Model\ConfirmEnrolled;
Use App\Model\Enrollee;

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
						'confirm_enrolled_id' => $value->id,
						'discount' => $request->discount
					]);
				}
				
			}
		}
		else{

			$newBalance = $this->modelName->find($balance->id);
			$newBalance->confirmEnrolled()->attach($balance->id,[
					'balance_id' => $balance->id,
					'confirm_enrolled_id' => $request->confirmEnrolledId,
					'discount' => $request->discount
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

	public function enrolleeSearch(){

		$request = app()->make('request');
        $confirmedEnroll = ConfirmEnrolled::whereHas('enrollee', function($query) use ($request) {
            $query->where(function($query) use ($request) {
                $query->orWhere('firstname', 'LIKE', '%'. $request->string . '%');
                $query->orWhere('lastname', 'LIKE', '%'. $request->string . '%');

            });

        })->with('enrollee')->take(10)->get();
        return $confirmedEnroll->map(function ($item, $key) {
        	//id is a confirm_enroll_id
				    return [ 
				    	'id' => $item->id, 
				    	'name' => $item->enrollee->firstname . ' ' . $item->enrollee->lastname
				    ];
				});
	}

	public function balanceEnrollees($id){

		$request = app()->make('request');
		$balances = $this->modelName->where('id', $id)->with('confirmEnrolled.enrollee')->first();
		return $balances;
		$page = $request->page;
		$perPage = 2;

		$paginator = new LengthAwarePaginator(
		    $balances->confirmEnrolled->forPage($page, $perPage), $balances->confirmEnrolled->count(), $perPage, $page
		);
		return $paginator;
	}


	public function deleteConfirmEnrolled($balanceId, $confirmEnrollId){

		$balance = $this->modelName
			->whereHas('confirmEnrolled', function($query) use ($confirmEnrollId) {

					$query->where('confirm_enrolled_id', $confirmEnrollId);
		})->get();

		return $balance;
	}

	public function attachEnrollee(){

		$request = app()->make('request');

		$balance = $this->modelName->find($request->balanceId);
		$balance->confirmEnrolled()->attach($request->balanceId, [
				'balance_id' => $request->balanceId,
				'discount' => $request->discount,
				'confirm_enrolled_id' => $request->confirmEnrolledId
			]);

		return response()->json([
				'success' => true
			]);
	}


	
}