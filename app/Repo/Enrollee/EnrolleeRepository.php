<?php 

namespace App\Repo\Enrollee;

use App\Repo\BaseRepository;
use App\Repo\BaseInterface;
use App\Model\Enrollee;

class EnrolleeRepository extends BaseRepository implements EnrolleeInterface{

	public function __construct(){
		$this->modelName = new Enrollee();
	}
    public function getEnrollees(){
        
        return response()->json([
        		'enrollees' => $this->modelName->with(['answers', 'requirementsDoc', 'siblings'])->get()
        	]);
    }	
}