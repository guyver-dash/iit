<?php namespace App\Repo\Admission;

use App\Repo\BaseRepository;

use App\Admission;

class AdmissionRepository extends BaseRepository implements AdmissionInterface{

	public function __construct(){

		$this->modelName = new Admission();
	}


}