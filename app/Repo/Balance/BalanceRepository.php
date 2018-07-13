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

		$confirmEnrolled = ConfirmEnrolled::whereHas('balances', function($query) use ($request) {
			$query->where('balance_id', $request->id);
					
		})->with(['balances', 'enrollee'])
		->paginate(15);

		$page = $request->page;
		$perPage = 2;
		
		return $confirmEnrolled;
	}


	public function deleteConfirmEnrolled($balanceId, $confirmEnrollId){

		return \DB::table('balance_confirm_enrolled')
			->where('balance_id', $balanceId)
			->where('confirm_enrolled_id', $confirmEnrollId)
			->delete();

	}

	public function attachEnrollee(){

		$request = app()->make('request');

		if (count($request->course_ids) > 0) {
			
			foreach ($request->course_ids as $course_id) {
				
				$confirmEnrolled = ConfirmEnrolled::where('course_id', $course_id)->get();
				foreach ($confirmEnrolled  as $value) {
					$balance = $this->modelName->find($request->balanceId);
					$balance->confirmEnrolled()->detach();
					$balance->confirmEnrolled()->attach($request->balanceId, [
							'balance_id' => $request->balanceId,
							'discount' => $request->discount,
							'confirm_enrolled_id' => $value->id
						]);
				}
				
			}
		}
		else{

			$balance = $this->modelName->find($request->balanceId);
			$balance->confirmEnrolled()->detach();
			$balance->confirmEnrolled()->attach($request->balanceId, [
					'balance_id' => $request->balanceId,
					'discount' => $request->discount,
					'confirm_enrolled_id' => $request->confirmEnrolledId
				]);
		}

		
	}

	public function balanceEnrolleeSearch(){

		$request = app()->make('request');

        return $confirmedEnroll = ConfirmEnrolled::whereHas('enrollee', function($query) use ($request) {
            $query->where(function($query) use ($request) {
                $query->orWhere('firstname', 'LIKE', '%'. $request->string . '%');
                $query->orWhere('lastname', 'LIKE', '%'. $request->string . '%');

            });

        })->whereHas('balances', function($query) use ($request) {
            	$query->where('balance_id', $request->balanceId);
        })
        ->with(['enrollee', 'balances'])->paginate(2);

	}
}